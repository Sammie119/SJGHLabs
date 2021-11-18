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
        DB::unprepared('CREATE OR REPLACE VIEW vw_blood_donors as
            SELECT donor_id, name, gender, date_of_birth, (EXTRACT(YEAR FROM NOW()) - EXTRACT(YEAR FROM (date_of_birth))) AS age, blood_group,
            marita_status, profession, address, mobile, created_by, updated_by, created_at, updated_at, deleted_at
            FROM blood_donors
            WHERE deleted_at IS NULL;');
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
