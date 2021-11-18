<?php

namespace App\Http\Controllers;

use App\Models\BloodBank;
use App\Models\LabResultsGeneralLab;
use App\Models\LabResultsInfo;
use Illuminate\Http\Request;
use App\Models\Patient;
use Carbon\Carbon;
use App\Models\VWDropdown;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\VWBloodBankLabs;
use App\Models\VWBloodBank;
use App\Models\User;
use App\Models\VWHaematologyLab;
use App\Models\VWPatients;
use DateTime;

class GetdataController extends Controller
{
    static function selectOptions()
    {
        $department = VWDropdown::where('category_name', 'Department')->get();

        $response = VWDropdown::where('category_name', 'Response')->get();
        
        $art_screen = VWDropdown::where('category_name', 'ART Screening')->get();

        $bacterial_react = VWDropdown::where('category_name', 'Bacterial Reaction')->get();

        $g6pd = VWDropdown::where('category_name', 'G6PD')->get();

        $bf = VWDropdown::where('category_name', 'BF')->get();

        $Hgb_Elec = VWDropdown::where('category_name', 'Hgb Electrophoresis')->get();

        $widal = VWDropdown::where('category_name', 'Widal')->get();

        $appear = VWDropdown::where('category_name', 'Appearance')->get();

        $color = VWDropdown::where('category_name', 'Colour')->get();

        $factor = VWDropdown::where('category_name', 'Factors')->get();

        $urobiln = VWDropdown::where('category_name', 'Urobilnogen')->get();

        $ora = VWDropdown::where('category_name', 'Ora Quick')->get();

        $semen_mode = VWDropdown::where('category_name', 'Semen Collection Mode')->get();

        $semen_appear = VWDropdown::where('category_name', 'Semen Appearance')->get();

        $semen_visco = VWDropdown::where('category_name', 'Semen Viscosity')->get();

        $bacter_specimen = VWDropdown::where('category_name', 'Type of Bacteriology Specimen')->get();

        $bacter_type = VWDropdown::where('category_name', 'Type of Bacterials')->get();

        
        return [
            'department' => $department, 
            'response' => $response, 
            'art_screen' => $art_screen,
            'bacterial_react' => $bacterial_react,
            'g6pd' => $g6pd,
            'bf' => $bf,
            'Hgb_Elec' => $Hgb_Elec,
            'widal' => $widal,
            'appear' => $appear,
            'color' => $color,
            'factor' => $factor,
            'urobiln' => $urobiln,
            'ora' => $ora,
            'semen_mode' => $semen_mode,
            'semen_appear' => $semen_appear,
            'semen_visco' => $semen_visco,
            'bacter_specimen' => $bacter_specimen,
            'bacter_type' => $bacter_type,
            //'bacter_incub' => $bacter_incub
        ];
    }
    
    public function getPatientName(Request $request)
    {
        $patient = VWPatients::select('name', 'age')->where('opd_number', $request['opd_no'])->first();
        
        if($patient){
            // $age = Carbon::parse($patient->date_of_birth)->diff(Carbon::now())->y;
            $results = [
                'name' => $patient->name,
                'age' => $patient->age
            ];
        }
        else {
            $results = [
                'name' => '',
                'age' => ''
            ];
        }

        return response()->json($results);
    }

    public function getIsolate(Request $request)
    {
        if($request['isolate'] == 'No Growth' || $request['isolate'] == 'Heavily Mixed Growth'){
            $code = "Bacterial Incubation Time";
        }
        else{
            $code = "Type of Bacterials";
        }

        $isolate = VWDropdown::where('category_name', $code)->get();
        echo '<option></option>';
        foreach ($isolate as $bacterial) {
            echo'<option>'.$bacterial->dropdown.'</option>';
            }
    }

    public function getAntibiotics(Request $request)
    {
        $anti = VWDropdown::where('category_name', 'Antibiotics')->where('dropdown', 'LIKE', '%'.$request->antibiotic.'%')->get();

        foreach ($anti as $antibiotic) {
            echo "<option value='".$antibiotic->dropdown."'>";
        }
    }

