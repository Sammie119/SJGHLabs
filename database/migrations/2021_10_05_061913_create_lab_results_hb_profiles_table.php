<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsHbProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_hb_profiles', function (Blueprint $table) {
            $table->id('hb_profile_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->string('hb_sag', 10)->nullable();
            $table->string('hb_sab', 10)->nullable();
            $table->string('hb_eag', 10)->nullable();
            $table->string('hb_eab', 10)->nullable();
            $table->string('hb_cab', 10)->nullable();
            $table->text('hb_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_hb_profiles');
    }
}
