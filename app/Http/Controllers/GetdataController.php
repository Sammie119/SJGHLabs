<?php

namespace App\Http\Controllers;

use App\Models\LabResultsGeneralLab;
use App\Models\LabResultsInfo;
use Illuminate\Http\Request;
use App\Models\Patient;
use Carbon\Carbon;
use App\Models\VWDropdown;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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
        $patient = Patient::select('name', 'date_of_birth')->where('opd_number', $request['opd_no'])->first();
        $age = Carbon::parse($patient->date_of_birth)->diff(Carbon::now())->y;
        $results = [
            'name' => $patient->name,
            'age' => $age
        ];

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
}
