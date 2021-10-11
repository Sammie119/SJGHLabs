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
            SELECT lab_results_infos.lab_info_id AS lab_info_id, lab_results_infos.patient_id AS patient_id, 
            lab_number, opd_number, name, gender, age, department_id, dropdown, anti_tpha, hbsag, hcv, 
            sel_fbs_rbs, fbs, lab_results_general_labs.blood AS blood, blood_rh, g6pd, urine_hcg, bf, bf_parasite, esr, sickling, 
            sickling_hb, widal_o, widal_h, rdt_pf, comment, wbc, lym, mid, mono, eo, baso, 
            neut, rbc, fbc_hgb, hct, mcv, mch, rdw_cv, mpv, plt, appear, color, lab_results_urinalyses.blood AS uri_blood, blood_factor, 
            urobiln, urobiln_factor, glucose, glucose_factor, nitrite, ph, bilirubin, bilirubin_factor, 
            ketone, ketone_factor, protein, protein_factor, leuco, leuco_factor, spec_gra, pus_cell, 
            red_cell, epi_cell, other, macro, micro, first_resp, ora_quick, sd_bioline, indirect, direct, 
            hb_sag, hb_sab, hb_eag, hb_eab, hb_cab, hb_comment, per_rbc, per_wbc, per_plt, per_imp, 
            semen_date, semen_dura, semen_diff, semen_all, semen_mode, semen_inter, semen_vol, semen_appear, 
            semen_liquefaction, semen_viscosity, semen_ph, semen_rapid, semen_none, semen_imm, semen_vital, 
            semen_wbc, semen_count, semen_totalc, semen_normal, semen_abn, semen_head, semen_mid, semen_tail, 
            semen_comment, oral_glucose, oral_1hpost, oral_1_30post, oral_post, oral_glu, oglu_f, oral_pro, 
            opro_f, oral_ninpro, opro_ninf, oral_comment, fst_min, time_mins1, snd_min, time_mins2, thd_min, 
            time_mins3, for_min, time_mins4, psa, psa_positive, psa_negative, psa_comment, pylori_qual, pylori_comment, 
            lab_results_infos.created_by AS created_by, lab_results_infos.updated_by AS updated_by, lab_results_infos.created_at AS created_at, 
            lab_results_infos.updated_at AS updated_at, lab_results_infos.deleted_at AS deleted_at 
            FROM patients, lab_results_infos, dropdowns,lab_results_general_labs, lab_results_fbc_labs, lab_results_urinalyses,
            lab_results_stools, lab_results_art_labs, lab_results_cooms_labs, lab_results_hb_profiles, lab_results_peri_films,
            lab_results_semen_labs, lab_results_ogtt_labs, lab_results_psa_labs, lab_results_hpyloris
            WHERE patients.patient_id = lab_results_infos.patient_id
            AND dropdown_id = department_id
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
