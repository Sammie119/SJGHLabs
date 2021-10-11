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
            SELECT lab_results_infos.lab_info_id AS lab_info_id, lab_results_infos.patient_id AS patient_id, 
            lab_number, opd_number, name, gender, age, department_id, dropdown, liver_protein, liver_albumin, 
            liver_globulin, liver_alkaline, liver_alanine, liver_aspartate, liver_gamma, liver_total, 
            liver_direct, liver_indirect, liver_comment, renal_urea, renal_creatinine, renal_comment, 
            lipid_total, lipid_trigly, lipid_hdl, lipid_ldl, lipid_comment, electro_potas, electro_sodium, 
            electro_chloride, electro_cca, electro_ica, electro_tca, electro_ph, electro_comment, uric_acid, 
            uric_comment, glycated_hba1c, glycated_comment, serum_total, serum_direct, serum_indirect, serum_comment, 
            lab_results_infos.created_by AS created_by, lab_results_infos.updated_by AS updated_by, lab_results_infos.created_at AS created_at, 
            lab_results_infos.updated_at AS updated_at, lab_results_infos.deleted_at AS deleted_at 
            FROM patients, lab_results_infos, dropdowns,lab_results_liver_funs, lab_results_renal_funs, lab_results_lipid_profiles,
            lab_results_electrolytes, lab_results_uric_acids, lab_results_glycated_hemos, lab_results_serum_labs
            WHERE patients.patient_id = lab_results_infos.patient_id
            AND dropdown_id = department_id
            AND lab_results_infos.lab_info_id = lab_results_liver_funs.lab_info_id
            AND lab_results_infos.lab_info_id = lab_results_renal_funs.lab_info_id
            AND lab_results_infos.lab_info_id = lab_results_lipid_profiles.lab_info_id
            AND lab_results_infos.lab_info_id = lab_results_electrolytes.lab_info_id
            AND lab_results_infos.lab_info_id = lab_results_uric_acids.lab_info_id
            AND lab_results_infos.lab_info_id = lab_results_glycated_hemos.lab_info_id
            AND lab_results_infos.lab_info_id = lab_results_serum_labs.lab_info_id
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
