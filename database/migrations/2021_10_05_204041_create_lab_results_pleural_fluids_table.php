<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsPleuralFluidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_pleural_fluids', function (Blueprint $table) {
            $table->id('pleural_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->string('pleural_appear', 20)->nullable();
            $table->string('pleural_color', 20)->nullable();
            $table->decimal('pleural_ph', 5,1)->nullable();
            $table->decimal('pleural_spec', 6,3)->nullable();
            $table->decimal('pleural_protein', 6,2)->nullable();
            $table->decimal('pleural_glucose', 6,2)->nullable();
            $table->decimal('pleural_total', 6,2)->nullable();
            $table->decimal('pleural_count', 6,2)->nullable();
            $table->string('pleural_type', 50)->nullable();
            $table->string('pleural_gram', 50)->nullable();
            $table->string('pleural_culture', 50)->nullable();
            $table->text('pleural_comment')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_pleural_fluids');
    }
}
