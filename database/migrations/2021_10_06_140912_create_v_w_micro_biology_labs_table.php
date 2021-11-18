<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVWMicroBiologyLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE OR REPLACE VIEW v_w_micro_biology_labs as 
            SELECT lab_results_infos.lab_info_id AS lab_info_id, lab_results_infos.patient_id AS patient_id, 
            lab_number, opd_number, INITCAP(name) AS name, INITCAP(gender) AS gender, age, department_id, dropdown, bacter_specimen, bacter_growth, bacter_type1, bacter_type2, bacter_anti1, 
            bacter_react1, bacter_zone1, bacter_anti2, bacter_react2, bacter_zone2, bacter_anti3, 
            bacter_react3, bacter_zone3, bacter_anti4, bacter_react4, bacter_zone4, bacter_anti5, 
            bacter_react5, bacter_zone5, bacter_anti6, bacter_react6, bacter_zone6, bacter_anti7, 
            bacter_react7, bacter_zone7, bacter_anti8, bacter_react8, bacter_zone8, bacter_anti9, 
            bacter_react9, bacter_zone9, bacter_anti10, bacter_react10, bacter_zone10, bacter_anti11, 
            bacter_react11, bacter_zone11, bacter_anti12, bacter_react12, bacter_zone12, becter_comment, 
            csf_appear, csf_color, csf_protein, csf_glucose, csf_globulin, csf_count, csf_type, csf_gram, 
            csf_comment, vaginal_epith, vaginal_pus, vaginal_red, vaginal_clue, vaginal_whiff, 
            vaginal_koh, vaginal_tricho, vaginal_gram, vaginal_others, pleural_appear, pleural_color, 
            pleural_ph, pleural_spec, pleural_protein, pleural_glucose, pleural_total, pleural_count, 
            pleural_type, pleural_gram, pleural_culture, pleural_comment, peritoneal_appear, peritoneal_color, 
            peritoneal_spec, peritoneal_protein, peritoneal_albumin, peritoneal_glucose, peritoneal_alkaline, 
            peritoneal_amylase, peritoneal_count, peritoneal_type, peritoneal_gram, peritoneal_comment, 
            lab_results_infos.created_by AS created_by, lab_results_infos.updated_by AS updated_by, lab_results_infos.created_at AS created_at, 
            lab_results_infos.updated_at AS updated_at, lab_results_infos.deleted_at AS deleted_at 
            FROM patients, lab_results_infos, dropdowns,lab_results_bacteriologies,
            lab_results_cerebro_fluids, lab_results_high_vaginals,lab_results_pleural_fluids, lab_results_peritoneal_fluids
            WHERE patients.patient_id = lab_results_infos.patient_id
            AND dropdown_id = department_id
            AND lab_results_infos.lab_info_id = lab_results_bacteriologies.lab_info_id
            AND lab_results_infos.lab_info_id = lab_results_cerebro_fluids.lab_info_id
            AND lab_results_infos.lab_info_id = lab_results_high_vaginals.lab_info_id
            AND lab_results_infos.lab_info_id = lab_results_pleural_fluids.lab_info_id
            AND lab_results_infos.lab_info_id = lab_results_peritoneal_fluids.lab_info_id
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
        DB::unprepared('DROP VIEW IF EXISTS v_w_micro_biology_labs');
    }
}