    public function getLabNumberCheck(Request $request)
    {
        if(Session::get('user')['department'] == 'Main Lab'){
            $lab_no = 'M'.$request->lab_no;
          }else{
            $lab_no = 'R'.$request->lab_no;
          }

          $curryear = date("Y");

          $labs = LabResultsInfo::select('lab_number')->where('lab_number', $lab_no)->where(DB::raw('EXTRACT(YEAR FROM created_at)'), $curryear)->first();
          
          if($labs){
            echo '<script type="text/javascript">
                    alert("Entered Lab Number ('.$lab_no.') Already Exist");
                    document.getElementById("lab_no").value = "";
                    document.getElementById("lab_no").focus();

                </script>'; 
          }
            
    }

    public function getPatientInfo(Request $request)
    {
        $opd_no = $request['opd_no'];
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
        
        echo '<tbody>
            <tr>
                <td>Blood Group:</td>
                <td>'.$blood_group.'</td>
            </tr>
            <tr>
                <td>G6PD:</td>
                <td>'.$g6pd.'</td>
            </tr>
            <tr>
                <td>Sickling:</td>
                <td>'.$sickling.'</td>
            </tr>
            <tr>
                <td>Hgb Electrophoresis:</td>
                <td>'.$sickling_hb.'</td>
            </tr>
        </tbody>';   
    }

    public function getBloodNumberCheck(Request $request)
    {
        $curryear = date("Y");

        $bld = VWBloodBankLabs::select('blood_number')->where('blood_number', $request->bld_no)->where(DB::raw('EXTRACT(YEAR FROM created_at)'), $curryear)->first();
        
        if($bld){
        echo '<script type="text/javascript">
                alert("Entered Blood Number ('.$request->bld_no.') Already Exist");
                document.getElementById("bld").value = "";
                document.getElementById("bld").focus();

            </script>'; 
        }
            
    }

    public function getDonorName(Request $request)
    {
        $donor = VWBloodBankLabs::where('blood_number', $request['bld_no'])->first();

        if($donor){
            $results = [
                'name' => $donor->name,
                'blood' => $donor->blood
            ];
        } 
        else {
            $results = [
                'name' => '',
                'blood' => ''
            ];
        }

        return response()->json($results);
    }

    public function getBloodNumberCheck2(Request $request)
    {
        $curryear = date("Y");

        $bld = VWBloodBank::select('blood_number')->where('blood_number', $request->bld_no)->where(DB::raw('EXTRACT(YEAR FROM created_at)'), $curryear)->first();

        $bldlab = VWBloodBankLabs::select('status')->where('blood_number', $request->bld_no)->where(DB::raw('EXTRACT(YEAR FROM created_at)'), $curryear)->first();
        
        if($bld){
            echo '<script type="text/javascript">
                alert("Entered Blood Number ('.$request->bld_no.') has been stocked Already!!");
                document.getElementById("bld").value = "";
                document.getElementById("name").value = "";
                document.getElementById("blood_group").value = "";
                document.getElementById("bld").focus();

            </script>'; 
        }
        elseif($bldlab->status == 'Failed'){
            echo '<script type="text/javascript">
                alert("Entered Blood Number ('.$request->bld_no.') did not pass lab Test!!!");
                document.getElementById("bld").value = "";
                document.getElementById("name").value = "";
                document.getElementById("blood_group").value = "";
                document.getElementById("bld").focus();

            </script>'; 
        }
            
    }

