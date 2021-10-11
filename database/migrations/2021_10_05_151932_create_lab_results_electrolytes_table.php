<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsElectrolytesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_electrolytes', function (Blueprint $table) {
            $table->id('electrolytes_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->decimal('electro_potas', 6,2)->nullable();
            $table->decimal('electro_sodium', 6,2)->nullable();
            $table->decimal('electro_chloride', 6,2)->nullable();
            $table->decimal('electro_cca', 6,2)->nullable();
            $table->decimal('electro_ica', 6,2)->nullable();
            $table->decimal('electro_tca', 6,2)->nullable();
            $table->decimal('electro_ph', 6,2)->nullable();
            $table->text('electro_comment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_electrolytes');
    }
}
