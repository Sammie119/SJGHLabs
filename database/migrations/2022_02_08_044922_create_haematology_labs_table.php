<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHaematologyLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs_haematology_episodes', function (Blueprint $table) {
            $table->id('haema_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            // general labs
            $table->string('anti_tpha', 20)->nullable();
            $table->string('hbsag', 20)->nullable();
            $table->string('hcv', 20)->nullable();
            $table->string('sel_fbs_rbs', 20)->nullable();
            $table->string('fbs', 20)->nullable();
            $table->string('blood', 20)->nullable();
            $table->string('blood_rh', 20)->nullable();
            $table->string('g6pd', 50)->nullable();
            $table->string('urine_hcg', 20)->nullable();
            $table->string('bf', 100)->nullable();
            $table->string('bf_parasite', 20)->nullable();
            $table->string('esr', 20)->nullable();
            $table->string('sickling', 20)->nullable();
            $table->string('sickling_hb', 100)->nullable();
            $table->string('widal_o', 20)->nullable();
            $table->string('widal_h', 20)->nullable();
            $table->string('rdt_pf', 20)->nullable();
            $table->text('comment')->nullable();

            // fbc
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
            $table->text('fbc_comment')->nullable();
            // Urinalysis
            $table->string('appear', 20)->nullable();
            $table->string('color', 20)->nullable();
            $table->string('uri_blood', 20)->nullable();
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
            // stool
            $table->text('macro')->nullable();
            $table->text('micro')->nullable();
            // art
            $table->string('first_resp', 50)->nullable();
            $table->string('ora_quick', 50)->nullable();
            $table->string('sd_bioline', 50)->nullable();
            $table->string('hiv_final',20)->nullable();
            // cooms
            $table->string('indirect', 20)->nullable();
            $table->string('direct', 20)->nullable();
            // hb_profile
            $table->string('hb_sag', 20)->nullable();
            $table->string('hb_sab', 20)->nullable();
            $table->string('hb_eag', 20)->nullable();
            $table->string('hb_eab', 20)->nullable();
            $table->string('hb_cab', 20)->nullable();
            $table->text('hb_comment')->nullable();
            // peri_film
            $table->text('per_rbc')->nullable();
            $table->text('per_wbc')->nullable();
            $table->text('per_plt')->nullable();
            $table->text('per_imp')->nullable();
            // semen
            $table->date('semen_date')->nullable();
            $table->tinyInteger('semen_dura')->nullable();
            $table->string('semen_diff', 20)->nullable();
            $table->string('semen_all', 20)->nullable();
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
            // ogtt
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
            // psa
            $table->string('psa', 20)->nullable();
            $table->string('psa_positive', 50)->nullable();
            $table->string('psa_negative', 50)->nullable();
            $table->text('psa_comment')->nullable();
            // h_pylori
            $table->string('pylori_qual', 20)->nullable();
            $table->text('pylori_comment')->nullable();
            // typhidot
            $table->string('ty_igm', 20)->nullable();
            $table->string('ty_igg', 20)->nullable();
            $table->text('ty_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labs_haematology_episodes');
    }
}
