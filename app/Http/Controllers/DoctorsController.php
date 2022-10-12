<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Investigations;
use App\Models\MedicalRequest;
use App\Models\VWHaematologyLab;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DoctorsController extends Controller
{
    protected function getDateOfBirth($age)
    {
        list($year,$month,$day) = explode("-", date("Y-01-01"));
        $range = $year - $age;
        return date('Y-m-d', strtotime("{$range}-{$month}-{$day}"));   
    }

    public function docGetLabResults()
    {
      return view('doc-get-labs');
    }

    static public function docViewResults(Request $request)
    {
      $patient = Patient::where('opd_number', $request->opd_no)->first();
      $labs = VWHaematologyLab::where('opd_number', $request->opd_no)->first();
      if(!$patient){
        $error = "OPD Number does not Exist!!";
        return view('doc-get-labs', compact('error'));
      }
      elseif(!$labs){
        $error = "No Labs Record Found";
        return view('doc-get-labs', compact('error'));
      }
      else{
        $results = VWHaematologyLab::where('opd_number', $request->opd_no)
                  ->orderBy('lab_info_id', 'DESC')->with('user')->get();
        
        $opd_no = $request->opd_no;
        $query = DB::select("SELECT (SELECT CONCAT(blood, ' (',blood_rh,')') FROM v_w_haematology_labs 
        WHERE blood IS NOT NULL AND opd_number = '$opd_no' LIMIT 1) AS blood_group, 
        (SELECT g6pd FROM v_w_haematology_labs WHERE g6pd IS NOT NULL AND opd_number = '$opd_no' LIMIT 1) AS g6pd, 
        (SELECT sickling FROM v_w_haematology_labs WHERE sickling IS NOT NULL AND opd_number = '$opd_no' LIMIT 1) AS sickling, 
        (SELECT sickling_hb FROM v_w_haematology_labs WHERE sickling_hb IS NOT NULL AND opd_number = '$opd_no' LIMIT 1) AS sickling_hb
        ");
        if(empty($query[0]->blood_group)){
            $blood_group =  'NULL';
        }else{
            $blood_group = $query[0]->blood_group;
        }

        if(empty($query[0]->g6pd)){
            $g6pd =  'NULL';
        }else{
            $g6pd = $query[0]->g6pd;
        }

        if(empty($query[0]->sickling)){
            $sickling =  'NULL';
        }else{
            $sickling = $query[0]->sickling;
        }

        if(empty($query[0]->sickling_hb)){
            $sickling_hb =  'NULL';
        }else{
            $sickling_hb = $query[0]->sickling_hb;
        }

        $static_info = [
          'blood_group' => $blood_group,
          'g6pd' => $g6pd,
          'sickling' => $sickling,
          'sickling_hb' => $sickling_hb
        ];

        return view('doc-get-labs', compact('results', 'static_info'));
      }
    }

    public function docRequestLabs()
    {
        $labs = MedicalRequest::orderByDesc('req_id')->limit(1000)->get();
        return view('doc-request-labs', ['labs' => $labs]);
    }

    public function medicalLabsRequest(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'opd_number' => 'required',
            'ins_status' => 'required',
            'lab_requests' => 'required'
        ],
        [
            'opd_number.required' => 'OPD Number is required',
            'ins_status.required' => 'Insurance Status field is required',
            'lab_requests.required' => 'No Labs added to Request',
        ]);
        
        if($request->has('id')){
            $labs = MedicalRequest::find($request->id);

            if($labs->status > 0){
                return back()->with('error', 'Sample Processing has started, you can edit. Please request a new lab!');
            }
        } else {
            $labs = new MedicalRequest;

            $patient = Patient::where('opd_number', $request->opd_number)->count();

            if($patient === 0){
                $patient = new Patient;
        
                $patient->opd_number = $request->opd_number;
                $patient->name = $request->name;
                $patient->date_of_birth = $this->getDateOfBirth($request->age);
                $patient->gender = $request->gender;
                $patient->created_by = Session::get('user')['user_id'];
                $patient->updated_by = Session::get('user')['user_id'];
                $patient->save();
            }
        }

        $labs->opd_number = $request->opd_number;
        $labs->ins_status = $request->ins_status;
        $labs->clinical_summary = $request->clinical_summary;
        $labs->lab_requests = $request->lab_requests;
        $labs->lab_alias = $this->getAliasFromLabRequests($request->lab_requests);
        $labs->amounts = $this->getAmountFromLabARequest($request->lab_requests, $request->ins_status);
        $labs->total_amount = array_sum($labs->amounts);
        $labs->department = $request->department;
        
        if($request->has('id')){
            $labs->updated_by = Session::get('user')['user_id'];

            $labs->update();

            return back()->with('success', 'Labs Requested Updated Successfully!!!');
        } else {
            $labs->created_by = Session::get('user')['user_id'];
            $labs->updated_by = Session::get('user')['user_id'];

            $labs->save();

            return back()->with('success', 'Labs Requested Saved Successfully!!!');
        }
    }


    public function docRequestForms($form, $id)
    {
        switch ($form) {
            case 'request':
                $labs = Investigations::select('description')->orderBy('description')->get();
                return view('forms.lab_request_form', ['labs' => $labs]);
                break;

            case 'edit':
                $labs = Investigations::select('description', 'invest_id')->get();
                $data = MedicalRequest::find($id);
                return view('forms.lab_request_form', ['labs' => $labs, 'data' => $data ]);
                break;

            case 'approve':
                $labs = Investigations::select('description', 'invest_id')->get();
                $data = MedicalRequest::find($id);
                return view('forms.approve_lab_request', ['labs' => $labs, 'data' => $data ]);
                break;

            case 'payment':
                $data = MedicalRequest::find($id);
                return view('forms.approve_lab_payment', ['data' => $data ]);
                break;
            
            default:
                return "No Form Selected";
                break;
        }
    
    }

    public function deleteRequest($id)
    {
        $req = MedicalRequest::where([['req_id', '=', $id], ['status', '=', 2], ['report', '=', 1]])->count();

        $labs = MedicalRequest::find($id);

        if($req >= 1){
            return back()->with('error', 'Lab Results is ready, so you cannot delete request!!!');
        } else {
            $labs->delete();

            return back()->with('success', 'Labs Requested Deleted Successfully!!!');
        }
    }

}
