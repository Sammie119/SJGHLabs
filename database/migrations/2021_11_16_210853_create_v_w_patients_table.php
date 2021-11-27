<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVWPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE OR REPLACE VIEW v_w_patients as       
             SELECT patients.patient_id,
                patients.opd_number,
                initcap(patients.name::text) AS name,
                patients.date_of_birth,
                date_part('year'::text, age(patients.date_of_birth::timestamp with time zone)) AS age,
                initcap(patients.gender::text) AS gender,
                patients.created_by,
                get_username(patients.created_by::bigint) AS created_user,
                patients.updated_by,
                get_username(patients.updated_by::bigint) AS updated_user,
                patients.created_at,
                patients.updated_at
            FROM patients
            WHERE patients.deleted_at IS NULL
            ORDER BY patients.patient_id DESC;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS v_w_patients');
    }
}
