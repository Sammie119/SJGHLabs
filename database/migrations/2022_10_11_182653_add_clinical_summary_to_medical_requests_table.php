<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClinicalSummaryToMedicalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_requests', function (Blueprint $table) {
            $table->text('clinical_summary')->nullable();
            $table->integer('lab_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medical_requests', function (Blueprint $table) {
            $table->dropColumn('clinical_summary');
            $table->dropColumn('lab_number');
        });
    }
}
