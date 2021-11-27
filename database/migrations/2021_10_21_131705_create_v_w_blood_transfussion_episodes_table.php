<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVWBloodTransfussionEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE OR REPLACE VIEW v_w_blood_transfussion_episodes as
             SELECT blood_transfussion_episodes.bloodtrans_id,
                blood_transfussion_episodes.bloodbank_id,
                v_w_blood_banks.blood_number,
                v_w_blood_banks.name AS donor_name,
                v_w_blood_banks.blood_group,
                blood_transfussion_episodes.patient_name,
                blood_transfussion_episodes.patient_gender,
                blood_transfussion_episodes.patient_age,
                blood_transfussion_episodes.nurse_name,
                blood_transfussion_episodes.department,
                blood_transfussion_episodes.transfusion_date,
                blood_transfussion_episodes.volume,
                blood_transfussion_episodes.blood_product,
                blood_transfussion_episodes.created_by,
                get_username(blood_transfussion_episodes.created_by::bigint) AS created_user,
                blood_transfussion_episodes.updated_by,
                get_username(blood_transfussion_episodes.updated_by::bigint) AS updated_user,
                blood_transfussion_episodes.created_at,
                blood_transfussion_episodes.updated_at,
                blood_transfussion_episodes.deleted_at
            FROM blood_transfussion_episodes,
                v_w_blood_banks
            WHERE blood_transfussion_episodes.bloodbank_id = v_w_blood_banks.bloodbank_id 
            AND blood_transfussion_episodes.deleted_at IS NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS v_w_blood_transfussion_episodes');
    }
}
