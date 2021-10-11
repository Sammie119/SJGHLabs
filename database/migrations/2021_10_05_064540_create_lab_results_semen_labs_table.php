<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsSemenLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_semen_labs', function (Blueprint $table) {
            $table->id('semen_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->date('semen_date')->nullable();
            $table->tinyInteger('semen_dura')->nullable();
            $table->string('semen_diff', 10)->nullable();
            $table->string('semen_all', 10)->nullable();
            $table->string('semen_mode', 50)->nullable();
            $table->tinyInteger('semen_inter')->nullable();
            $table->decimal('semen_vol', 5,1)->nullable();
            $table->string('semen_appear', 50)->nullable();
            $table->tinyInteger('semen_liquefaction')->nullable();
            $table->string('semen_viscosity', 20)->nullable();
            $table->decimal('semen_ph', 5,1)->nullable();
            $table->decimal('semen_rapid', 5,1)->nullable();
            $table->decimal('semen_none', 5,1)->nullable();
            $table->decimal('semen_imm', 5,1)->nullable();
            $table->decimal('semen_vital', 5,1)->nullable();
            $table->decimal('semen_wbc', 7,1)->nullable();
            $table->decimal('semen_count', 7,1)->nullable();
            $table->decimal('semen_totalc', 7,1)->nullable();
            $table->decimal('semen_normal', 5,1)->nullable();
            $table->decimal('semen_abn', 5,1)->nullable();
            $table->decimal('semen_head', 5,1)->nullable();
            $table->decimal('semen_mid', 5,1)->nullable();
            $table->decimal('semen_tail', 5,1)->nullable();
            $table->text('semen_comment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_semen_labs');
    }
}
