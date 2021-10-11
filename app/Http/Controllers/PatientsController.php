<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PatientsController extends Controller
{
    public function index()
    {
        $patients = Patient::select('*')->orderBy('patient_id', 'DESC')->get();//paginate(7);

        return view('patients-list', compact('patients'));
    }

    public function create()
    {
        return view('add-patient');
    }

    public function store(Request $request)
    {
        $request->validate([
            'opd_no' => 'required|max:10|unique:patients,opd_number',
            'name' => 'required|max:255',
            'dob' => 'required|date',
            'gender' => 'required',

        ],
        [
            'opd_no.required' => 'OPD Number is required',
            'opd_no.max' => 'OPD Number must not be more than 10 Characters',
            'opd_no.regex' => 'OPD Number Entered is not an OPD number',
            'opd_no.unique' => 'OPD Number has already been taken',
            'name.required' => 'Name field is required',
            'dob.required' => 'Date of Birth is required',
            'dob.date' => 'Date of Birth must be a Data',
            'gender.required' => 'Gender is required'
        ]);
       
        $patient = new Patient;
        
        $patient->opd_number = $request['opd_no'];
        $patient->name = $request['name'];
        $patient->date_of_birth = $request['dob'];
        $patient->gender = $request['gender'];
        $patient->created_by = Session::get('user')['user_id'];
        $patient->updated_by = Session::get('user')['user_id'];
        $patient->save();

        $request->session()->flash('register', 'Patient with OPD No, '.$patient->opd_number.' registered Successfully!!');

        return redirect('patients-list');
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('edit-patient', compact('patient'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'opd_no' => 'required|max:10',
            'name' => 'required|max:255',
            'dob' => 'required|date',
            'gender' => 'required',

        ],
        [
            'opd_no.required' => 'OPD Number is required',
            'opd_no.max' => 'OPD Number must not be more than 10 Characters',
            'opd_no.regex' => 'OPD Number Entered is not an OPD number',
            'name.required' => 'Name field is required',
            'dob.required' => 'Date of Birth is required',
            'dob.date' => 'Date of Birth must be a Data',
            'gender.required' => 'Gender is required'
        ]);
       
        $patient = Patient::findOrFail($request->id);

        if($patient){
            $patient->opd_number = $request['opd_no'];
            $patient->name = $request['name'];
            $patient->date_of_birth = $request['dob'];
            $patient->gender = $request['gender'];
            $patient->updated_by = Session::get('user')['user_id'];
            $patient->update();

            $request->session()->flash('register', 'Patient with OPD No, '.$patient->opd_number.' updated Successfully!!');

            return redirect('patients-list');
        }
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);

        if($patient){
            $patient->delete();
            return back()->with('register', 'Patient deleted Successfully!!');
        }
    }
}
