<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVWChemistriesLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP VIEW v_w_chemistries_labs');
        
        DB::unprepared('CREATE OR REPLACE VIEW v_w_chemistries_labs as 
             SELECT lab_results_infos.lab_info_id,
                    lab_results_infos.patient_id,
                    lab_results_infos.lab_number,
                    patients.opd_number,
                    initcap(patients.name::text) AS name,
                    initcap(patients.gender::text) AS gender,
                    lab_results_infos.age,
                    lab_results_infos.department_id,
                    get_department(lab_results_infos.department_id) AS department,
                    liver_protein,
                    liver_albumin,
                    liver_globulin,
                    liver_alkaline,
                    liver_alanine,
                    liver_aspartate,
                    liver_gamma,
                    liver_total,
                    liver_direct,
                    liver_indirect,
                    liver_comment,
                    renal_urea,
                    renal_creatinine,
                    renal_comment,
                    lipid_total,
                    lipid_trigly,
                    lipid_hdl,
                    lipid_ldl,
                    lipid_vldl,
                    lipid_comment,
                    electro_potas,
                    electro_sodium,
                    electro_chloride,
                    electro_cca,
                    electro_ica,
                    electro_tca,
                    electro_ph,
                    electro_comment,
                    uric_acid,
                    uric_comment,
                    glycated_hba1c,
                    glycated_comment,
                    serum_total,
                    serum_direct,
                    serum_indirect,
                    serum_comment,
                    dm_fbs_rbs_2,
                    dm_fbs_rbs,
                    dm_urine_glucose,
                    dm_urine_factor,
                    anc_uri_glucose,
                    anc_glo_factor,
                    anc_uri_profile,
                    anc_pro_factor,
                    lab_results_infos.created_by,
                    get_username(lab_results_infos.created_by::bigint) AS created_user,
                    lab_results_infos.updated_by,
                    get_username(lab_results_infos.updated_by::bigint) AS updated_user,
                    lab_results_infos.created_at,
                    lab_results_infos.updated_at,
                    lab_results_infos.deleted_at
                FROM patients,
                    lab_results_infos,
                    labs_chemistries_episodes
                WHERE patients.patient_id = lab_results_infos.patient_id 
                AND lab_results_infos.lab_info_id = labs_chemistries_episodes.lab_info_id 
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
        DB::unprepared('DROP VIEW IF EXISTS v_w_chemistries_labs');
    }
}