    static function population(){

        $patient = Patient::count();

        $labs = LabResultsInfo::count();

        $users = User::count();

        $userlabs = LabResultsInfo::where('updated_by', Session::get('user')['user_id'])->count();

        $datagraph = VWHaematologyLab::select(DB::raw('gender, count(opd_number) AS y'))->groupBy('gender')->get();

        $labsResults = DB::select("SELECT (SELECT count(lab_info_id) FROM lab_results_infos WHERE lab_number LIKE 'M%' AND deleted_at IS NULL) AS main,
        (SELECT count(lab_info_id) FROM lab_results_infos WHERE lab_number LIKE 'R%' AND deleted_at IS NULL) AS rch");
        return [
            'patient' => $patient,
            'labs' => $labs,
            'userlabs' => $userlabs,
            'users' => $users,
            'datagraph' => $datagraph,
            'labsResults' => $labsResults[0]
        ];
    }

    public function getPatientSearch(Request $request)
    {
        if(is_numeric($request['search'])){
            $patients = VWPatients::where('opd_number', 'LIKE', '%'.$request['search'].'%')->orWhere('age', $request['search'])->get();
        }
        else{
            $patients = VWPatients::where('opd_number', 'LIKE', '%'.$request['search'].'%')->orWhere('name', 'LIKE', '%'.$request['search'].'%')->orWhere('gender', 'LIKE', '%'.$request['search'].'%')->get();
        }
        
        if($patients){
            $i = 1;
            // echo $patients;
            foreach ($patients as $patient) {
                echo '
                <tr>
                    <td>'.$i++.'</td>
                    <td>'.$patient->opd_number.'</td>
                    <td>'.$patient->name.'</td>
                    <td>'.$patient->date_of_birth.'</td>
                    <td>'.$patient->age.'</td>
                    <td>'.$patient->gender.'</td>
                    <td>
                    <div class="btn-group">
                        <a class="btn btn-success" href="edit-patient/'.$patient->patient_id.'" title="Edit Patient"><i class="fa fa-pencil-square-o"></i></a>
                        <a class="btn btn-danger" onclick="return confirm(\''.$patient->name.'  will be deleted permanently!!!\')" href="delete-patient/'.$patient->patient_id.'" title="Delete Patient"><i class="fa fa-trash-o"></i></a>
                    </div>
                    </td>
                </tr>
                ';
                }

        }
        else {
            $results = [
                'data' => ''
            ];

            return response()->json($results);
        }

        
    }

    public function getLabResultsSearch(Request $request)
    {
       
        $results = VWHaematologyLab::where('lab_number', 'LIKE', '%'.$request['search'].'%')
                                    ->orWhere('opd_number', 'LIKE', '%'.$request['search'].'%')
                                    ->orWhere('name', 'LIKE', '%'.$request['search'].'%')
                                    ->orWhere('gender', 'LIKE', '%'.$request['search'].'%')
                                    ->orWhere('dropdown', 'LIKE', '%'.$request['search'].'%')
                                    ->get();
        
        if($results){
            
            foreach ($results as $result) {
                $setdate = $result->updated_at->format('Y-m-d');
                $bday = new DateTime($setdate); // Your date of birth
                $today = new Datetime(date('m.d.y'));
                $diff = $today->diff($bday);
                $days = $diff->format('%d');
                echo '
                <tr>
                    <td>'.$result->lab_number.'</td>
                    <td>'.$result->opd_number.'</td>
                    <td>'.$result->dropdown.'</td>
                    <td>'.$result->name.'</td>
                    <td>'.$result->gender.'</td>
                    <td>'.$result->age.'</td>
                    <td>'.$result->updated_at.'</td>
                    <td>'.$result->user->username.'</td>
                    <td>
                    <div class="btn-group">
                        <a href="#" class="btn btn-primary" onclick="window.open(\'print-results/'.$result->lab_info_id.'\',\'\', \'left=0,top=0,width=1000,height=600,toolbar=0,scrollbars=0,status=0\')"><i class="fa fa-print"></i></a>';
                
                        if ((Session::get('user')['user_level'] === 'User') && $days <= 1){
                           echo '<a class="btn btn-success" href="edit-test/'.$result->lab_info_id.'" title="Edit"><i class="fa fa-pencil-square-o"></i></a>';
                        }
                        elseif ((Session::get('user')['user_level'] === 'Admin')){
                           echo '<a class="btn btn-success" href="edit-test/'.$result->lab_info_id.'" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                <a class="btn btn-danger" onclick="return confirm(\'This '.$result->lab_number.' Lab Number will be deleted permanently!!!\')" href="delete-labs/'.$result->lab_info_id.'" title="Delete"><i class="fa fa-trash-o"></i></a>';
                        }
                    echo'
                    
                    </div>
                    </td>
                </tr>
                ';
                }

        }
        else {
            $results = [
                'data' => ''
            ];

            return response()->json($results);
        }

        
    }

}
