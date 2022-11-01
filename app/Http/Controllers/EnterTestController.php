<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\ChemistriesLab;
use App\Models\HaematologyLab;
use App\Models\Investigations;
use App\Models\LabResultsInfo;
use App\Models\MedicalRequest;
use App\Models\MicroBiologyLab;
use App\Models\VWChemistriesLab;
use App\Models\VWHaematologyLab;
use App\Models\VWMicroBiologyLab;
use Illuminate\Support\Facades\Session;

class EnterTestController extends Controller
{
  public function docRequestLabs()
    {
        $labs = MedicalRequest::where('report', 0)->orderBy('req_id')->limit(1000)->get();
        
        return view('registration', ['labs' => $labs, 'title' => 'Lab Registration']);
    }

    public function approveLabsRequest(Request $request)
    {
      $request->validate([
          'receipt_no' => 'required',
      ],
      [
          'receipt_no.required' => 'Receipt Number is required',
      ]);

      $labs = MedicalRequest::find($request->id);

      $count = MedicalRequest::where('receipt_no', $request->receipt_no)->count();
      if($count <= 0) {

        $year = date('Y');

        if($year == 2022){
          $lab_number = MedicalRequest::orderByDesc('lab_number')->where('lab_number', '!=', null)->first()->lab_number + 1;
        } else {
          $lab_number = MedicalRequest::whereRaw("to_char(DATE(created_at), 'YYYY') = '$year' AND lab_number IS NOT NULL")->count() + 1;
        }
                
        $labs->opd_number = $request->opd_number;
        $labs->ins_status = $request->ins_status;
        $labs->lab_requests = $request->lab_requests;
        $labs->lab_alias = $this->getAliasFromLabRequests($request->lab_requests);
        $labs->amounts = $this->getAmountFromLabARequest($request->lab_requests, $request->ins_status);
        $labs->total_amount = array_sum($labs->amounts);
        $labs->status = 2;
        $labs->receipt_no = $request->receipt_no;
        $labs->updated_by = Session::get('user')['user_id'];
        $labs->lab_number = $lab_number;

        $labs->update();

        return back()->with('success', 'Labs Request Approved Successfully!!!');
      }

      return back()->with('error', 'Receipt Number Already Exist!!!');
                
    }

    public function approvePayment(Request $request)
    {
      // dd($request->all());
      $count = MedicalRequest::where('receipt_no', $request->receipt_no)->count();
      if($count <= 0) {
        $labs = MedicalRequest::find($request->id);
        $labs->status = 2;
        $labs->receipt_no = $request->receipt_no;

        $labs->update();

        return back()->with('success', 'Labs Payment Approved Successfully!!!');
      }

      return back()->with('error', 'Receipt Number Already Exist!!!');
      
    }

    // public function checkLabsPayment()
    // {
    //   $labs = MedicalRequest::orderBy('req_id')->where([['status', '>', 0], ['report', '=', 0]])->limit(1000)->get();
    //   return view('registration', ['labs' => $labs, 'title' => 'Check Payemts']);  
    // }
    
    public function index()
    {
      if(Session::get('user')['department'] == 'Main Lab'){
        $lab_no = 'M%';
      }else{
        $lab_no = 'R%';
      }

      $results = VWHaematologyLab:://where('lab_number', 'LIKE', $lab_no)->
      orderBy('lab_info_id', 'DESC')->with('user')->limit(1000)->get();
      
      return view('results', compact('results'));
    }

    public function archiveLabsResults()
    {
      $results = VWHaematologyLab::orderBy('lab_info_id', 'DESC')->with('user')->limit(1000)->get();
      return view('archive-labs', compact('results'));
    }

