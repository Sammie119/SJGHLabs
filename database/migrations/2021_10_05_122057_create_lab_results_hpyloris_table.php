<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsHpylorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_hpyloris', function (Blueprint $table) {
            $table->id('hpylori_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->string('pylori_qual', 20)->nullable();
            $table->text('pylori_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_hpyloris');
    }
}
