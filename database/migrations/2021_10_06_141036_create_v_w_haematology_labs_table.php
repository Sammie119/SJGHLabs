<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVWHaematologyLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE OR REPLACE VIEW v_w_haematology_labs as 
                SELECT lab_results_infos.lab_info_id,
                    lab_results_infos.patient_id,
                    lab_results_infos.lab_number,
                    patients.opd_number,
                    initcap(patients.name::text) AS name,
                    initcap(patients.gender::text) AS gender,
                    lab_results_infos.age,
                    lab_results_infos.department_id,
                    get_department(lab_results_infos.department_id) AS department,
                    lab_results_general_labs.anti_tpha,
                    lab_results_general_labs.hbsag,
                    lab_results_general_labs.hcv,
                    lab_results_general_labs.sel_fbs_rbs,
                    lab_results_general_labs.fbs,
                    lab_results_general_labs.blood,
                    lab_results_general_labs.blood_rh,
                    lab_results_general_labs.g6pd,
                    lab_results_general_labs.urine_hcg,
                    lab_results_general_labs.bf,
                    lab_results_general_labs.bf_parasite,
                    lab_results_general_labs.esr,
                    lab_results_general_labs.sickling,
                    lab_results_general_labs.sickling_hb,
                    lab_results_general_labs.widal_o,
                    lab_results_general_labs.widal_h,
                    lab_results_general_labs.rdt_pf,
                    lab_results_general_labs.comment,
                    lab_results_fbc_labs.wbc,
                    lab_results_fbc_labs.lym,
                    lab_results_fbc_labs.mid,
                    lab_results_fbc_labs.mono,
                    lab_results_fbc_labs.eo,
                    lab_results_fbc_labs.baso,
                    lab_results_fbc_labs.neut,
                    lab_results_fbc_labs.rbc,
                    lab_results_fbc_labs.fbc_hgb,
                    lab_results_fbc_labs.hct,
                    lab_results_fbc_labs.mcv,
                    lab_results_fbc_labs.mch,
                    lab_results_fbc_labs.rdw_cv,
                    lab_results_fbc_labs.mpv,
                    lab_results_fbc_labs.plt,
                    lab_results_urinalyses.appear,
                    lab_results_urinalyses.color,
                    lab_results_urinalyses.blood AS uri_blood,
                    lab_results_urinalyses.blood_factor,
                    lab_results_urinalyses.urobiln,
                    lab_results_urinalyses.urobiln_factor,
                    lab_results_urinalyses.glucose,
                    lab_results_urinalyses.glucose_factor,
                    lab_results_urinalyses.nitrite,
                    lab_results_urinalyses.ph,
                    lab_results_urinalyses.bilirubin,
                    lab_results_urinalyses.bilirubin_factor,
                    lab_results_urinalyses.ketone,
                    lab_results_urinalyses.ketone_factor,
                    lab_results_urinalyses.protein,
                    lab_results_urinalyses.protein_factor,
                    lab_results_urinalyses.leuco,
                    lab_results_urinalyses.leuco_factor,
                    lab_results_urinalyses.spec_gra,
                    lab_results_urinalyses.pus_cell,
                    lab_results_urinalyses.red_cell,
                    lab_results_urinalyses.epi_cell,
                    lab_results_urinalyses.other,
                    lab_results_stools.macro,
                    lab_results_stools.micro,
                    lab_results_art_labs.first_resp,
                    lab_results_art_labs.ora_quick,
                    lab_results_art_labs.sd_bioline,
                    lab_results_cooms_labs.indirect,
                    lab_results_cooms_labs.direct,
                    lab_results_hb_profiles.hb_sag,
                    lab_results_hb_profiles.hb_sab,
                    lab_results_hb_profiles.hb_eag,
                    lab_results_hb_profiles.hb_eab,
                    lab_results_hb_profiles.hb_cab,
                    lab_results_hb_profiles.hb_comment,
                    lab_results_peri_films.per_rbc,
                    lab_results_peri_films.per_wbc,
                    lab_results_peri_films.per_plt,
                    lab_results_peri_films.per_imp,
                    lab_results_semen_labs.semen_date,
                    lab_results_semen_labs.semen_dura,
                    lab_results_semen_labs.semen_diff,
                    lab_results_semen_labs.semen_all,
                    lab_results_semen_labs.semen_mode,
                    lab_results_semen_labs.semen_inter,
                    lab_results_semen_labs.semen_vol,
                    lab_results_semen_labs.semen_appear,
                    lab_results_semen_labs.semen_liquefaction,
                    lab_results_semen_labs.semen_viscosity,
                    lab_results_semen_labs.semen_ph,
                    lab_results_semen_labs.semen_rapid,
                    lab_results_semen_labs.semen_none,
                    lab_results_semen_labs.semen_imm,
                    lab_results_semen_labs.semen_vital,
                    lab_results_semen_labs.semen_wbc,
                    lab_results_semen_labs.semen_count,
                    lab_results_semen_labs.semen_totalc,
                    lab_results_semen_labs.semen_normal,
                    lab_results_semen_labs.semen_abn,
                    lab_results_semen_labs.semen_head,
                    lab_results_semen_labs.semen_mid,
                    lab_results_semen_labs.semen_tail,
                    lab_results_semen_labs.semen_comment,
                    lab_results_ogtt_labs.oral_glucose,
                    lab_results_ogtt_labs.oral_1hpost,
                    lab_results_ogtt_labs.oral_1_30post,
                    lab_results_ogtt_labs.oral_post,
                    lab_results_ogtt_labs.oral_glu,
                    lab_results_ogtt_labs.oglu_f,
                    lab_results_ogtt_labs.oral_pro,
                    lab_results_ogtt_labs.opro_f,
                    lab_results_ogtt_labs.oral_ninpro,
                    lab_results_ogtt_labs.opro_ninf,
                    lab_results_ogtt_labs.oral_comment,
                    lab_results_ogtt_labs.fst_min,
                    lab_results_ogtt_labs.time_mins1,
                    lab_results_ogtt_labs.snd_min,
                    lab_results_ogtt_labs.time_mins2,
                    lab_results_ogtt_labs.thd_min,
                    lab_results_ogtt_labs.time_mins3,
                    lab_results_ogtt_labs.for_min,
                    lab_results_ogtt_labs.time_mins4,
                    lab_results_psa_labs.psa,
                    lab_results_psa_labs.psa_positive,
                    lab_results_psa_labs.psa_negative,
                    lab_results_psa_labs.psa_comment,
                    lab_results_hpyloris.pylori_qual,
                    lab_results_hpyloris.pylori_comment,
                    lab_results_infos.created_by,
                    get_username(lab_results_infos.created_by::bigint) AS created_user,
                    lab_results_infos.updated_by,
                    get_username(lab_results_infos.updated_by::bigint) AS updated_user,
                    lab_results_infos.created_at,
                    lab_results_infos.updated_at,
                    lab_results_infos.deleted_at
                FROM patients,
                    lab_results_infos,
                    lab_results_general_labs,
                    lab_results_fbc_labs,
                    lab_results_urinalyses,
                    lab_results_stools,
                    lab_results_art_labs,
                    lab_results_cooms_labs,
                    lab_results_hb_profiles,
                    lab_results_peri_films,
                    lab_results_semen_labs,
                    lab_results_ogtt_labs,
                    lab_results_psa_labs,
                    lab_results_hpyloris
                WHERE patients.patient_id = lab_results_infos.patient_id 
                AND lab_results_infos.lab_info_id = lab_results_general_labs.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_fbc_labs.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_urinalyses.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_stools.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_art_labs.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_cooms_labs.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_hb_profiles.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_peri_films.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_semen_labs.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_ogtt_labs.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_psa_labs.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_hpyloris.lab_info_id 
                AND lab_results_infos.deleted_at IS NULL;
            ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS v_w_haematology_labs');
    }
}