    public function create($id = 1)
    { 
      // $year = date('Y');
      $data = MedicalRequest::find($id);
      // $lab_no = LabResultsInfo::whereRaw("to_char(DATE(created_at), 'YYYY') = '$year'")->count() + 1;

      return view('enter-test', ['data' => $data, 'lab_no' => $data->lab_number]);

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
      // dd($request->all());
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
            $lab_no = 'M'.$request->lab_no; //$request->lab_no;
          }else{
            $lab_no = 'R'.$request->lab_no; //$request->lab_no;
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

          $haematology = new HaematologyLab;
          $haematology->lab_info_id = $lab_info->lab_info_id;
          // General Labs
          $haematology->anti_tpha = $request['anti_tpha'];
          $haematology->hbsag = $request['hbs_ag'];
          $haematology->hcv = $request['hcv'];
          $haematology->sel_fbs_rbs = $request['fbs_rbs_2'];
          $haematology->fbs = $request['fbs_rbs'];
          $haematology->blood = $request['blood'];
          $haematology->blood_rh = $request['blood_rh'];
          $haematology->g6pd = $request['g6pd'];
          $haematology->urine_hcg = $request['urine_hcg'];
          $haematology->bf = $request['bf'];
          $haematology->bf_parasite = $request['bf_parasite'];
          $haematology->esr = $request['esr'];
          $haematology->sickling = $request['sickling'];
          $haematology->sickling_hb = $request['sickling_hgb'];
          $haematology->widal_o = $request['widal_o'];
          $haematology->widal_h = $request['widal_h'];
          $haematology->rdt_pf = $request['rdt_pf'];
          $haematology->covid = $request['covid'];
          $haematology->comment = $request['comment'];

        //FBC Lab Results...........................................

          $haematology->wbc = $request['wbc'];
          $haematology->lym = $request['lym'];
          $haematology->mid = $request['mid'];
          $haematology->mono = $request['mono'];
          $haematology->eo = $request['eo'];
          $haematology->baso = $request['baso'];
          $haematology->neut = $request['neut'];
          $haematology->rbc = $request['rbc'];
          $haematology->fbc_hgb = $request['fbc_hgb'];
          $haematology->hct = $request['hct'];
          $haematology->mcv = $request['mcv'];
          $haematology->mch = $request['mch'];
          $haematology->rdw_cv = $request['rdw_cv'];
          $haematology->mpv = $request['mpv'];
          $haematology->plt = $request['plt'];
          $haematology->fbc_comment = $request['fbc_comment'];

        //Urinalysis Lab Results...........................................

          $haematology->appear = $request['appear'];
          $haematology->color = $request['color'];
          $haematology->uri_blood = $request['uri_blood'];
          $haematology->blood_factor = $request['blood_factor'];
          $haematology->urobiln = $request['urobiln'];
          $haematology->urobiln_factor = $request['urobiln_factor'];
          $haematology->glucose = $request['glucose'];
          $haematology->glucose_factor = $request['glucose_factor'];
          $haematology->nitrite = $request['nitrite'];
          $haematology->ph = $request['ph'];
          $haematology->bilirubin = $request['bilirubin'];
          $haematology->bilirubin_factor = $request['bilirubin_factor'];
          $haematology->ketone = $request['ketone'];
          $haematology->ketone_factor = $request['ketone_factor'];
          $haematology->protein = $request['protein'];
          $haematology->protein_factor = $request['protein_factor'];
          $haematology->leuco = $request['leuco'];
          $haematology->leuco_factor = $request['leuco_factor'];
          $haematology->spec_gra = $request['spec_gra'];
          $haematology->pus_cell = $request['pus_cell'];
          $haematology->red_cell = $request['red_cell'];
          $haematology->epi_cell = $request['epi_cell'];
          $haematology->other = $request['other'];

        //Stool Lab Results...........................................

          $haematology->macro = $request['macro'];
          $haematology->micro = $request['micro'];

        //ART Lab Results...........................................

          $haematology->first_resp = $request['first_resp'];
          $haematology->ora_quick = $request['ora_quick'];
          $haematology->sd_bioline = $request['sd_bioline'];
          $haematology->hiv_final = $request['hiv_final'];

        //COOMS Lab Results...........................................

          $haematology->indirect = $request['indirect'];
          $haematology->direct = $request['direct'];

        //HB Profile Lab Results...........................................

          $haematology->hb_sag = $request['hb_sag'];
          $haematology->hb_sab = $request['hb_sab'];
          $haematology->hb_eag = $request['hb_eag'];
          $haematology->hb_eab = $request['hb_eab'];
          $haematology->hb_cab = $request['hb_cab'];
          $haematology->hb_comment = $request['hb_comment'];

        //Peripheral Film Lab Results...........................................

          $haematology->per_rbc = $request['per_rbc'];
          $haematology->per_wbc = $request['per_wbc'];
          $haematology->per_plt = $request['per_plt'];
          $haematology->per_imp = $request['per_imp'];

        //Semen Film Lab Results...........................................

          $haematology->semen_date = $request['semen_date'];
          $haematology->semen_dura = $request['semen_dura'];
          $haematology->semen_diff = $request['semen_diff'];
          $haematology->semen_all = $request['semen_all'];
          $haematology->semen_mode = $request['semen_mode'];
          $haematology->semen_inter = $request['semen_inter'];
          $haematology->semen_vol = $request['semen_vol'];
          $haematology->semen_appear = $request['semen_appear'];
          $haematology->semen_liquefaction = $request['semen_liquefaction'];
          $haematology->semen_viscosity = $request['semen_viscosity'];
          $haematology->semen_ph = $request['semen_ph'];
          $haematology->semen_rapid = $request['semen_rapid'];
          $haematology->semen_none = $request['semen_none'];
          $haematology->semen_imm = $request['semen_imm'];
          $haematology->semen_vital = $request['semen_vital'];
          $haematology->semen_wbc = $request['semen_wbc'];
          $haematology->semen_count = $request['semen_count'];
          $haematology->semen_totalc = $request['semen_totalc'];
          $haematology->semen_normal = $request['semen_normal'];
          $haematology->semen_abn = $request['semen_abn'];
          $haematology->semen_head = $request['semen_head'];
          $haematology->semen_mid = $request['semen_mid'];
          $haematology->semen_tail = $request['semen_tail'];
          $haematology->semen_comment = $request['semen_comment'];

        //OGTT Lab Results...........................................

          $haematology->oral_glucose = $request['oral_glucose'];
          $haematology->oral_1hpost = $request['oral_1hpost'];
          $haematology->oral_1_30post = $request['oral_1_30post'];
          $haematology->oral_post = $request['oral_post'];
          $haematology->oral_glu = $request['oral_glu'];
          $haematology->oglu_f = $request['oglu_f'];
          $haematology->oral_pro = $request['oral_pro'];
          $haematology->opro_f = $request['opro_f'];
          $haematology->oral_ninpro = $request['oral_ninpro'];
          $haematology->opro_ninf = $request['opro_ninf'];
          $haematology->oral_comment = $request['oral_comment'];
          $haematology->fst_min = $request['fst_min'];
          $haematology->snd_min = $request['snd_min'];
          $haematology->thd_min = $request['thd_min'];
          $haematology->for_min = $request['for_min'];

        //PSA Lab Results...........................................

          $haematology->psa = $request['psa'];
          $haematology->psa_positive = $request['psa_positive'];
          $haematology->psa_negative = $request['psa_negative'];
          $haematology->psa_comment = $request['psa_comment'];

        //H Pylori Lab Results...........................................

          $haematology->pylori_qual = $request['pylori_qual'];
          $haematology->pylori_comment = $request['pylori_comment'];

        // Typhidot
          $haematology->ty_igm = $request['ty_igm'];
          $haematology->ty_igg = $request['ty_igg'];
          $haematology->ty_comment = $request['ty_comment'];
          $haematology->save();
          
        //Liver Function Lab Results...........................................

          $chemistry = new ChemistriesLab;
          $chemistry->lab_info_id = $lab_info->lab_info_id;
          $chemistry->liver_protein = $request['liver_protein'];
          $chemistry->liver_albumin = $request['liver_albumin'];
          $chemistry->liver_globulin = $request['liver_globulin'];
          $chemistry->liver_alkaline = $request['liver_alkaline'];
          $chemistry->liver_alanine = $request['liver_alanine'];
          $chemistry->liver_aspartate = $request['liver_aspartate'];
          $chemistry->liver_gamma = $request['liver_gamma'];
          $chemistry->liver_total = $request['liver_total'];
          $chemistry->liver_direct = $request['liver_direct'];
          $chemistry->liver_indirect = $request['liver_indirect'];
          $chemistry->liver_comment = $request['liver_comment'];

        //Renal Function Lab Results...........................................

          $chemistry->renal_urea = $request['renal_urea'];
          $chemistry->renal_creatinine = $request['renal_creatinine'];
          $chemistry->renal_comment = $request['renal_comment'];

        //Lipid Profile Lab Results...........................................

          $chemistry->lipid_total = $request['lipid_total'];
          $chemistry->lipid_trigly = $request['lipid_trigly'];
          $chemistry->lipid_hdl = $request['lipid_hdl'];
          $chemistry->lipid_ldl = $request['lipid_ldl'];  
          $chemistry->lipid_vldl = $request['lipid_vldl'];
          $chemistry->lipid_comment = $request['lipid_comment'];

        //Electrolytes Lab Results...........................................

          $chemistry->electro_potas = $request['electro_potas'];
          $chemistry->electro_sodium = $request['electro_sodium'];
          $chemistry->electro_chloride = $request['electro_chloride'];
          $chemistry->electro_cca = $request['electro_cca'];
          $chemistry->electro_ica = $request['electro_ica'];
          $chemistry->electro_tca = $request['electro_tca'];
          $chemistry->electro_ph = $request['electro_ph'];
          $chemistry->electro_comment = $request['electro_comment'];

        //Uric Acid Lab Results...........................................
          
          $chemistry->uric_acid = $request['uric_acid'];
          $chemistry->uric_comment = $request['uric_comment'];

        //Glycated Hemoglobin Lab Results...........................................

          $chemistry->glycated_hba1c = $request['glycated_hba1c'];
          $chemistry->glycated_comment = $request['glycated_comment'];

        //Serum Bilirubin Lab Results...............................................

          $chemistry->serum_total = $request['serum_total'];
          $chemistry->serum_direct = $request['serum_direct'];
          $chemistry->serum_indirect = $request['serum_indirect'];
          $chemistry->serum_comment = $request['serum_comment'];

        // DM Profile .................................................................
          $chemistry->dm_fbs_rbs_2 = $request['dm_fbs_rbs_2'];
          $chemistry->dm_fbs_rbs = $request['dm_fbs_rbs'];
          $chemistry->dm_urine_glucose = $request['dm_urine_glucose'];
          $chemistry->dm_urine_factor = $request['dm_urine_factor'];
          
        // ANC Urine .................................................................
          $chemistry->anc_uri_glucose = $request['anc_uri_glucose'];
          $chemistry->anc_glo_factor = $request['anc_glo_factor'];
          $chemistry->anc_uri_profile = $request['anc_uri_profile'];
          $chemistry->anc_pro_factor = $request['anc_pro_factor'];
          $chemistry->save();

        //High Vaginal Swab Lab Results...............................................
          
          $micro = new MicroBiologyLab;
          $micro->lab_info_id = $lab_info->lab_info_id;
          $micro->vaginal_epith = $request['vaginal_epith'];
          $micro->vaginal_pus = $request['vaginal_pus'];
          $micro->vaginal_red = $request['vaginal_red'];
          $micro->vaginal_clue = $request['vaginal_clue'];
          $micro->vaginal_whiff = $request['vaginal_whiff'];
          $micro->vaginal_koh = $request['vaginal_koh'];
          $micro->vaginal_tricho = $request['vaginal_tricho'];
          $micro->vaginal_gram = $request['vaginal_gram'];
          $micro->vaginal_others = $request['vaginal_others'];

        //Pleural Fluid Swab Lab Results...............................................

          $micro->pleural_appear = $request['pleural_appear'];
          $micro->pleural_color = $request['pleural_color'];
          $micro->pleural_ph = $request['pleural_ph'];
          $micro->pleural_spec = $request['pleural_spec'];
          $micro->pleural_protein = $request['pleural_protein'];
          $micro->pleural_glucose = $request['pleural_glucose'];
          $micro->pleural_total = $request['pleural_total'];
          $micro->pleural_count = $request['pleural_count'];
          $micro->pleural_type = $request['pleural_type'];
          $micro->pleural_gram = $request['pleural_gram'];
          $micro->pleural_culture = $request['pleural_culture'];
          $micro->pleural_comment = $request['pleural_comment'];

        //Peritoneal Fluid Lab Results...............................................

          $micro->peritoneal_appear = $request['peritoneal_appear'];
          $micro->peritoneal_color = $request['peritoneal_color'];
          $micro->peritoneal_spec = $request['peritoneal_spec'];
          $micro->peritoneal_protein = $request['peritoneal_protein'];
          $micro->peritoneal_albumin = $request['peritoneal_albumin'];
          $micro->peritoneal_glucose = $request['peritoneal_glucose'];
          $micro->peritoneal_alkaline = $request['peritoneal_alkaline'];
          $micro->peritoneal_amylase = $request['peritoneal_amylase'];
          $micro->peritoneal_count = $request['peritoneal_count'];
          $micro->peritoneal_type = $request['peritoneal_type'];
          $micro->peritoneal_gram = $request['peritoneal_gram'];
          $micro->peritoneal_comment = $request['peritoneal_comment'];

        //Cerebrospinal (CSF) Fluid Lab Results...............................................

          $micro->csf_appear = $request['csf_appear'];
          $micro->csf_color = $request['csf_color'];
          $micro->csf_protein = $request['csf_protein'];
          $micro->csf_glucose = $request['csf_glucose'];
          $micro->csf_globulin = $request['csf_globulin'];
          $micro->csf_count = $request['csf_count'];
          $micro->csf_type = $request['csf_type'];
          $micro->csf_gram = $request['csf_gram'];
          $micro->csf_comment = $request['csf_comment'];

        //Bacteriology Lab Results...............................................

          $micro->bacter_specimen = $request['bacter_specimen'];
          $micro->bacter_growth = $request['bacter_growth'];
          $micro->bacter_type1 = $request['bacter_type1'];
          $micro->bacter_type2 = $request['bacter_type2'];
          $micro->bacter_anti1 = $request['bacter_anti1'];
          $micro->bacter_react1 = $request['bacter_react1'];
          $micro->bacter_zone1 = $request['bacter_zone1'];
          $micro->bacter_anti2 = $request['bacter_anti2'];
          $micro->bacter_react2 = $request['bacter_react2'];
          $micro->bacter_zone2 = $request['bacter_zone2'];
          $micro->bacter_anti3 = $request['bacter_anti3'];
          $micro->bacter_react3 = $request['bacter_react3'];
          $micro->bacter_zone3 = $request['bacter_zone3'];
          $micro->bacter_anti4 = $request['bacter_anti4'];
          $micro->bacter_react4 = $request['bacter_react4'];
          $micro->bacter_zone4 = $request['bacter_zone4'];
          $micro->bacter_anti5 = $request['bacter_anti5'];
          $micro->bacter_react5 = $request['bacter_react5'];
          $micro->bacter_zone5 = $request['bacter_zone5'];
          $micro->bacter_anti6 = $request['bacter_anti6'];
          $micro->bacter_react6 = $request['bacter_react6'];
          $micro->bacter_zone6 = $request['bacter_zone6'];
          $micro->bacter_anti7 = $request['bacter_anti7'];
          $micro->bacter_react7 = $request['bacter_react7'];
          $micro->bacter_zone7 = $request['bacter_zone7'];
          $micro->bacter_anti8 = $request['bacter_anti8'];
          $micro->bacter_react8 = $request['bacter_react8'];
          $micro->bacter_zone8 = $request['bacter_zone8'];
          $micro->bacter_anti9 = $request['bacter_anti9'];
          $micro->bacter_react9 = $request['bacter_react9'];
          $micro->bacter_zone9 = $request['bacter_zone9'];
          $micro->bacter_anti10 = $request['bacter_anti10'];
          $micro->bacter_react10 = $request['bacter_react10'];
          $micro->bacter_zone10 = $request['bacter_zone10'];
          $micro->bacter_anti11 = $request['bacter_anti11'];
          $micro->bacter_react11 = $request['bacter_react11'];
          $micro->bacter_zone11 = $request['bacter_zone11'];
          $micro->bacter_anti12 = $request['bacter_anti12'];
          $micro->bacter_react12 = $request['bacter_react12'];
          $micro->bacter_zone12 = $request['bacter_zone12'];
          $micro->becter_comment = $request['becter_comment'];

          $micro->save();

          $req = MedicalRequest::find($request->id);
          $req->report = 1;
          $req->lab_info_id = $lab_info->lab_info_id;
          $req->update();

          // Saving receipt Number
          $this->saveLabReceipt($lab_info->lab_info_id, $request->opd_no, $request->receipt_no, $request->lab_no);

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

      // $data = MedicalRequest::where('lab_info_id', 1)->first();
      $data = MedicalRequest::where('req_id', 1)->first();

      // dd($data);
      
      if($data){
        return view('edit-test', compact('haema', 'micro', 'chem', 'data'));
      }

      return back()->with('error', 'You Cannot Edit with Report!!!!');
      
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

        $haematology = HaematologyLab::where('lab_info_id', $lab_info->lab_info_id)->first();

        $haematology->anti_tpha = $request['anti_tpha'];
        $haematology->hbsag = $request['hbs_ag'];
        $haematology->hcv = $request['hcv'];
        $haematology->sel_fbs_rbs = $request['fbs_rbs_2'];
        $haematology->fbs = $request['fbs_rbs'];
        $haematology->blood = $request['blood'];
        $haematology->blood_rh = $request['blood_rh'];
        $haematology->g6pd = $request['g6pd'];
        $haematology->urine_hcg = $request['urine_hcg'];
        $haematology->bf = $request['bf'];
        $haematology->bf_parasite = $request['bf_parasite'];
        $haematology->esr = $request['esr'];
        $haematology->sickling = $request['sickling'];
        $haematology->sickling_hb = $request['sickling_hgb'];
        $haematology->widal_o = $request['widal_o'];
        $haematology->widal_h = $request['widal_h'];
        $haematology->rdt_pf = $request['rdt_pf'];
        $haematology->covid = $request['covid'];
        $haematology->comment = $request['comment'];

      //FBC Lab Results...........................................

        $haematology->wbc = $request['wbc'];
        $haematology->lym = $request['lym'];
        $haematology->mid = $request['mid'];
        $haematology->mono = $request['mono'];
        $haematology->eo = $request['eo'];
        $haematology->baso = $request['baso'];
        $haematology->neut = $request['neut'];
        $haematology->rbc = $request['rbc'];
        $haematology->fbc_hgb = $request['fbc_hgb'];
        $haematology->hct = $request['hct'];
        $haematology->mcv = $request['mcv'];
        $haematology->mch = $request['mch'];
        $haematology->rdw_cv = $request['rdw_cv'];
        $haematology->mpv = $request['mpv'];
        $haematology->plt = $request['plt'];
        $haematology->fbc_comment = $request['fbc_comment'];

      //Urinalysis Lab Results...........................................

        $haematology->appear = $request['appear'];
        $haematology->color = $request['color'];
        $haematology->uri_blood = $request['uri_blood'];
        $haematology->blood_factor = $request['blood_factor'];
        $haematology->urobiln = $request['urobiln'];
        $haematology->urobiln_factor = $request['urobiln_factor'];
        $haematology->glucose = $request['glucose'];
        $haematology->glucose_factor = $request['glucose_factor'];
        $haematology->nitrite = $request['nitrite'];
        $haematology->ph = $request['ph'];
        $haematology->bilirubin = $request['bilirubin'];
        $haematology->bilirubin_factor = $request['bilirubin_factor'];
        $haematology->ketone = $request['ketone'];
        $haematology->ketone_factor = $request['ketone_factor'];
        $haematology->protein = $request['protein'];
        $haematology->protein_factor = $request['protein_factor'];
        $haematology->leuco = $request['leuco'];
        $haematology->leuco_factor = $request['leuco_factor'];
        $haematology->spec_gra = $request['spec_gra'];
        $haematology->pus_cell = $request['pus_cell'];
        $haematology->red_cell = $request['red_cell'];
        $haematology->epi_cell = $request['epi_cell'];
        $haematology->other = $request['other'];

      //Stool Lab Results...........................................

        $haematology->macro = $request['macro'];
        $haematology->micro = $request['micro'];

      //ART Lab Results...........................................

        $haematology->first_resp = $request['first_resp'];
        $haematology->ora_quick = $request['ora_quick'];
        $haematology->sd_bioline = $request['sd_bioline'];
        $haematology->hiv_final = $request['hiv_final'];

      //COOMS Lab Results...........................................

        $haematology->indirect = $request['indirect'];
        $haematology->direct = $request['direct'];

      //HB Profile Lab Results...........................................

        $haematology->hb_sag = $request['hb_sag'];
        $haematology->hb_sab = $request['hb_sab'];
        $haematology->hb_eag = $request['hb_eag'];
        $haematology->hb_eab = $request['hb_eab'];
        $haematology->hb_cab = $request['hb_cab'];
        $haematology->hb_comment = $request['hb_comment'];

      //Peripheral Film Lab Results...........................................

        $haematology->per_rbc = $request['per_rbc'];
        $haematology->per_wbc = $request['per_wbc'];
        $haematology->per_plt = $request['per_plt'];
        $haematology->per_imp = $request['per_imp'];

      //Semen Film Lab Results...........................................

        $haematology->semen_date = $request['semen_date'];
        $haematology->semen_dura = $request['semen_dura'];
        $haematology->semen_diff = $request['semen_diff'];
        $haematology->semen_all = $request['semen_all'];
        $haematology->semen_mode = $request['semen_mode'];
        $haematology->semen_inter = $request['semen_inter'];
        $haematology->semen_vol = $request['semen_vol'];
        $haematology->semen_appear = $request['semen_appear'];
        $haematology->semen_liquefaction = $request['semen_liquefaction'];
        $haematology->semen_viscosity = $request['semen_viscosity'];
        $haematology->semen_ph = $request['semen_ph'];
        $haematology->semen_rapid = $request['semen_rapid'];
        $haematology->semen_none = $request['semen_none'];
        $haematology->semen_imm = $request['semen_imm'];
        $haematology->semen_vital = $request['semen_vital'];
        $haematology->semen_wbc = $request['semen_wbc'];
        $haematology->semen_count = $request['semen_count'];
        $haematology->semen_totalc = $request['semen_totalc'];
        $haematology->semen_normal = $request['semen_normal'];
        $haematology->semen_abn = $request['semen_abn'];
        $haematology->semen_head = $request['semen_head'];
        $haematology->semen_mid = $request['semen_mid'];
        $haematology->semen_tail = $request['semen_tail'];
        $haematology->semen_comment = $request['semen_comment'];

      //OGTT Lab Results...........................................

        $haematology->oral_glucose = $request['oral_glucose'];
        $haematology->oral_1hpost = $request['oral_1hpost'];
        $haematology->oral_1_30post = $request['oral_1_30post'];
        $haematology->oral_post = $request['oral_post'];
        $haematology->oral_glu = $request['oral_glu'];
        $haematology->oglu_f = $request['oglu_f'];
        $haematology->oral_pro = $request['oral_pro'];
        $haematology->opro_f = $request['opro_f'];
        $haematology->oral_ninpro = $request['oral_ninpro'];
        $haematology->opro_ninf = $request['opro_ninf'];
        $haematology->oral_comment = $request['oral_comment'];
        $haematology->fst_min = $request['fst_min'];
        $haematology->snd_min = $request['snd_min'];
        $haematology->thd_min = $request['thd_min'];
        $haematology->for_min = $request['for_min'];

      //PSA Lab Results...........................................

        $haematology->psa = $request['psa'];
        $haematology->psa_positive = $request['psa_positive'];
        $haematology->psa_negative = $request['psa_negative'];
        $haematology->psa_comment = $request['psa_comment'];

      //H Pylori Lab Results...........................................

        $haematology->pylori_qual = $request['pylori_qual'];
        $haematology->pylori_comment = $request['pylori_comment'];

      // Typhidot
        $haematology->ty_igm = $request['ty_igm'];
        $haematology->ty_igg = $request['ty_igg'];
        $haematology->ty_comment = $request['ty_comment'];
        $haematology->update();
        
      //Liver Function Lab Results...........................................

        $chemistry = ChemistriesLab::where('lab_info_id', $lab_info->lab_info_id)->first();
          $chemistry->liver_protein = $request['liver_protein'];
          $chemistry->liver_albumin = $request['liver_albumin'];
          $chemistry->liver_globulin = $request['liver_globulin'];
          $chemistry->liver_alkaline = $request['liver_alkaline'];
          $chemistry->liver_alanine = $request['liver_alanine'];
          $chemistry->liver_aspartate = $request['liver_aspartate'];
          $chemistry->liver_gamma = $request['liver_gamma'];
          $chemistry->liver_total = $request['liver_total'];
          $chemistry->liver_direct = $request['liver_direct'];
          $chemistry->liver_indirect = $request['liver_indirect'];
          $chemistry->liver_comment = $request['liver_comment'];

        //Renal Function Lab Results...........................................

          $chemistry->renal_urea = $request['renal_urea'];
          $chemistry->renal_creatinine = $request['renal_creatinine'];
          $chemistry->renal_comment = $request['renal_comment'];

        //Lipid Profile Lab Results...........................................

          $chemistry->lipid_total = $request['lipid_total'];
          $chemistry->lipid_trigly = $request['lipid_trigly'];
          $chemistry->lipid_hdl = $request['lipid_hdl'];
          $chemistry->lipid_ldl = $request['lipid_ldl'];
          $chemistry->lipid_vldl = $request['lipid_vldl'];
          $chemistry->lipid_comment = $request['lipid_comment'];

        //Electrolytes Lab Results...........................................

          $chemistry->electro_potas = $request['electro_potas'];
          $chemistry->electro_sodium = $request['electro_sodium'];
          $chemistry->electro_chloride = $request['electro_chloride'];
          $chemistry->electro_cca = $request['electro_cca'];
          $chemistry->electro_ica = $request['electro_ica'];
          $chemistry->electro_tca = $request['electro_tca'];
          $chemistry->electro_ph = $request['electro_ph'];
          $chemistry->electro_comment = $request['electro_comment'];

        //Uric Acid Lab Results...........................................
          
          $chemistry->uric_acid = $request['uric_acid'];
          $chemistry->uric_comment = $request['uric_comment'];

        //Glycated Hemoglobin Lab Results...........................................

          $chemistry->glycated_hba1c = $request['glycated_hba1c'];
          $chemistry->glycated_comment = $request['glycated_comment'];

        //Serum Bilirubin Lab Results...............................................

          $chemistry->serum_total = $request['serum_total'];
          $chemistry->serum_direct = $request['serum_direct'];
          $chemistry->serum_indirect = $request['serum_indirect'];
          $chemistry->serum_comment = $request['serum_comment'];
          
          $chemistry->update();

      //High Vaginal Swab Lab Results...............................................
        
        $micro = MicroBiologyLab::where('lab_info_id', $lab_info->lab_info_id)->first();
        $micro->vaginal_epith = $request['vaginal_epith'];
          $micro->vaginal_pus = $request['vaginal_pus'];
          $micro->vaginal_red = $request['vaginal_red'];
          $micro->vaginal_clue = $request['vaginal_clue'];
          $micro->vaginal_whiff = $request['vaginal_whiff'];
          $micro->vaginal_koh = $request['vaginal_koh'];
          $micro->vaginal_tricho = $request['vaginal_tricho'];
          $micro->vaginal_gram = $request['vaginal_gram'];
          $micro->vaginal_others = $request['vaginal_others'];

        //Pleural Fluid Swab Lab Results...............................................

          $micro->pleural_appear = $request['pleural_appear'];
          $micro->pleural_color = $request['pleural_color'];
          $micro->pleural_ph = $request['pleural_ph'];
          $micro->pleural_spec = $request['pleural_spec'];
          $micro->pleural_protein = $request['pleural_protein'];
          $micro->pleural_glucose = $request['pleural_glucose'];
          $micro->pleural_total = $request['pleural_total'];
          $micro->pleural_count = $request['pleural_count'];
          $micro->pleural_type = $request['pleural_type'];
          $micro->pleural_gram = $request['pleural_gram'];
          $micro->pleural_culture = $request['pleural_culture'];
          $micro->pleural_comment = $request['pleural_comment'];

        //Peritoneal Fluid Lab Results...............................................

          $micro->peritoneal_appear = $request['peritoneal_appear'];
          $micro->peritoneal_color = $request['peritoneal_color'];
          $micro->peritoneal_spec = $request['peritoneal_spec'];
          $micro->peritoneal_protein = $request['peritoneal_protein'];
          $micro->peritoneal_albumin = $request['peritoneal_albumin'];
          $micro->peritoneal_glucose = $request['peritoneal_glucose'];
          $micro->peritoneal_alkaline = $request['peritoneal_alkaline'];
          $micro->peritoneal_amylase = $request['peritoneal_amylase'];
          $micro->peritoneal_count = $request['peritoneal_count'];
          $micro->peritoneal_type = $request['peritoneal_type'];
          $micro->peritoneal_gram = $request['peritoneal_gram'];
          $micro->peritoneal_comment = $request['peritoneal_comment'];

        //Cerebrospinal (CSF) Fluid Lab Results...............................................

          $micro->csf_appear = $request['csf_appear'];
          $micro->csf_color = $request['csf_color'];
          $micro->csf_protein = $request['csf_protein'];
          $micro->csf_glucose = $request['csf_glucose'];
          $micro->csf_globulin = $request['csf_globulin'];
          $micro->csf_count = $request['csf_count'];
          $micro->csf_type = $request['csf_type'];
          $micro->csf_gram = $request['csf_gram'];
          $micro->csf_comment = $request['csf_comment'];

        //Bacteriology Lab Results...............................................

          $micro->bacter_specimen = $request['bacter_specimen'];
          $micro->bacter_growth = $request['bacter_growth'];
          $micro->bacter_type1 = $request['bacter_type1'];
          $micro->bacter_type2 = $request['bacter_type2'];
          $micro->bacter_anti1 = $request['bacter_anti1'];
          $micro->bacter_react1 = $request['bacter_react1'];
          $micro->bacter_zone1 = $request['bacter_zone1'];
          $micro->bacter_anti2 = $request['bacter_anti2'];
          $micro->bacter_react2 = $request['bacter_react2'];
          $micro->bacter_zone2 = $request['bacter_zone2'];
          $micro->bacter_anti3 = $request['bacter_anti3'];
          $micro->bacter_react3 = $request['bacter_react3'];
          $micro->bacter_zone3 = $request['bacter_zone3'];
          $micro->bacter_anti4 = $request['bacter_anti4'];
          $micro->bacter_react4 = $request['bacter_react4'];
          $micro->bacter_zone4 = $request['bacter_zone4'];
          $micro->bacter_anti5 = $request['bacter_anti5'];
          $micro->bacter_react5 = $request['bacter_react5'];
          $micro->bacter_zone5 = $request['bacter_zone5'];
          $micro->bacter_anti6 = $request['bacter_anti6'];
          $micro->bacter_react6 = $request['bacter_react6'];
          $micro->bacter_zone6 = $request['bacter_zone6'];
          $micro->bacter_anti7 = $request['bacter_anti7'];
          $micro->bacter_react7 = $request['bacter_react7'];
          $micro->bacter_zone7 = $request['bacter_zone7'];
          $micro->bacter_anti8 = $request['bacter_anti8'];
          $micro->bacter_react8 = $request['bacter_react8'];
          $micro->bacter_zone8 = $request['bacter_zone8'];
          $micro->bacter_anti9 = $request['bacter_anti9'];
          $micro->bacter_react9 = $request['bacter_react9'];
          $micro->bacter_zone9 = $request['bacter_zone9'];
          $micro->bacter_anti10 = $request['bacter_anti10'];
          $micro->bacter_react10 = $request['bacter_react10'];
          $micro->bacter_zone10 = $request['bacter_zone10'];
          $micro->bacter_anti11 = $request['bacter_anti11'];
          $micro->bacter_react11 = $request['bacter_react11'];
          $micro->bacter_zone11 = $request['bacter_zone11'];
          $micro->bacter_anti12 = $request['bacter_anti12'];
          $micro->bacter_react12 = $request['bacter_react12'];
          $micro->bacter_zone12 = $request['bacter_zone12'];
          $micro->becter_comment = $request['becter_comment'];

          $micro->update();

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
