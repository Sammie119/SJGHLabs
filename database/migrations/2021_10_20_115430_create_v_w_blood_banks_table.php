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
                date_part('day'::text, blood_banks.exp_date::timestamp without time zone - now()::timestamp without time zone) + 1::double precision AS expire_days,
                    CASE
                        WHEN (date_part('day'::text, blood_banks.exp_date::timestamp without time zone - now()::timestamp without time zone) + 1::double precision) <= 0::double precision AND blood_banks.status::text = 'No'::text THEN 'Exp'::character varying
                        ELSE blood_banks.status
                    END AS status,
                blood_banks.patient_name,
                blood_banks.volume,
                blood_banks.created_by,
                get_username(blood_banks.created_by) AS created_user,
                blood_banks.updated_by,
                get_username(blood_banks.updated_by) AS updated_user,
                blood_banks.created_at,
                blood_banks.updated_at,
                blood_banks.deleted_at
            FROM blood_banks,
                blood_donors
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
