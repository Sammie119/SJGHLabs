<?php

namespace App\Http\Controllers\Report;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class Attendance extends Controller
{
   static public function attendance($year_month)
    {
        $attendance = DB::select("SELECT (SELECT count(lab_info_id) FROM v_w_chemistries_labs WHERE gender = 'Male' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS male,
                (SELECT count(lab_info_id) FROM v_w_chemistries_labs WHERE gender = 'Female' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS female,
                (SELECT count(lab_info_id) FROM lab_results_infos WHERE deleted_at IS NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS total,
                (SELECT count(lab_info_id) FROM v_w_chemistries_labs WHERE (department = 'OBS & GYNAE' OR department = 'ENT' OR department = 'Eye' OR department = 'OPD' OR department = 'RCH' OR department = 'ANC') AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS opd,
                (SELECT count(lab_info_id) FROM v_w_chemistries_labs WHERE (department = 'Emergency' OR department = 'General Ward' OR department = 'Maternity Ward' OR department = 'Orthopaedic Ward' OR department = 'Surgical Ward' OR department = 'NICU' OR department = 'Childrens Ward') AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS ipd,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS blood_donors
            ");

        $bloodbank = DB::select("SELECT (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE anti_tpha = 'Positive' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS anti_tpha_pos,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE anti_tpha IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS anti_tpha,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE hbs_ag = 'Positive' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS hbs_ag_pos,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE hbs_ag IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS hbs_ag,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE hcv = 'Positive' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS hcv_pos,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE hcv IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS hcv,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE blood IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS blood,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE retro = 'Reactive' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS retro_pos,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE retro IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS retro
            ");

        $blood_transfus = DB::select("SELECT (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE department = 'Emergency' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS emerg,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE department = 'Maternity Ward' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS maternity,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE department = 'General Ward' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS general,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE department = 'Orthopaedic Ward' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS orthopaedic,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE department = 'Childrens Ward' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS childrens,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE patient_gender = 'Male' AND patient_age > 13 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS adult_male,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE patient_gender = 'Female' AND patient_age > 13 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS adult_female,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE patient_gender = 'Male' AND patient_age <= 13 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS child_male,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE patient_gender = 'Female' AND patient_age <= 13 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS adult_female,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS total    
            ");
        
        // $serum_total = DB::select("
    
        //     ");
        return [
                'attendance' => $attendance[0],
                'bloodbank' => $bloodbank[0],
                'blood_transfus' => $blood_transfus[0]
            ];
    }
}
