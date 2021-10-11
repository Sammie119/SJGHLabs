<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsOgttLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_ogtt_labs', function (Blueprint $table) {
            $table->id('ogtt_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->decimal('oral_glucose', 5,1)->nullable();
            $table->decimal('oral_1hpost', 5,1)->nullable();
            $table->decimal('oral_1_30post', 5,1)->nullable();
            $table->decimal('oral_post', 5,1)->nullable();
            $table->string('oral_glu', 20)->nullable();
            $table->string('oglu_f', 5)->nullable();
            $table->string('oral_pro', 20)->nullable();
            $table->string('opro_f', 5)->nullable();
            $table->string('oral_ninpro', 20)->nullable();
            $table->string('opro_ninf', 5)->nullable();
            $table->text('oral_comment')->nullable();
            $table->decimal('fst_min', 5,1)->nullable();
            $table->tinyInteger('time_mins1')->default(0);
            $table->decimal('snd_min', 5,1)->nullable();
            $table->tinyInteger('time_mins2')->default(60);
            $table->decimal('thd_min', 5,1)->nullable();
            $table->tinyInteger('time_mins3')->default(90);
            $table->decimal('for_min', 5,1)->nullable();
            $table->tinyInteger('time_mins4')->default(120);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_ogtt_labs');
    }
}
