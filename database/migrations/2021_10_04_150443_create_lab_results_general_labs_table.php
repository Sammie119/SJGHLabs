<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsGeneralLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_general_labs', function (Blueprint $table) {
            $table->id('general_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->string('anti_tpha', 10)->nullable();
            $table->string('hbsag', 10)->nullable();
            $table->string('hcv', 10)->nullable();
            $table->string('sel_fbs_rbs', 10)->nullable();
            $table->string('fbs', 10)->nullable();
            $table->string('blood', 10)->nullable();
            $table->string('blood_rh', 10)->nullable();
            $table->string('g6pd', 50)->nullable();
            $table->string('urine_hcg', 10)->nullable();
            $table->string('bf', 50)->nullable();
            $table->string('bf_parasite', 10)->nullable();
            $table->string('esr', 10)->nullable();
            $table->string('sickling', 10)->nullable();
            $table->string('sickling_hb', 50)->nullable();
            $table->string('widal_o', 10)->nullable();
            $table->string('widal_h', 10)->nullable();
            $table->string('rdt_pf', 10)->nullable();
            $table->text('comment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_general_labs');
    }
}
