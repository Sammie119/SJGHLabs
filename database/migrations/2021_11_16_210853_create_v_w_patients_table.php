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
            SELECT patient_id,
            opd_number,
            INITCAP(name) AS name,
            date_of_birth,
            date_part('year'::text, age(date_of_birth::timestamp with time zone)) AS age,
            INITCAP(gender) AS gender,
            created_by,
            updated_by,
            created_at,
            updated_at
            FROM patients
            WHERE deleted_at IS NULL
            ORDER BY patient_id DESC;");
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
