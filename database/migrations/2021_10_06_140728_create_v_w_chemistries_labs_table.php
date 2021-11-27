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
                    lab_results_liver_funs.liver_protein,
                    lab_results_liver_funs.liver_albumin,
                    lab_results_liver_funs.liver_globulin,
                    lab_results_liver_funs.liver_alkaline,
                    lab_results_liver_funs.liver_alanine,
                    lab_results_liver_funs.liver_aspartate,
                    lab_results_liver_funs.liver_gamma,
                    lab_results_liver_funs.liver_total,
                    lab_results_liver_funs.liver_direct,
                    lab_results_liver_funs.liver_indirect,
                    lab_results_liver_funs.liver_comment,
                    lab_results_renal_funs.renal_urea,
                    lab_results_renal_funs.renal_creatinine,
                    lab_results_renal_funs.renal_comment,
                    lab_results_lipid_profiles.lipid_total,
                    lab_results_lipid_profiles.lipid_trigly,
                    lab_results_lipid_profiles.lipid_hdl,
                    lab_results_lipid_profiles.lipid_ldl,
                    lab_results_lipid_profiles.lipid_comment,
                    lab_results_electrolytes.electro_potas,
                    lab_results_electrolytes.electro_sodium,
                    lab_results_electrolytes.electro_chloride,
                    lab_results_electrolytes.electro_cca,
                    lab_results_electrolytes.electro_ica,
                    lab_results_electrolytes.electro_tca,
                    lab_results_electrolytes.electro_ph,
                    lab_results_electrolytes.electro_comment,
                    lab_results_uric_acids.uric_acid,
                    lab_results_uric_acids.uric_comment,
                    lab_results_glycated_hemos.glycated_hba1c,
                    lab_results_glycated_hemos.glycated_comment,
                    lab_results_serum_labs.serum_total,
                    lab_results_serum_labs.serum_direct,
                    lab_results_serum_labs.serum_indirect,
                    lab_results_serum_labs.serum_comment,
                    lab_results_infos.created_by,
                    get_username(lab_results_infos.created_by::bigint) AS created_user,
                    lab_results_infos.updated_by,
                    get_username(lab_results_infos.updated_by::bigint) AS updated_user,
                    lab_results_infos.created_at,
                    lab_results_infos.updated_at,
                    lab_results_infos.deleted_at
                FROM patients,
                    lab_results_infos,
                    lab_results_liver_funs,
                    lab_results_renal_funs,
                    lab_results_lipid_profiles,
                    lab_results_electrolytes,
                    lab_results_uric_acids,
                    lab_results_glycated_hemos,
                    lab_results_serum_labs
                WHERE patients.patient_id = lab_results_infos.patient_id 
                AND lab_results_infos.lab_info_id = lab_results_liver_funs.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_renal_funs.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_lipid_profiles.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_electrolytes.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_uric_acids.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_glycated_hemos.lab_info_id 
                AND lab_results_infos.lab_info_id = lab_results_serum_labs.lab_info_id 
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
        DB::unprepared('DROP VIEW IF EXISTS v_w_chemostries_labs');
    }
}
