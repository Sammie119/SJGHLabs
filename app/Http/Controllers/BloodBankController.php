<?php

namespace App\Http\Controllers;

use App\Models\BloodDonor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\VWDropdown;
use Illuminate\Support\Facades\DB;
use App\Models\LabResultsInfo;
use App\Models\BloodBankLabs;
use App\Models\VWBloodBankLabs;
use App\Models\BloodBank;
use App\Models\VWBloodBank;

class BloodBankController extends Controller
{
    public function index()
    {
        $donors = DB::table('vw_blood_donors')->orderBy('donor_id', 'DESC')->get(); 
        
        return view('donors-list', compact('donors'));
    }

    public function bloodBankLabs()
    {
        $labs = VWBloodBankLabs::orderBy('lab_info_id', 'DESC')->with('user')->get();
        return view('results-blood-labs', compact('labs'));
    }

    public function createDonor()
    {
        $profession = VWDropdown::where('category_name', 'Profession')->get();
        return view('create-donor', compact('profession'));
    }

    public function registerDonor(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'dob' => 'required|date',
            'gender' => 'required',
            // 'contact' => 'unique:blood_donors,mobile',
            // 'mobile' => 'unique:blood_donors'

        ],
        [
            // 'mobile.unique' => 'OPD Number has already been taken',
            'name.required' => 'Name field is required',
            'dob.required' => 'Date of Birth is required',
            'dob.date' => 'Date of Birth must be a Data',
            'gender.required' => 'Gender is required',
            // 'contact.unique' => 'Contact has already been taken'
        ]);

        // return $request->input();

        $donor = BloodDonor::where('mobile', $request['contact'])->first();

        if(!empty($request['contact']) && $donor){

            $request->session()->flash('register', 'Blood Donor, '.$donor->name.' registered Successfully!!');

            // return redirect('donors-list');
            return view('donor-labs', compact('donor'));
        }
        else {       
            $donor = new BloodDonor;
            
            $donor->name = $request['name'];
            $donor->date_of_birth = $request['dob'];
            $donor->gender = $request['gender'];
            $donor->blood_group = $request['blood'];
            $donor->marita_status = $request['marital_status'];
            $donor->profession = $request['profession'];
            $donor->mobile = $request['contact'];
            $donor->address = $request['address'];
            $donor->created_by = Session::get('user')['user_id'];
            $donor->updated_by = Session::get('user')['user_id'];
            $donor->save();

            $request->session()->flash('register', 'Blood Donor, '.$donor->name.' registered Successfully!!');

            // return redirect('donors-list');
            return view('donor-labs', compact('donor'));
        }
    }

    public function edit($id)
    {
        $donor = BloodDonor::find($id);

        $profession = VWDropdown::where('category_name', 'Profession')->get();
        
        return view('edit-donor', compact('donor', 'profession'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'dob' => 'required|date',
            'gender' => 'required',
            // 'mobile' => 'unique:blood_donors'

        ],
        [
            // 'mobile.unique' => 'OPD Number has already been taken',
            'name.required' => 'Name field is required',
            'dob.required' => 'Date of Birth is required',
            'dob.date' => 'Date of Birth must be a Data',
            'gender.required' => 'Gender is required'
        ]);

        // return $request->input();
       
        $donor = BloodDonor::find($request->id);
        
        $donor->name = $request['name'];
        $donor->date_of_birth = $request['dob'];
        $donor->gender = $request['gender'];
        $donor->blood_group = $request['blood'];
        $donor->marita_status = $request['marital_status'];
        $donor->profession = $request['profession'];
        $donor->mobile = $request['contact'];
        $donor->address = $request['address'];
        $donor->updated_by = Session::get('user')['user_id'];
        $donor->update();

        $request->session()->flash('register', 'Blood Donor, '.$donor->name.' updated Successfully!!');

        return redirect('donors-list');
    }

    public function donorLabs(Request $request)
    {
        $request->validate([
            'lab_no' => 'required|max:10'

        ],
        [
            'lab_no.required' => 'Lab Number is required',
            'lab_no.max' => 'Lab Number must not be more than 10 Characters'
        ]);

    //Lab Results Info.......................................    

        if(Session::get('user')['department'] == 'Main Lab'){
            $lab_no = 'M'.$request->lab_no;
          }else{
            $lab_no = 'R'.$request->lab_no;
          }

        $donor = DB::table('vw_blood_donors')->where('donor_id', $request['id'])->first();

        $lab_info = new LabResultsInfo;
        $lab_info->patient_id = $request['id'];
        $lab_info->department_id = 0;
        $lab_info->lab_number = $lab_no;
        $lab_info->age = $donor->age;
        $lab_info->created_by = Session::get('user')['user_id'];
        $lab_info->updated_by = Session::get('user')['user_id'];
        $lab_info->save();

    //Blod Bank Lab Results..........................................

        $donorLab = new BloodBankLabs;
        $donorLab->lab_info_id = $lab_info->lab_info_id;
        $donorLab->anti_tpha = $request['anti_tpha'];
        $donorLab->hbs_ag = $request['hbs_ag'];
        $donorLab->hcv = $request['hcv'];
        $donorLab->bf = $request['bf'];
        $donorLab->blood = $request['blood'];
        $donorLab->retro = $request['retro'];
        $donorLab->mass = $request['mass'];
        $donorLab->bp = $request['bp'];
        $donorLab->status = $request['status'];
        $donorLab->blood_number = $request['blood_no'];
        $donorLab->save();

        $request->session()->flash('register', 'Blood donor Labs for '.$donor->name.' saved Successfully!!');
        return redirect('create-donor');
    }

    public function editBloodLabs($id)
    {
        $donor = VWBloodBankLabs::where('lab_info_id',$id)->first();
        
        return view('edit-blood-labs', compact('donor'));
    }

    public function updatedBloodLabs(Request $request)
    {
        $request->validate([
            'lab_no' => 'required|max:10'

        ],
        [
            'lab_no.required' => 'Lab Number is required',
            'lab_no.max' => 'Lab Number must not be more than 10 Characters'
        ]);

    //Lab Results Info.......................................    

        $lab_info = LabResultsInfo::where('lab_info_id',$request->id)->first();

        $lab_info->updated_by = Session::get('user')['user_id'];
        $lab_info->update();

    //Blod Bank Lab Results..........................................

        $donorLab = BloodBankLabs::where('lab_info_id',$request->id)->first();
        $donorLab->anti_tpha = $request['anti_tpha'];
        $donorLab->hbs_ag = $request['hbs_ag'];
        $donorLab->hcv = $request['hcv'];
        $donorLab->bf = $request['bf'];
        $donorLab->blood = $request['blood'];
        $donorLab->retro = $request['retro'];
        $donorLab->mass = $request['mass'];
        $donorLab->bp = $request['bp'];
        $donorLab->status = $request['status'];
        $donorLab->blood_number = $request['blood_no'];
        $donorLab->update();

        $request->session()->flash('success', 'Blood donor Labs for updated Successfully!!');
        return redirect('results-blood-labs');
    }

    public function stockBlood()
    {
        return view('stock-blood');
    }

    public function stockBloodBank(Request $request)
    {
        $bld_no = VWBloodBankLabs::where('blood_number', $request->blood_number)->first();

        $blood = new BloodBank;
        $blood->blood_number = $request['blood_number'];
        $blood->donor_id = $bld_no->donor_id;
        $blood->taken_date = $request['date_taken'];
        $blood->exp_date = $request['exp_date'];
        $blood->patient_name = $request['patient_name'];
        $blood->volume = $request['volume'];
        $blood->created_by = Session::get('user')['user_id'];
        $blood->updated_by = Session::get('user')['user_id']; 
        $blood->save(); 
        
        return back()->with('register', 'Blood Bank Successfully Stocked!!');
    }

    public function bloodInStock()
    {
        $blood = VWBloodBank::where('status', 'No')->orderBy('bloodbank_id', 'DESC')->get();

        return view('blood-in-stock', compact('blood'));
    }

    public function editBloodInStock($id)
    {
        $blood = VWBloodBank::where('bloodbank_id',$id)->first();
        return view('edit-blood-in-stock', compact('blood'));
    }

    public function updateBloodInStock(Request $request)
    {
        $bld_no = VWBloodBankLabs::where('blood_number', $request->blood_number)->first();

        $blood = BloodBank::find($request->id);
        $blood->blood_number = $request['blood_number'];
        $blood->donor_id = $bld_no->donor_id;
        $blood->taken_date = $request['date_taken'];
        $blood->exp_date = $request['exp_date'];
        $blood->patient_name = $request['patient_name'];
        $blood->volume = $request['volume'];
        $blood->updated_by = Session::get('user')['user_id']; 
        $blood->update();
        
        $request->session()->flash('success', 'Blood In Stock Updated Successfully!!!');
        
        return redirect('blood-in-stock');
    }

    public function deleteDonor($id)
    {
        $donor = BloodDonor::find($id);
        if($donor){
            $donor->delete();

            return back()->with('register', 'Blood Donor, '.$donor->name.' deleted Successfully!!');
        }

    }

    public function deleteLabs($id)
    {
        $labs = LabResultsInfo::find($id);
        if($labs){
            $labs->delete();

            return back()->with('success', 'Blood Labs, '.$labs->lab_number.' deleted Successfully!!');
        }
    }

    public function deleteBlood($id)
    {
        $blood = BloodBank::find($id);
        if($blood){
            $blood->delete();

            return back()->with('register', 'Blood Deleted Successfully!!');
        }
    }
}
