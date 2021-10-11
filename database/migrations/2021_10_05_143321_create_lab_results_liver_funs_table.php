<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsLiverFunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_liver_funs', function (Blueprint $table) {
            $table->id('liver_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->decimal('liver_protein', 6,2)->nullable();
            $table->decimal('liver_albumin', 6,2)->nullable();
            $table->decimal('liver_globulin', 6,2)->nullable();
            $table->decimal('liver_alkaline', 6,2)->nullable();
            $table->decimal('liver_alanine', 6,2)->nullable();
            $table->decimal('liver_aspartate', 6,2)->nullable();
            $table->decimal('liver_gamma', 6,2)->nullable();
            $table->decimal('liver_total', 6,2)->nullable();
            $table->decimal('liver_direct', 6,2)->nullable();
            $table->decimal('liver_indirect', 6,2)->nullable();
            $table->text('liver_comment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_liver_funs');
    }
}
