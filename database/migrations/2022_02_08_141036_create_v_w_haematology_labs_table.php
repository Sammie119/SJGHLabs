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
                    anti_tpha,
                    hbsag,
                    hcv,
                    sel_fbs_rbs,
                    fbs,
                    blood,
                    blood_rh,
                    g6pd,
                    urine_hcg,
                    bf,
                    bf_parasite,
                    esr,
                    sickling,
                    sickling_hb,
                    widal_o,
                    widal_h,
                    rdt_pf,
                    comment,
                    wbc,
                    lym,
                    mid,
                    mono,
                    eo,
                    baso,
                    neut,
                    rbc,
                    fbc_hgb,
                    hct,
                    mcv,
                    mch,
                    rdw_cv,
                    mpv,
                    plt,
                    fbc_comment,
                    appear,
                    color,
                    uri_blood,
                    blood_factor,
                    urobiln,
                    urobiln_factor,
                    glucose,
                    glucose_factor,
                    nitrite,
                    ph,
                    bilirubin,
                    bilirubin_factor,
                    ketone,
                    ketone_factor,
                    protein,
                    protein_factor,
                    leuco,
                    leuco_factor,
                    spec_gra,
                    pus_cell,
                    red_cell,
                    epi_cell,
                    other,
                    macro,
                    micro,
                    first_resp,
                    ora_quick,
                    sd_bioline,
                    hiv_final,
                    indirect,
                    direct,
                    hb_sag,
                    hb_sab,
                    hb_eag,
                    hb_eab,
                    hb_cab,
                    hb_comment,
                    per_rbc,
                    per_wbc,
                    per_plt,
                    per_imp,
                    semen_date,
                    semen_dura,
                    semen_diff,
                    semen_all,
                    semen_mode,
                    semen_inter,
                    semen_vol,
                    semen_appear,
                    semen_liquefaction,
                    semen_viscosity,
                    semen_ph,
                    semen_rapid,
                    semen_none,
                    semen_imm,
                    semen_vital,
                    semen_wbc,
                    semen_count,
                    semen_totalc,
                    semen_normal,
                    semen_abn,
                    semen_head,
                    semen_mid,
                    semen_tail,
                    semen_comment,
                    oral_glucose,
                    oral_1hpost,
                    oral_1_30post,
                    oral_post,
                    oral_glu,
                    oglu_f,
                    oral_pro,
                    opro_f,
                    oral_ninpro,
                    opro_ninf,
                    oral_comment,
                    fst_min,
                    time_mins1,
                    snd_min,
                    time_mins2,
                    thd_min,
                    time_mins3,
                    for_min,
                    time_mins4,
                    psa,
                    psa_positive,
                    psa_negative,
                    psa_comment,
                    pylori_qual,
                    pylori_comment,
                    ty_igm,
                    ty_igg,
                    ty_comment,
                    lab_results_infos.created_by,
                    get_username(lab_results_infos.created_by::bigint) AS created_user,
                    lab_results_infos.updated_by,
                    get_username(lab_results_infos.updated_by::bigint) AS updated_user,
                    lab_results_infos.created_at,
                    lab_results_infos.updated_at,
                    lab_results_infos.deleted_at
                FROM patients,
                    lab_results_infos,
                    labs_haematology_episodes
                WHERE patients.patient_id = lab_results_infos.patient_id 
                AND lab_results_infos.lab_info_id = labs_haematology_episodes.lab_info_id  
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
