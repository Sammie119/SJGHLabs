<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabResultsUrinalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_urinalyses', function (Blueprint $table) {
            $table->id('urinal_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->string('appear', 20)->nullable();
            $table->string('color', 20)->nullable();
            $table->string('blood', 20)->nullable();
            $table->string('blood_factor', 5)->nullable();
            $table->string('urobiln', 20)->nullable();
            $table->string('urobiln_factor', 5)->nullable();
            $table->string('glucose', 20)->nullable();
            $table->string('glucose_factor', 5)->nullable();
            $table->string('nitrite', 20)->nullable();
            $table->decimal('ph', 4,1)->nullable();
            $table->string('bilirubin', 20)->nullable();
            $table->string('bilirubin_factor', 5)->nullable();
            $table->string('ketone', 20)->nullable();
            $table->string('ketone_factor', 5)->nullable();
            $table->string('protein', 20)->nullable();
            $table->string('protein_factor', 5)->nullable();
            $table->string('leuco', 20)->nullable();
            $table->string('leuco_factor', 5)->nullable();
            $table->decimal('spec_gra', 5,3)->nullable();
            $table->string('pus_cell', 10)->nullable();
            $table->string('red_cell', 10)->nullable();
            $table->string('epi_cell', 10)->nullable();
            $table->text('other')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_urinalyses');
    }
}
