<?php

namespace App\Http\Controllers;

use App\Models\LabResultsArtLab;
use App\Models\LabResultsBacteriology;
use App\Models\LabResultsCerebroFluid;
use App\Models\LabResultsCoomsLab;
use App\Models\LabResultsElectrolytes;
use App\Models\LabResultsFbcLab;
use App\Models\LabResultsGeneralLab;
use App\Models\LabResultsGlycatedHemo;
use App\Models\LabResultsHbProfile;
use App\Models\LabResultsHighVaginal;
use App\Models\LabResultsHpylori;
use App\Models\LabResultsInfo;
use App\Models\LabResultsLipidProfile;
use App\Models\LabResultsLiverFun;
use App\Models\LabResultsOgttLab;
use App\Models\LabResultsPeriFilm;
use App\Models\LabResultsPeritonealFluid;
use App\Models\LabResultsPleuralFluid;
use App\Models\LabResultsPsaLab;
use App\Models\LabResultsRenalFun;
use App\Models\LabResultsSemenLab;
use App\Models\LabResultsSerumLab;
use App\Models\LabResultsStool;
use App\Models\LabResultsUricAcid;
use App\Models\LabResultsUrinalysis;
use App\Models\Patient;
use App\Models\VWChemistriesLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VWDropdown;
use App\Models\VWHaematologyLab;
use App\Models\VWMicroBiologyLab;
use Illuminate\Support\Facades\Session;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class EnterTestController extends Controller
{
    public function index()
    {
      $results = VWHaematologyLab::orderBy('lab_info_id', 'DESC')->with('user')->get();
      
      return view('results', compact('results'));
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
        $results = VWHaematologyLab::where('opd_number', $request->opd_no)->orderBy('lab_info_id', 'DESC')
                ->where(DB::raw("deleted_at IS NOT NULL"))->with('user')->get();
        
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

    public function create()
    {        
      return view('enter-test');
    }

    public function getResults($id)
    {
      $haema = VWHaematologyLab::where('lab_info_id', $id)->with('dropdown')->first();
      $micro = VWMicroBiologyLab::where('lab_info_id', $id)->first();
      $chem = VWChemistriesLab::where('lab_info_id', $id)->first();
      return view('print-results', compact('haema', 'micro', 'chem'));
      //return response()->json($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lab_no' => 'required|max:10',
            'department' => 'required|numeric',
            'opd_no' => 'required|exists:patients,opd_number',
            'age' => 'required|numeric',

        ],
        [
            'lab_no.required' => 'Lab Number is required',
            'lab_no.max' => 'Lab Number must not be more than 10 Characters',
            'department.required' => 'department field is required',
            'opd_no.required' => 'OPD Number is required',
            'opd_no.exists' => 'OPD Number does not exists',
            'age.required' => 'Age is required'
        ]);

    //Lab Results Info.......................................    

        if(Session::get('user')['department'] == 'Main Lab'){
            $lab_no = 'M'.$request->lab_no;
          }else{
            $lab_no = 'R'.$request->lab_no;
          }

        $patient_id = Patient::where('opd_number', $request->opd_no)->first();
        $lab_info = new LabResultsInfo;
        $lab_info->patient_id = $patient_id->patient_id;
        $lab_info->department_id = $request['department'];
        $lab_info->lab_number = $lab_no;
        $lab_info->age = $request['age'];
        $lab_info->created_by = Session::get('user')['user_id'];
        $lab_info->updated_by = Session::get('user')['user_id'];
        $lab_info->save();

    //Lab Results General Labs..........................................

          $general = new LabResultsGeneralLab;
          $general->lab_info_id = $lab_info->lab_info_id;
          $general->anti_tpha = $request['anti_tpha'];
          $general->hbsag = $request['hbs_ag'];
          $general->hcv = $request['hcv'];
          $general->sel_fbs_rbs = $request['fbs_rbs_2'];
          $general->fbs = $request['fbs_rbs'];
          $general->blood = $request['blood'];
          $general->blood_rh = $request['blood_rh'];
          $general->g6pd = $request['g6pd'];
          $general->urine_hcg = $request['urine_hcg'];
          $general->bf = $request['bf'];
          $general->bf_parasite = $request['bf_parasite'];
          $general->esr = $request['esr'];
          $general->sickling = $request['sickling'];
          $general->sickling_hb = $request['sickling_hgb'];
          $general->widal_o = $request['widal_o'];
          $general->widal_h = $request['widal_h'];
          $general->rdt_pf = $request['rdt_pf'];
          $general->comment = $request['comment'];
          $general->save();

        //FBC Lab Results...........................................

          $fbc = new LabResultsFbcLab;
          $fbc->lab_info_id = $lab_info->lab_info_id;
          $fbc->wbc = $request['wbc'];
          $fbc->lym = $request['lym'];
          $fbc->mid = $request['mid'];
          $fbc->mono = $request['mono'];
          $fbc->eo = $request['eo'];
          $fbc->baso = $request['baso'];
          $fbc->neut = $request['neut'];
          $fbc->rbc = $request['rbc'];
          $fbc->fbc_hgb = $request['fbc_hgb'];
          $fbc->hct = $request['hct'];
          $fbc->mcv = $request['mcv'];
          $fbc->mch = $request['mch'];
          $fbc->rdw_cv = $request['rdw_cv'];
          $fbc->mpv = $request['mpv'];
          $fbc->plt = $request['plt'];
          $fbc->save();

        //Urinalysis Lab Results...........................................

          $urinalysis = new LabResultsUrinalysis;
          $urinalysis->lab_info_id = $lab_info->lab_info_id;
          $urinalysis->appear = $request['appear'];
          $urinalysis->color = $request['color'];
          $urinalysis->blood = $request['uri_blood'];
          $urinalysis->blood_factor = $request['blood_factor'];
          $urinalysis->urobiln = $request['urobiln'];
          $urinalysis->urobiln_factor = $request['urobiln_factor'];
          $urinalysis->glucose = $request['glucose'];
          $urinalysis->glucose_factor = $request['glucose_factor'];
          $urinalysis->nitrite = $request['nitrite'];
          $urinalysis->ph = $request['ph'];
          $urinalysis->bilirubin = $request['bilirubin'];
          $urinalysis->bilirubin_factor = $request['bilirubin_factor'];
          $urinalysis->ketone = $request['ketone'];
          $urinalysis->ketone_factor = $request['ketone_factor'];
          $urinalysis->protein = $request['protein'];
          $urinalysis->protein_factor = $request['protein_factor'];
          $urinalysis->leuco = $request['leuco'];
          $urinalysis->leuco_factor = $request['leuco_factor'];
          $urinalysis->spec_gra = $request['spec_gra'];
          $urinalysis->pus_cell = $request['pus_cell'];
          $urinalysis->red_cell = $request['red_cell'];
          $urinalysis->epi_cell = $request['epi_cell'];
          $urinalysis->other = $request['other'];
          $urinalysis->save();

        //Stool Lab Results...........................................
        
          $stool = new LabResultsStool;
          $stool->lab_info_id = $lab_info->lab_info_id;
          $stool->macro = $request['macro'];
          $stool->micro = $request['micro'];
          $stool->save();

        //ART Lab Results...........................................

          $art = new LabResultsArtLab;
          $art->lab_info_id = $lab_info->lab_info_id;
          $art->first_resp = $request['first_resp'];
          $art->ora_quick = $request['ora_quick'];
          $art->sd_bioline = $request['sd_bioline'];
          $art->save();

        //COOMS Lab Results...........................................

          $cooms = new LabResultsCoomsLab;
          $cooms->lab_info_id = $lab_info->lab_info_id;
          $cooms->indirect = $request['indirect'];
          $cooms->direct = $request['direct'];
          $cooms->save();

        //HB Profile Lab Results...........................................

          $hb_profile = new LabResultsHbProfile;
          $hb_profile->lab_info_id = $lab_info->lab_info_id;
          $hb_profile->hb_sag = $request['hb_sag'];
          $hb_profile->hb_sab = $request['hb_sab'];
          $hb_profile->hb_eag = $request['hb_eag'];
          $hb_profile->hb_eab = $request['hb_eab'];
          $hb_profile->hb_cab = $request['hb_cab'];
          $hb_profile->hb_comment = $request['hb_comment'];
          $hb_profile->save();

        //Peripheral Film Lab Results...........................................
          
          $peri_films = new LabResultsPeriFilm;
          $peri_films->lab_info_id = $lab_info->lab_info_id;
          $peri_films->per_rbc = $request['per_rbc'];
          $peri_films->per_wbc = $request['per_wbc'];
          $peri_films->per_plt = $request['per_plt'];
          $peri_films->per_imp = $request['per_imp'];
          $peri_films->save();

        //Semen Film Lab Results...........................................
          
          $semen = new LabResultsSemenLab;
          $semen->lab_info_id = $lab_info->lab_info_id;
          $semen->semen_date = $request['semen_date'];
          $semen->semen_dura = $request['semen_dura'];
          $semen->semen_diff = $request['semen_diff'];
          $semen->semen_all = $request['semen_all'];
          $semen->semen_mode = $request['semen_mode'];
          $semen->semen_inter = $request['semen_inter'];
          $semen->semen_vol = $request['semen_vol'];
          $semen->semen_appear = $request['semen_appear'];
          $semen->semen_liquefaction = $request['semen_liquefaction'];
          $semen->semen_viscosity = $request['semen_viscosity'];
          $semen->semen_ph = $request['semen_ph'];
          $semen->semen_rapid = $request['semen_rapid'];
          $semen->semen_none = $request['semen_none'];
          $semen->semen_imm = $request['semen_imm'];
          $semen->semen_vital = $request['semen_vital'];
          $semen->semen_wbc = $request['semen_wbc'];
          $semen->semen_count = $request['semen_count'];
          $semen->semen_totalc = $request['semen_totalc'];
          $semen->semen_normal = $request['semen_normal'];
          $semen->semen_abn = $request['semen_abn'];
          $semen->semen_head = $request['semen_head'];
          $semen->semen_mid = $request['semen_mid'];
          $semen->semen_tail = $request['semen_tail'];
          $semen->semen_comment = $request['semen_comment'];
          $semen->save();

        //OGTT Lab Results...........................................
        
          $ogtt = new LabResultsOgttLab;
          $ogtt->lab_info_id = $lab_info->lab_info_id;
          $ogtt->oral_glucose = $request['oral_glucose'];
          $ogtt->oral_1hpost = $request['oral_1hpost'];
          $ogtt->oral_1_30post = $request['oral_1_30post'];
          $ogtt->oral_post = $request['oral_post'];
          $ogtt->oral_glu = $request['oral_glu'];
          $ogtt->oglu_f = $request['oglu_f'];
          $ogtt->oral_pro = $request['oral_pro'];
          $ogtt->opro_f = $request['opro_f'];
          $ogtt->oral_ninpro = $request['oral_ninpro'];
          $ogtt->opro_ninf = $request['opro_ninf'];
          $ogtt->oral_comment = $request['oral_comment'];
          $ogtt->fst_min = $request['fst_min'];
          $ogtt->snd_min = $request['snd_min'];
          $ogtt->thd_min = $request['thd_min'];
          $ogtt->for_min = $request['for_min'];
          $ogtt->save();

        //PSA Lab Results...........................................

          $psa = new LabResultsPsaLab;
          $psa->lab_info_id = $lab_info->lab_info_id;
          $psa->psa = $request['psa'];
          $psa->psa_positive = $request['psa_positive'];
          $psa->psa_negative = $request['psa_negative'];
          $psa->psa_comment = $request['psa_comment'];
          $psa->save();

        //H Pylori Lab Results...........................................

          $hpylori = new LabResultsHpylori;
          $hpylori->lab_info_id = $lab_info->lab_info_id;
          $hpylori->pylori_qual = $request['pylori_qual'];
          $hpylori->pylori_comment = $request['pylori_comment'];
          $hpylori->save();
          
        //Liver Function Lab Results...........................................

          $liver = new LabResultsLiverFun;
          $liver->lab_info_id = $lab_info->lab_info_id;
          $liver->liver_protein = $request['liver_protein'];
          $liver->liver_albumin = $request['liver_albumin'];
          $liver->liver_globulin = $request['liver_globulin'];
          $liver->liver_alkaline = $request['liver_alkaline'];
          $liver->liver_alanine = $request['liver_alanine'];
          $liver->liver_aspartate = $request['liver_aspartate'];
          $liver->liver_gamma = $request['liver_gamma'];
          $liver->liver_total = $request['liver_total'];
          $liver->liver_direct = $request['liver_direct'];
          $liver->liver_indirect = $request['liver_indirect'];
          $liver->liver_comment = $request['liver_comment'];
          $liver->save();

        //Renal Function Lab Results...........................................

          $renal = new LabResultsRenalFun;
          $renal->lab_info_id = $lab_info->lab_info_id;
          $renal->renal_urea = $request['renal_urea'];
          $renal->renal_creatinine = $request['renal_creatinine'];
          $renal->renal_comment = $request['renal_comment'];
          $renal->save();

        //Lipid Profile Lab Results...........................................
        
          $lipid = new LabResultsLipidProfile;
          $lipid->lab_info_id = $lab_info->lab_info_id;
          $lipid->lipid_total = $request['lipid_total'];
          $lipid->lipid_trigly = $request['lipid_trigly'];
          $lipid->lipid_hdl = $request['lipid_hdl'];
          $lipid->lipid_ldl = $request['lipid_ldl'];
          $lipid->lipid_comment = $request['lipid_comment'];
          $lipid->save();

        //Electrolytes Lab Results...........................................

          $electrolytes = new LabResultsElectrolytes;
          $electrolytes->lab_info_id = $lab_info->lab_info_id;
          $electrolytes->electro_potas = $request['electro_potas'];
          $electrolytes->electro_sodium = $request['electro_sodium'];
          $electrolytes->electro_chloride = $request['electro_chloride'];
          $electrolytes->electro_cca = $request['electro_cca'];
          $electrolytes->electro_ica = $request['electro_ica'];
          $electrolytes->electro_tca = $request['electro_tca'];
          $electrolytes->electro_ph = $request['electro_ph'];
          $electrolytes->electro_comment = $request['electro_comment'];
          $electrolytes->save();

        //Uric Acid Lab Results...........................................
          
          $uric = new LabResultsUricAcid;
          $uric->lab_info_id = $lab_info->lab_info_id;
          $uric->uric_acid = $request['uric_acid'];
          $uric->uric_comment = $request['uric_comment'];
          $uric->save();

        //Glycated Hemoglobin Lab Results...........................................

          $glycated = new LabResultsGlycatedHemo;
          $glycated->lab_info_id = $lab_info->lab_info_id;
          $glycated->glycated_hba1c = $request['glycated_hba1c'];
          $glycated->glycated_comment = $request['glycated_comment'];
          $glycated->save();

        //Serum Bilirubin Lab Results...............................................

          $serum = new LabResultsSerumLab;
          $serum->lab_info_id = $lab_info->lab_info_id;
          $serum->serum_total = $request['serum_total'];
          $serum->serum_direct = $request['serum_direct'];
          $serum->serum_indirect = $request['serum_indirect'];
          $serum->serum_comment = $request['serum_comment'];
          $serum->save();

        //High Vaginal Swab Lab Results...............................................
          
          $vaginal = new LabResultsHighVaginal;
          $vaginal->lab_info_id = $lab_info->lab_info_id;
          $vaginal->vaginal_epith = $request['vaginal_epith'];
          $vaginal->vaginal_pus = $request['vaginal_pus'];
          $vaginal->vaginal_red = $request['vaginal_red'];
          $vaginal->vaginal_clue = $request['vaginal_clue'];
          $vaginal->vaginal_whiff = $request['vaginal_whiff'];
          $vaginal->vaginal_koh = $request['vaginal_koh'];
          $vaginal->vaginal_tricho = $request['vaginal_tricho'];
          $vaginal->vaginal_gram = $request['vaginal_gram'];
          $vaginal->vaginal_others = $request['vaginal_others'];
          $vaginal->save();

        //Pleural Fluid Swab Lab Results...............................................
          
          $pleural = new LabResultsPleuralFluid;
          $pleural->lab_info_id = $lab_info->lab_info_id;
          $pleural->pleural_appear = $request['pleural_appear'];
          $pleural->pleural_color = $request['pleural_color'];
          $pleural->pleural_ph = $request['pleural_ph'];
          $pleural->pleural_spec = $request['pleural_spec'];
          $pleural->pleural_protein = $request['pleural_protein'];
          $pleural->pleural_glucose = $request['pleural_glucose'];
          $pleural->pleural_total = $request['pleural_total'];
          $pleural->pleural_count = $request['pleural_count'];
          $pleural->pleural_type = $request['pleural_type'];
          $pleural->pleural_gram = $request['pleural_gram'];
          $pleural->pleural_culture = $request['pleural_culture'];
          $pleural->pleural_comment = $request['pleural_comment'];
          $pleural->save();

        //Peritoneal Fluid Lab Results...............................................

          $peritoneal = new LabResultsPeritonealFluid;
          $peritoneal->lab_info_id = $lab_info->lab_info_id;
          $peritoneal->peritoneal_appear = $request['peritoneal_appear'];
          $peritoneal->peritoneal_color = $request['peritoneal_color'];
          $peritoneal->peritoneal_spec = $request['peritoneal_spec'];
          $peritoneal->peritoneal_protein = $request['peritoneal_protein'];
          $peritoneal->peritoneal_albumin = $request['peritoneal_albumin'];
          $peritoneal->peritoneal_glucose = $request['peritoneal_glucose'];
          $peritoneal->peritoneal_alkaline = $request['peritoneal_alkaline'];
          $peritoneal->peritoneal_amylase = $request['peritoneal_amylase'];
          $peritoneal->peritoneal_count = $request['peritoneal_count'];
          $peritoneal->peritoneal_type = $request['peritoneal_type'];
          $peritoneal->peritoneal_gram = $request['peritoneal_gram'];
          $peritoneal->peritoneal_comment = $request['peritoneal_comment'];
          $peritoneal->save();

        //Cerebrospinal (CSF) Fluid Lab Results...............................................

          $cerebro = new LabResultsCerebroFluid;
          $cerebro->lab_info_id = $lab_info->lab_info_id;
          $cerebro->csf_appear = $request['csf_appear'];
          $cerebro->csf_color = $request['csf_color'];
          $cerebro->csf_protein = $request['csf_protein'];
          $cerebro->csf_glucose = $request['csf_glucose'];
          $cerebro->csf_globulin = $request['csf_globulin'];
          $cerebro->csf_count = $request['csf_count'];
          $cerebro->csf_type = $request['csf_type'];
          $cerebro->csf_gram = $request['csf_gram'];
          $cerebro->csf_comment = $request['csf_comment'];
          $cerebro->save();

        //Bacteriology Lab Results...............................................
          
          $bacter = new LabResultsBacteriology;
          $bacter->lab_info_id = $lab_info->lab_info_id;
          $bacter->bacter_specimen = $request['bacter_specimen'];
          $bacter->bacter_growth = $request['bacter_growth'];
          $bacter->bacter_type1 = $request['bacter_type1'];
          $bacter->bacter_type2 = $request['bacter_type2'];
          $bacter->bacter_anti1 = $request['bacter_anti1'];
          $bacter->bacter_react1 = $request['bacter_react1'];
          $bacter->bacter_zone1 = $request['bacter_zone1'];
          $bacter->bacter_anti2 = $request['bacter_anti2'];
          $bacter->bacter_react2 = $request['bacter_react2'];
          $bacter->bacter_zone2 = $request['bacter_zone2'];
          $bacter->bacter_anti3 = $request['bacter_anti3'];
          $bacter->bacter_react3 = $request['bacter_react3'];
          $bacter->bacter_zone3 = $request['bacter_zone3'];
          $bacter->bacter_anti4 = $request['bacter_anti4'];
          $bacter->bacter_react4 = $request['bacter_react4'];
          $bacter->bacter_zone4 = $request['bacter_zone4'];
          $bacter->bacter_anti5 = $request['bacter_anti5'];
          $bacter->bacter_react5 = $request['bacter_react5'];
          $bacter->bacter_zone5 = $request['bacter_zone5'];
          $bacter->bacter_anti6 = $request['bacter_anti6'];
          $bacter->bacter_react6 = $request['bacter_react6'];
          $bacter->bacter_zone6 = $request['bacter_zone6'];
          $bacter->bacter_anti7 = $request['bacter_anti7'];
          $bacter->bacter_react7 = $request['bacter_react7'];
          $bacter->bacter_zone7 = $request['bacter_zone7'];
          $bacter->bacter_anti8 = $request['bacter_anti8'];
          $bacter->bacter_react8 = $request['bacter_react8'];
          $bacter->bacter_zone8 = $request['bacter_zone8'];
          $bacter->bacter_anti9 = $request['bacter_anti9'];
          $bacter->bacter_react9 = $request['bacter_react9'];
          $bacter->bacter_zone9 = $request['bacter_zone9'];
          $bacter->bacter_anti10 = $request['bacter_anti10'];
          $bacter->bacter_react10 = $request['bacter_react10'];
          $bacter->bacter_zone10 = $request['bacter_zone10'];
          $bacter->bacter_anti11 = $request['bacter_anti11'];
          $bacter->bacter_react11 = $request['bacter_react11'];
          $bacter->bacter_zone11 = $request['bacter_zone11'];
          $bacter->bacter_anti12 = $request['bacter_anti12'];
          $bacter->bacter_react12 = $request['bacter_react12'];
          $bacter->bacter_zone12 = $request['bacter_zone12'];
          $bacter->becter_comment = $request['becter_comment'];
          $bacter->save();

        Session::flash('success', 'Lab Results Saved Successfully!!');

        return "<script>
          window.open('print-results/$lab_info->lab_info_id','','left=0,top=0,width=1000,height=600,toolbar=0,scrollbars=0,status=0');
          window.location = 'enter-test';
          </script>";


          //return back()->with('success', 'Lab Results Saved Successfully!!');

    }

    public function edit($id)
    {
      $haema = VWHaematologyLab::where('lab_info_id', $id)->with('dropdown')->first();
      $micro = VWMicroBiologyLab::where('lab_info_id', $id)->first();
      $chem = VWChemistriesLab::where('lab_info_id', $id)->first();
      return view('edit-test', compact('haema', 'micro', 'chem'));
    }

    public function update(Request $request)
    {
      $request->validate([
          'lab_no' => 'required|max:10',
          'department' => 'required|numeric',
          'opd_no' => 'required|exists:patients,opd_number',
          'age' => 'required|numeric',

      ],
      [
          'lab_no.required' => 'Lab Number is required',
          'lab_no.max' => 'Lab Number must not be more than 10 Characters',
          'department.required' => 'department field is required',
          'opd_no.required' => 'OPD Number is required',
          'opd_no.exists' => 'OPD Number does not exists',
          'age.required' => 'Age is required'
      ]);

  //Lab Results Info.......................................    

      $patient_id = Patient::where('opd_number', $request->opd_no)->first();

      $lab_info = LabResultsInfo::findOrFail($request->id);

      if($lab_info){
        $lab_info->patient_id = $patient_id->patient_id;
        $lab_info->department_id = $request['department'];
        $lab_info->lab_number = $request['lab_no'];
        $lab_info->age = $request['age'];
        $lab_info->updated_by = Session::get('user')['user_id'];
        $lab_info->update();
      }

  //Lab Results General Labs..........................................

        $general = LabResultsGeneralLab::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($general) {
          $general->anti_tpha = $request['anti_tpha'];
          $general->hbsag = $request['hbs_ag'];
          $general->hcv = $request['hcv'];
          $general->sel_fbs_rbs = $request['fbs_rbs_2'];
          $general->fbs = $request['fbs_rbs'];
          $general->blood = $request['blood'];
          $general->blood_rh = $request['blood_rh'];
          $general->g6pd = $request['g6pd'];
          $general->urine_hcg = $request['urine_hcg'];
          $general->bf = $request['bf'];
          $general->bf_parasite = $request['bf_parasite'];
          $general->esr = $request['esr'];
          $general->sickling = $request['sickling'];
          $general->sickling_hb = $request['sickling_hgb'];
          $general->widal_o = $request['widal_o'];
          $general->widal_h = $request['widal_h'];
          $general->rdt_pf = $request['rdt_pf'];
          $general->comment = $request['comment'];
          $general->update();
        }

      //FBC Lab Results...........................................

        $fbc = LabResultsFbcLab::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($fbc) {
          $fbc->wbc = $request['wbc'];
          $fbc->lym = $request['lym'];
          $fbc->mid = $request['mid'];
          $fbc->mono = $request['mono'];
          $fbc->eo = $request['eo'];
          $fbc->baso = $request['baso'];
          $fbc->neut = $request['neut'];
          $fbc->rbc = $request['rbc'];
          $fbc->fbc_hgb = $request['fbc_hgb'];
          $fbc->hct = $request['hct'];
          $fbc->mcv = $request['mcv'];
          $fbc->mch = $request['mch'];
          $fbc->rdw_cv = $request['rdw_cv'];
          $fbc->mpv = $request['mpv'];
          $fbc->plt = $request['plt'];
          $fbc->update();
        }

      //Urinalysis Lab Results...........................................

        $urinalysis = LabResultsUrinalysis::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($urinalysis){
          $urinalysis->appear = $request['appear'];
          $urinalysis->color = $request['color'];
          $urinalysis->blood = $request['uri_blood'];
          $urinalysis->blood_factor = $request['blood_factor'];
          $urinalysis->urobiln = $request['urobiln'];
          $urinalysis->urobiln_factor = $request['urobiln_factor'];
          $urinalysis->glucose = $request['glucose'];
          $urinalysis->glucose_factor = $request['glucose_factor'];
          $urinalysis->nitrite = $request['nitrite'];
          $urinalysis->ph = $request['ph'];
          $urinalysis->bilirubin = $request['bilirubin'];
          $urinalysis->bilirubin_factor = $request['bilirubin_factor'];
          $urinalysis->ketone = $request['ketone'];
          $urinalysis->ketone_factor = $request['ketone_factor'];
          $urinalysis->protein = $request['protein'];
          $urinalysis->protein_factor = $request['protein_factor'];
          $urinalysis->leuco = $request['leuco'];
          $urinalysis->leuco_factor = $request['leuco_factor'];
          $urinalysis->spec_gra = $request['spec_gra'];
          $urinalysis->pus_cell = $request['pus_cell'];
          $urinalysis->red_cell = $request['red_cell'];
          $urinalysis->epi_cell = $request['epi_cell'];
          $urinalysis->other = $request['other'];
          $urinalysis->update();
        }

      //Stool Lab Results...........................................
      
        $stool = LabResultsStool::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($stool){
          $stool->macro = $request['macro'];
          $stool->micro = $request['micro'];
          $stool->update();
        }

      //ART Lab Results...........................................

        $art = LabResultsArtLab::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($art){
          $art->first_resp = $request['first_resp'];
          $art->ora_quick = $request['ora_quick'];
          $art->sd_bioline = $request['sd_bioline'];
          $art->update();
        }

      //COOMS Lab Results...........................................

        $cooms = LabResultsCoomsLab::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($cooms){
          $cooms->indirect = $request['indirect'];
          $cooms->direct = $request['direct'];
          $cooms->update();
        }

      //HB Profile Lab Results...........................................

        $hb_profile = LabResultsHbProfile::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($hb_profile){
          $hb_profile->hb_sag = $request['hb_sag'];
          $hb_profile->hb_sab = $request['hb_sab'];
          $hb_profile->hb_eag = $request['hb_eag'];
          $hb_profile->hb_eab = $request['hb_eab'];
          $hb_profile->hb_cab = $request['hb_cab'];
          $hb_profile->hb_comment = $request['hb_comment'];
          $hb_profile->update();
        }

      //Peripheral Film Lab Results...........................................
        
        $peri_films = LabResultsPeriFilm::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($peri_films){
          $peri_films->per_rbc = $request['per_rbc'];
          $peri_films->per_wbc = $request['per_wbc'];
          $peri_films->per_plt = $request['per_plt'];
          $peri_films->per_imp = $request['per_imp'];
          $peri_films->update();
        }

      //Semen Film Lab Results...........................................
        
        $semen = LabResultsSemenLab::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($semen){
          $semen->semen_date = $request['semen_date'];
          $semen->semen_dura = $request['semen_dura'];
          $semen->semen_diff = $request['semen_diff'];
          $semen->semen_all = $request['semen_all'];
          $semen->semen_mode = $request['semen_mode'];
          $semen->semen_inter = $request['semen_inter'];
          $semen->semen_vol = $request['semen_vol'];
          $semen->semen_appear = $request['semen_appear'];
          $semen->semen_liquefaction = $request['semen_liquefaction'];
          $semen->semen_viscosity = $request['semen_viscosity'];
          $semen->semen_ph = $request['semen_ph'];
          $semen->semen_rapid = $request['semen_rapid'];
          $semen->semen_none = $request['semen_none'];
          $semen->semen_imm = $request['semen_imm'];
          $semen->semen_vital = $request['semen_vital'];
          $semen->semen_wbc = $request['semen_wbc'];
          $semen->semen_count = $request['semen_count'];
          $semen->semen_totalc = $request['semen_totalc'];
          $semen->semen_normal = $request['semen_normal'];
          $semen->semen_abn = $request['semen_abn'];
          $semen->semen_head = $request['semen_head'];
          $semen->semen_mid = $request['semen_mid'];
          $semen->semen_tail = $request['semen_tail'];
          $semen->semen_comment = $request['semen_comment'];
          $semen->update();
        }

      //OGTT Lab Results...........................................
      
        $ogtt = LabResultsOgttLab::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($ogtt){
          $ogtt->oral_glucose = $request['oral_glucose'];
          $ogtt->oral_1hpost = $request['oral_1hpost'];
          $ogtt->oral_1_30post = $request['oral_1_30post'];
          $ogtt->oral_post = $request['oral_post'];
          $ogtt->oral_glu = $request['oral_glu'];
          $ogtt->oglu_f = $request['oglu_f'];
          $ogtt->oral_pro = $request['oral_pro'];
          $ogtt->opro_f = $request['opro_f'];
          $ogtt->oral_ninpro = $request['oral_ninpro'];
          $ogtt->opro_ninf = $request['opro_ninf'];
          $ogtt->oral_comment = $request['oral_comment'];
          $ogtt->fst_min = $request['fst_min'];
          $ogtt->snd_min = $request['snd_min'];
          $ogtt->thd_min = $request['thd_min'];
          $ogtt->for_min = $request['for_min'];
          $ogtt->update();
        }

      //PSA Lab Results...........................................

        $psa = LabResultsPsaLab::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($psa){
          $psa->psa = $request['psa'];
          $psa->psa_positive = $request['psa_positive'];
          $psa->psa_negative = $request['psa_negative'];
          $psa->psa_comment = $request['psa_comment'];
          $psa->update();
        }

      //H Pylori Lab Results...........................................

        $hpylori = LabResultsHpylori::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($hpylori){
          $hpylori->pylori_qual = $request['pylori_qual'];
          $hpylori->pylori_comment = $request['pylori_comment'];
          $hpylori->update();
        }
        
      //Liver Function Lab Results...........................................

        $liver = LabResultsLiverFun::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($liver){
          $liver->liver_protein = $request['liver_protein'];
          $liver->liver_albumin = $request['liver_albumin'];
          $liver->liver_globulin = $request['liver_globulin'];
          $liver->liver_alkaline = $request['liver_alkaline'];
          $liver->liver_alanine = $request['liver_alanine'];
          $liver->liver_aspartate = $request['liver_aspartate'];
          $liver->liver_gamma = $request['liver_gamma'];
          $liver->liver_total = $request['liver_total'];
          $liver->liver_direct = $request['liver_direct'];
          $liver->liver_indirect = $request['liver_indirect'];
          $liver->liver_comment = $request['liver_comment'];
          $liver->update();
        }

      //Renal Function Lab Results...........................................

        $renal = LabResultsRenalFun::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($renal){
          $renal->renal_urea = $request['renal_urea'];
          $renal->renal_creatinine = $request['renal_creatinine'];
          $renal->renal_comment = $request['renal_comment'];
          $renal->update();
        }

      //Lipid Profile Lab Results...........................................
      
        $lipid = LabResultsLipidProfile::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($lipid){
          $lipid->lipid_total = $request['lipid_total'];
          $lipid->lipid_trigly = $request['lipid_trigly'];
          $lipid->lipid_hdl = $request['lipid_hdl'];
          $lipid->lipid_ldl = $request['lipid_ldl'];
          $lipid->lipid_comment = $request['lipid_comment'];
          $lipid->update();
        }

      //Electrolytes Lab Results...........................................

        $electrolytes = LabResultsElectrolytes::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($electrolytes){
          $electrolytes->electro_potas = $request['electro_potas'];
          $electrolytes->electro_sodium = $request['electro_sodium'];
          $electrolytes->electro_chloride = $request['electro_chloride'];
          $electrolytes->electro_cca = $request['electro_cca'];
          $electrolytes->electro_ica = $request['electro_ica'];
          $electrolytes->electro_tca = $request['electro_tca'];
          $electrolytes->electro_ph = $request['electro_ph'];
          $electrolytes->electro_comment = $request['electro_comment'];
          $electrolytes->update();
        }

      //Uric Acid Lab Results...........................................
        
        $uric = LabResultsUricAcid::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($uric){
          $uric->uric_acid = $request['uric_acid'];
          $uric->uric_comment = $request['uric_comment'];
          $uric->update();
        }

      //Glycated Hemoglobin Lab Results...........................................

        $glycated = LabResultsGlycatedHemo::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($glycated){
          $glycated->glycated_hba1c = $request['glycated_hba1c'];
          $glycated->glycated_comment = $request['glycated_comment'];
          $glycated->update();
        }

      //Serum Bilirubin Lab Results...............................................

        $serum = LabResultsSerumLab::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($serum){
          $serum->serum_total = $request['serum_total'];
          $serum->serum_direct = $request['serum_direct'];
          $serum->serum_indirect = $request['serum_indirect'];
          $serum->serum_comment = $request['serum_comment'];
          $serum->update();
        }

      //High Vaginal Swab Lab Results...............................................
        
        $vaginal = LabResultsHighVaginal::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($vaginal){
          $vaginal->vaginal_epith = $request['vaginal_epith'];
          $vaginal->vaginal_pus = $request['vaginal_pus'];
          $vaginal->vaginal_red = $request['vaginal_red'];
          $vaginal->vaginal_clue = $request['vaginal_clue'];
          $vaginal->vaginal_whiff = $request['vaginal_whiff'];
          $vaginal->vaginal_koh = $request['vaginal_koh'];
          $vaginal->vaginal_tricho = $request['vaginal_tricho'];
          $vaginal->vaginal_gram = $request['vaginal_gram'];
          $vaginal->vaginal_others = $request['vaginal_others'];
          $vaginal->update();
        }

      //Pleural Fluid Swab Lab Results...............................................
        
        $pleural = LabResultsPleuralFluid::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($pleural){
          $pleural->pleural_appear = $request['pleural_appear'];
          $pleural->pleural_color = $request['pleural_color'];
          $pleural->pleural_ph = $request['pleural_ph'];
          $pleural->pleural_spec = $request['pleural_spec'];
          $pleural->pleural_protein = $request['pleural_protein'];
          $pleural->pleural_glucose = $request['pleural_glucose'];
          $pleural->pleural_total = $request['pleural_total'];
          $pleural->pleural_count = $request['pleural_count'];
          $pleural->pleural_type = $request['pleural_type'];
          $pleural->pleural_gram = $request['pleural_gram'];
          $pleural->pleural_culture = $request['pleural_culture'];
          $pleural->pleural_comment = $request['pleural_comment'];
          $pleural->update();
        }

      //Peritoneal Fluid Lab Results...............................................

        $peritoneal = LabResultsPeritonealFluid::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($peritoneal){
          $peritoneal->peritoneal_appear = $request['peritoneal_appear'];
          $peritoneal->peritoneal_color = $request['peritoneal_color'];
          $peritoneal->peritoneal_spec = $request['peritoneal_spec'];
          $peritoneal->peritoneal_protein = $request['peritoneal_protein'];
          $peritoneal->peritoneal_albumin = $request['peritoneal_albumin'];
          $peritoneal->peritoneal_glucose = $request['peritoneal_glucose'];
          $peritoneal->peritoneal_alkaline = $request['peritoneal_alkaline'];
          $peritoneal->peritoneal_amylase = $request['peritoneal_amylase'];
          $peritoneal->peritoneal_count = $request['peritoneal_count'];
          $peritoneal->peritoneal_type = $request['peritoneal_type'];
          $peritoneal->peritoneal_gram = $request['peritoneal_gram'];
          $peritoneal->peritoneal_comment = $request['peritoneal_comment'];
          $peritoneal->update();
        }

      //Cerebrospinal (CSF) Fluid Lab Results...............................................

        $cerebro = LabResultsCerebroFluid::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($cerebro){
          $cerebro->csf_appear = $request['csf_appear'];
          $cerebro->csf_color = $request['csf_color'];
          $cerebro->csf_protein = $request['csf_protein'];
          $cerebro->csf_glucose = $request['csf_glucose'];
          $cerebro->csf_globulin = $request['csf_globulin'];
          $cerebro->csf_count = $request['csf_count'];
          $cerebro->csf_type = $request['csf_type'];
          $cerebro->csf_gram = $request['csf_gram'];
          $cerebro->csf_comment = $request['csf_comment'];
          $cerebro->update();
        }

      //Bacteriology Lab Results...............................................
        
        $bacter = LabResultsBacteriology::where('lab_info_id', $lab_info->lab_info_id)->first();
        if($bacter){
          $bacter->bacter_specimen = $request['bacter_specimen'];
          $bacter->bacter_growth = $request['bacter_growth'];
          $bacter->bacter_type1 = $request['bacter_type1'];
          $bacter->bacter_type2 = $request['bacter_type2'];
          $bacter->bacter_anti1 = $request['bacter_anti1'];
          $bacter->bacter_react1 = $request['bacter_react1'];
          $bacter->bacter_zone1 = $request['bacter_zone1'];
          $bacter->bacter_anti2 = $request['bacter_anti2'];
          $bacter->bacter_react2 = $request['bacter_react2'];
          $bacter->bacter_zone2 = $request['bacter_zone2'];
          $bacter->bacter_anti3 = $request['bacter_anti3'];
          $bacter->bacter_react3 = $request['bacter_react3'];
          $bacter->bacter_zone3 = $request['bacter_zone3'];
          $bacter->bacter_anti4 = $request['bacter_anti4'];
          $bacter->bacter_react4 = $request['bacter_react4'];
          $bacter->bacter_zone4 = $request['bacter_zone4'];
          $bacter->bacter_anti5 = $request['bacter_anti5'];
          $bacter->bacter_react5 = $request['bacter_react5'];
          $bacter->bacter_zone5 = $request['bacter_zone5'];
          $bacter->bacter_anti6 = $request['bacter_anti6'];
          $bacter->bacter_react6 = $request['bacter_react6'];
          $bacter->bacter_zone6 = $request['bacter_zone6'];
          $bacter->bacter_anti7 = $request['bacter_anti7'];
          $bacter->bacter_react7 = $request['bacter_react7'];
          $bacter->bacter_zone7 = $request['bacter_zone7'];
          $bacter->bacter_anti8 = $request['bacter_anti8'];
          $bacter->bacter_react8 = $request['bacter_react8'];
          $bacter->bacter_zone8 = $request['bacter_zone8'];
          $bacter->bacter_anti9 = $request['bacter_anti9'];
          $bacter->bacter_react9 = $request['bacter_react9'];
          $bacter->bacter_zone9 = $request['bacter_zone9'];
          $bacter->bacter_anti10 = $request['bacter_anti10'];
          $bacter->bacter_react10 = $request['bacter_react10'];
          $bacter->bacter_zone10 = $request['bacter_zone10'];
          $bacter->bacter_anti11 = $request['bacter_anti11'];
          $bacter->bacter_react11 = $request['bacter_react11'];
          $bacter->bacter_zone11 = $request['bacter_zone11'];
          $bacter->bacter_anti12 = $request['bacter_anti12'];
          $bacter->bacter_react12 = $request['bacter_react12'];
          $bacter->bacter_zone12 = $request['bacter_zone12'];
          $bacter->becter_comment = $request['becter_comment'];
          $bacter->update();
        }

        Session::flash('success', 'Lab Results Updated Successfully!!');

        return "<script>
          window.open('print-results/$lab_info->lab_info_id','','left=0,top=0,width=1000,height=600,toolbar=0,scrollbars=0,status=0');
          window.location = 'results';
          </script>";

       // return redirect('results')->with('success', 'Lab Results Updated Successfully!!');
    }

    public function destroy($id){
      $lab_info = LabResultsInfo::findOrFail($id);
      if($lab_info){
        $lab_info->delete();

        return back()->with('success', 'Lab Results Deleted Successfully!!');
      }
    }

}
