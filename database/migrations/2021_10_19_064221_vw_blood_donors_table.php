<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class VwBloodDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE OR REPLACE VIEW vw_blood_donors as
             SELECT blood_donors.donor_id,
                blood_donors.name,
                blood_donors.gender,
                blood_donors.date_of_birth,
                date_part('year'::text, now()) - date_part('year'::text, blood_donors.date_of_birth) AS age,
                blood_donors.blood_group,
                blood_donors.marita_status,
                blood_donors.profession,
                blood_donors.address,
                blood_donors.mobile,
                blood_donors.created_by,
                get_username(blood_donors.created_by::bigint) AS created_user,
                blood_donors.updated_by,
                get_username(blood_donors.updated_by::bigint) AS updated_user,
                blood_donors.created_at,
                blood_donors.updated_at,
                blood_donors.deleted_at
            FROM blood_donors
            WHERE blood_donors.deleted_at IS NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS vw_blood_donors');
    }
}
