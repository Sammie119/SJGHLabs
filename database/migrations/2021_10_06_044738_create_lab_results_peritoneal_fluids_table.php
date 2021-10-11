<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsPeritonealFluidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_peritoneal_fluids', function (Blueprint $table) {
            $table->id('peritoneal_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->string('peritoneal_appear', 50)->nullable();
            $table->string('peritoneal_color', 50)->nullable();
            $table->decimal('peritoneal_spec', 6,3)->nullable();
            $table->decimal('peritoneal_protein', 6,2)->nullable();
            $table->decimal('peritoneal_albumin', 6,2)->nullable();
            $table->decimal('peritoneal_glucose', 6,2)->nullable();
            $table->decimal('peritoneal_alkaline', 6,2)->nullable();
            $table->decimal('peritoneal_amylase', 6,2)->nullable();
            $table->decimal('peritoneal_count', 6,2)->nullable();
            $table->string('peritoneal_type', 50)->nullable();
            $table->string('peritoneal_gram', 50)->nullable();
            $table->text('peritoneal_comment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_peritoneal_fluids');
    }
}
