<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsPsaLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_psa_labs', function (Blueprint $table) {
            $table->id('psa_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->string('psa', 20)->nullable();
            $table->string('psa_positive', 50)->nullable();
            $table->string('psa_negative', 50)->nullable();
            $table->text('psa_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_psa_labs');
    }
}
