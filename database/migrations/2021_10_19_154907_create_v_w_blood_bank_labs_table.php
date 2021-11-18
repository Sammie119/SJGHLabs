<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVWBloodBankLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE OR REPLACE VIEW v_w_blood_bank_labs as
            SELECT lab_results_infos.lab_info_id,
            lab_results_infos.patient_id,
            lab_results_infos.lab_number,
            blood_donors.donor_id,
            blood_donors.name,
            blood_donors.gender,
            lab_results_infos.age,
            blood_bank_labs.anti_tpha,
            blood_bank_labs.hbs_ag,
            blood_bank_labs.hcv,
            blood_bank_labs.bf,
            blood_bank_labs.blood,
            blood_bank_labs.retro,
            blood_bank_labs.mass,
            blood_bank_labs.bp,
            blood_bank_labs.status,
            blood_bank_labs.blood_number,	
            lab_results_infos.created_by,
            lab_results_infos.updated_by,
            lab_results_infos.created_at,
            lab_results_infos.updated_at,
            lab_results_infos.deleted_at
            FROM lab_results_infos, blood_bank_labs, blood_donors
            WHERE lab_results_infos.lab_info_id = blood_bank_labs.lab_info_id
            AND blood_donors.donor_id = lab_results_infos.patient_id
            AND lab_results_infos.deleted_at IS NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS v_w_blood_bank_labs');
    }
}
