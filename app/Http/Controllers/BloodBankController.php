<?php

namespace App\Http\Controllers;

use App\Models\BloodDonor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\VWDropdown;
use Illuminate\Support\Facades\DB;

class BloodBankController extends Controller
{
    public function index()
    {
        $donors = DB::table('vw_blood_donors')->orderBy('donor_id', 'DESC')->get(); 
        
        return view('donors-list', compact('donors'));
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

        $find = BloodDonor::where('mobile', $request['contact'])->first();

        if(!empty($request['contact']) && $find){

            $request->session()->flash('register', 'Blood Donor, '.$find->name.' registered Successfully!!');

            return redirect('donors-list');
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

            return redirect('donors-list');
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
        $donor->created_by = Session::get('user')['user_id'];
        $donor->updated_by = Session::get('user')['user_id'];
        $donor->update();

        $request->session()->flash('register', 'Blood Donor, '.$donor->name.' updated Successfully!!');

        return redirect('donors-list');
    }

    public function donorLabs()
    {
        return view('donor-labs');
    }

    public function deleteDonor($id)
    {
        $donor = BloodDonor::find($id);
        if($donor){
            $donor->delete();

            return back()->with('register', 'Blood Donor, '.$donor->name.' deleted Successfully!!');
        }

    }
}
