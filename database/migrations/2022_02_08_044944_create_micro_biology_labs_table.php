<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicroBiologyLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs_micro_biology_episodes', function (Blueprint $table) {
            $table->id('micro_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            // bacteriology
            $table->string('bacter_specimen', 50)->nullable();
            $table->string('bacter_growth', 50)->nullable();
            $table->string('bacter_type1', 50)->nullable();
            $table->string('bacter_type2', 50)->nullable();
            $table->string('bacter_anti1', 50)->nullable();
            $table->string('bacter_react1', 50)->nullable();
            $table->tinyInteger('bacter_zone1')->nullable();
            $table->string('bacter_anti2', 50)->nullable();
            $table->string('bacter_react2', 50)->nullable();
            $table->tinyInteger('bacter_zone2')->nullable();
            $table->string('bacter_anti3', 50)->nullable();
            $table->string('bacter_react3', 50)->nullable();
            $table->tinyInteger('bacter_zone3')->nullable();
            $table->string('bacter_anti4', 50)->nullable();
            $table->string('bacter_react4', 50)->nullable();
            $table->tinyInteger('bacter_zone4')->nullable();
            $table->string('bacter_anti5', 50)->nullable();
            $table->string('bacter_react5', 50)->nullable();
            $table->tinyInteger('bacter_zone5')->nullable();
            $table->string('bacter_anti6', 50)->nullable();
            $table->string('bacter_react6', 50)->nullable();
            $table->tinyInteger('bacter_zone6')->nullable();
            $table->string('bacter_anti7', 50)->nullable();
            $table->string('bacter_react7', 50)->nullable();
            $table->tinyInteger('bacter_zone7')->nullable();
            $table->string('bacter_anti8', 50)->nullable();
            $table->string('bacter_react8', 50)->nullable();
            $table->tinyInteger('bacter_zone8')->nullable();
            $table->string('bacter_anti9', 50)->nullable();
            $table->string('bacter_react9', 50)->nullable();
            $table->tinyInteger('bacter_zone9')->nullable();
            $table->string('bacter_anti10', 50)->nullable();
            $table->string('bacter_react10', 50)->nullable();
            $table->tinyInteger('bacter_zone10')->nullable();
            $table->string('bacter_anti11', 50)->nullable();
            $table->string('bacter_react11', 50)->nullable();
            $table->tinyInteger('bacter_zone11')->nullable();
            $table->string('bacter_anti12', 50)->nullable();
            $table->string('bacter_react12', 50)->nullable();
            $table->tinyInteger('bacter_zone12')->nullable();
            $table->text('becter_comment')->nullable();
            // csf
            $table->string('csf_appear', 50)->nullable();
            $table->string('csf_color', 50)->nullable();
            $table->decimal('csf_protein', 6,2)->nullable();
            $table->decimal('csf_glucose', 6,2)->nullable();
            $table->string('csf_globulin', 20)->nullable();
            $table->decimal('csf_count', 6,2)->nullable();
            $table->string('csf_type', 50)->nullable();
            $table->string('csf_gram', 50)->nullable();
            $table->text('csf_comment')->nullable();
            // high vaginal swab
            $table->decimal('vaginal_epith', 6,1)->nullable();
            $table->decimal('vaginal_pus', 6,1)->nullable();
            $table->decimal('vaginal_red', 6,1)->nullable();
            $table->decimal('vaginal_clue', 6,1)->nullable();
            $table->string('vaginal_whiff', 20)->nullable();
            $table->string('vaginal_koh', 20)->nullable();
            $table->decimal('vaginal_tricho', 6,1)->nullable();
            $table->text('vaginal_gram')->nullable();
            $table->text('vaginal_others')->nullable();
            // pleural fluid
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
            // peritoneal fluid
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
        Schema::dropIfExists('labs_micro_biology_episodes');
    }
}
