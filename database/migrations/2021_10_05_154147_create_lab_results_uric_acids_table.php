<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsUricAcidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_uric_acids', function (Blueprint $table) {
            $table->id('uric_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->decimal('uric_acid', 6,2)->nullable();
            $table->text('uric_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_uric_acids');
    }
}
