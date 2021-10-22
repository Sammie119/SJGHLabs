<?php

namespace App\Http\Controllers;

use App\Models\BloodBank;
use App\Models\BloodTransfussionEpisode;
use Illuminate\Http\Request;
use App\Models\VWBloodBank;
use App\Models\VWDropdown;
use Illuminate\Support\Facades\Session;
use App\Models\VWBloodTransfussionEpisode;

class BloodTransfussionsController extends Controller
{
    public function index()
    {
        $trans = VWBloodTransfussionEpisode::orderBy('updated_at', 'DESC')->with('user')->get();
        return view('blood-transfussions', compact('trans'));
    }

    public function checkoutBlood($id)
    {
        $blood = VWBloodBank::where('bloodbank_id',$id)->first();
        $department = VWDropdown::where('category_name', 'Department')->get();
        return view('checkout-blood', compact('blood', 'department'));
    }

    public function storeTransfussion(Request $request)
    {
        $blood = new BloodTransfussionEpisode;
        
        $blood->bloodbank_id = $request['id'];
        $blood->patient_name = $request['name_patient'];
        $blood->patient_gender = $request['gender'];
        $blood->patient_age = $request['age'];
        $blood->nurse_name = $request['name_staff'];
        $blood->department = $request['department'];
        $blood->transfusion_date = $request['date_transfuss'];
        $blood->volume = $request['volume'];
        $blood->blood_product = $request['blood_product'];
        $blood->created_by = Session::get('user')['user_id'];
        $blood->updated_by = Session::get('user')['user_id']; 
        $blood->save();

        $bloodbank = BloodBank::find($request->id);

        if($bloodbank){
            $volume = $bloodbank->volume - $blood->volume;
            
            $bloodbank->volume = $volume;
            if($volume <= 0) {
                $bloodbank->status = 'Yes';
            }
            $bloodbank->updated_by = Session::get('user')['user_id'];
            $bloodbank->update(); 
        }

        $request->session()->flash('success', 'Blood Number '.$blood->bloodbank_id.' Checked out Successfully!!');

        return redirect('blood-transfussions');
    }

    public function editCheckout($id)
    {
        $blood = VWBloodTransfussionEpisode::where('bloodtrans_id', $id)->first();
        $department = VWDropdown::where('category_name', 'Department')->get();
        return view('edit-checkout-blood', compact('blood', 'department'));
    }

    public function updateCheckout(Request $request)
    {
        $blood = BloodTransfussionEpisode::find($request->id);
        $volume_old = $blood->volume;
        
        // $blood->bloodbank_id = $request['id'];
        $blood->patient_name = $request['name_patient'];
        $blood->patient_gender = $request['gender'];
        $blood->patient_age = $request['age'];
        $blood->nurse_name = $request['name_staff'];
        $blood->department = $request['department'];
        $blood->transfusion_date = $request['date_transfuss'];
        $blood->volume = $request['volume'];
        $blood->blood_product = $request['blood_product'];
        $blood->updated_by = Session::get('user')['user_id']; 
        $blood->update();

        $bloodbank = BloodBank::find($blood->bloodbank_id);

        if($bloodbank){
            $new_volume = $bloodbank->volume + $volume_old;
            $volume = $new_volume - $blood->volume;
            
            $bloodbank->volume = $volume;
            if($volume <= 0) {
                $bloodbank->status = 'Yes';
            } else{
                $bloodbank->status = 'No';
            }
            $bloodbank->updated_by = Session::get('user')['user_id'];
            $bloodbank->update(); 
        }

        $request->session()->flash('success', 'Blood Number '.$blood->bloodbank_id.' Checked out updated Successfully!!');

        return redirect('blood-transfussions');
    }

    public function deleteCheckout($id)
    {
        $blood = BloodTransfussionEpisode::find($id);

        if($blood){
            $volume_old = $blood->volume;

            $bloodbank = BloodBank::find($blood->bloodbank_id);

            if($bloodbank){
                $volume = $bloodbank->volume + $volume_old;
                
                $bloodbank->volume = $volume;
                if($volume <= 0) {
                    $bloodbank->status = 'Yes';
                } else{
                    $bloodbank->status = 'No';
                }
                $bloodbank->updated_by = Session::get('user')['user_id'];
                $bloodbank->update(); 
            }

            $blood->delete();

            Session::flash('success', 'Blood Number '.$blood->blood_number.' Checked out deleted Successfully!!');

            return redirect('blood-transfussions');
        }
    }
}
