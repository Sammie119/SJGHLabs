<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVWBloodBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE OR REPLACE VIEW v_w_blood_banks as
            SELECT blood_banks.bloodbank_id,
            blood_banks.blood_number,
            blood_banks.donor_id,
            blood_donors.name,
            blood_donors.blood_group,
            blood_banks.taken_date,
            blood_banks.exp_date,
            DATE_PART('day', exp_date::timestamp - NOW()::timestamp) + 1 AS expire_days,
            CASE
                WHEN DATE_PART('day', exp_date::timestamp - NOW()::timestamp) + 1 <= 0 AND blood_banks.status = 'No' THEN 'Exp'
                ELSE blood_banks.status
            END AS status,
            blood_banks.patient_name,
            blood_banks.volume,
            blood_banks.created_by,
            blood_banks.updated_by,
            blood_banks.created_at,
            blood_banks.updated_at,
            blood_banks.deleted_at
            FROM blood_banks, blood_donors
            WHERE blood_banks.donor_id = blood_donors.donor_id AND blood_banks.deleted_at IS NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS v_w_blood_banks');
    }
}
