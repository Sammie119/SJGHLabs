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
             SELECT lab_results_infos.lab_info_id,
                lab_results_infos.patient_id,
                lab_results_infos.lab_number,
                patients.opd_number,
                initcap(patients.name::text) AS name,
                initcap(patients.gender::text) AS gender,
                lab_results_infos.age,
                lab_results_infos.department_id,
                get_department(lab_results_infos.department_id::bigint) AS department,
                lab_results_bacteriologies.bacter_specimen,
                lab_results_bacteriologies.bacter_growth,
                lab_results_bacteriologies.bacter_type1,
                lab_results_bacteriologies.bacter_type2,
                lab_results_bacteriologies.bacter_anti1,
                lab_results_bacteriologies.bacter_react1,
                lab_results_bacteriologies.bacter_zone1,
                lab_results_bacteriologies.bacter_anti2,
                lab_results_bacteriologies.bacter_react2,
                lab_results_bacteriologies.bacter_zone2,
                lab_results_bacteriologies.bacter_anti3,
                lab_results_bacteriologies.bacter_react3,
                lab_results_bacteriologies.bacter_zone3,
                lab_results_bacteriologies.bacter_anti4,
                lab_results_bacteriologies.bacter_react4,
                lab_results_bacteriologies.bacter_zone4,
                lab_results_bacteriologies.bacter_anti5,
                lab_results_bacteriologies.bacter_react5,
                lab_results_bacteriologies.bacter_zone5,
                lab_results_bacteriologies.bacter_anti6,
                lab_results_bacteriologies.bacter_react6,
                lab_results_bacteriologies.bacter_zone6,
                lab_results_bacteriologies.bacter_anti7,
                lab_results_bacteriologies.bacter_react7,
                lab_results_bacteriologies.bacter_zone7,
                lab_results_bacteriologies.bacter_anti8,
                lab_results_bacteriologies.bacter_react8,
                lab_results_bacteriologies.bacter_zone8,
                lab_results_bacteriologies.bacter_anti9,
                lab_results_bacteriologies.bacter_react9,
                lab_results_bacteriologies.bacter_zone9,
                lab_results_bacteriologies.bacter_anti10,
                lab_results_bacteriologies.bacter_react10,
                lab_results_bacteriologies.bacter_zone10,
                lab_results_bacteriologies.bacter_anti11,
                lab_results_bacteriologies.bacter_react11,
                lab_results_bacteriologies.bacter_zone11,
                lab_results_bacteriologies.bacter_anti12,
                lab_results_bacteriologies.bacter_react12,
                lab_results_bacteriologies.bacter_zone12,
                lab_results_bacteriologies.becter_comment,
                lab_results_cerebro_fluids.csf_appear,
                lab_results_cerebro_fluids.csf_color,
                lab_results_cerebro_fluids.csf_protein,
                lab_results_cerebro_fluids.csf_glucose,
                lab_results_cerebro_fluids.csf_globulin,
                lab_results_cerebro_fluids.csf_count,
                lab_results_cerebro_fluids.csf_type,
                lab_results_cerebro_fluids.csf_gram,
                lab_results_cerebro_fluids.csf_comment,
                lab_results_high_vaginals.vaginal_epith,
                lab_results_high_vaginals.vaginal_pus,
                lab_results_high_vaginals.vaginal_red,
                lab_results_high_vaginals.vaginal_clue,
                lab_results_high_vaginals.vaginal_whiff,
                lab_results_high_vaginals.vaginal_koh,
                lab_results_high_vaginals.vaginal_tricho,
                lab_results_high_vaginals.vaginal_gram,
                lab_results_high_vaginals.vaginal_others,
                lab_results_pleural_fluids.pleural_appear,
                lab_results_pleural_fluids.pleural_color,
                lab_results_pleural_fluids.pleural_ph,
                lab_results_pleural_fluids.pleural_spec,
                lab_results_pleural_fluids.pleural_protein,
                lab_results_pleural_fluids.pleural_glucose,
                lab_results_pleural_fluids.pleural_total,
                lab_results_pleural_fluids.pleural_count,
                lab_results_pleural_fluids.pleural_type,
                lab_results_pleural_fluids.pleural_gram,
                lab_results_pleural_fluids.pleural_culture,
                lab_results_pleural_fluids.pleural_comment,
                lab_results_peritoneal_fluids.peritoneal_appear,
                lab_results_peritoneal_fluids.peritoneal_color,
                lab_results_peritoneal_fluids.peritoneal_spec,
                lab_results_peritoneal_fluids.peritoneal_protein,
                lab_results_peritoneal_fluids.peritoneal_albumin,
                lab_results_peritoneal_fluids.peritoneal_glucose,
                lab_results_peritoneal_fluids.peritoneal_alkaline,
                lab_results_peritoneal_fluids.peritoneal_amylase,
                lab_results_peritoneal_fluids.peritoneal_count,
                lab_results_peritoneal_fluids.peritoneal_type,
                lab_results_peritoneal_fluids.peritoneal_gram,
                lab_results_peritoneal_fluids.peritoneal_comment,
                lab_results_infos.created_by,
                get_username(lab_results_infos.created_by::bigint) AS created_user,
                lab_results_infos.updated_by,
                get_username(lab_results_infos.updated_by::bigint) AS updated_user,
                lab_results_infos.created_at,
                lab_results_infos.updated_at,
                lab_results_infos.deleted_at
            FROM patients,
                lab_results_infos,
                dropdowns,
                lab_results_bacteriologies,
                lab_results_cerebro_fluids,
                lab_results_high_vaginals,
                lab_results_pleural_fluids,
                lab_results_peritoneal_fluids
            WHERE patients.patient_id = lab_results_infos.patient_id 
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
