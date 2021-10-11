<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsFbcLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_fbc_labs', function (Blueprint $table) {
            $table->id('fbc_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->decimal('wbc', 5,2)->nullable();
            $table->decimal('lym', 5,2)->nullable();
            $table->decimal('mid', 5,2)->nullable();
            $table->decimal('mono', 5,2)->nullable();
            $table->decimal('eo', 5,2)->nullable();
            $table->decimal('baso', 5,2)->nullable();
            $table->decimal('neut', 5,2)->nullable();
            $table->decimal('rbc', 5,2)->nullable();
            $table->decimal('fbc_hgb', 5,2)->nullable();
            $table->decimal('hct', 5,2)->nullable();
            $table->decimal('mcv', 5,2)->nullable();
            $table->decimal('mch', 5,2)->nullable();
            $table->decimal('rdw_cv', 5,2)->nullable();
            $table->decimal('mpv', 5,2)->nullable();
            $table->tinyInteger('plt')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_fbc_labs');
    }
}
