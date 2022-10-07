<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChemistriesLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs_chemistries_episodes', function (Blueprint $table) {
            $table->id('chem_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            // liver function
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
            // renal function
            $table->decimal('renal_urea', 6,2)->nullable();
            $table->decimal('renal_creatinine', 6,2)->nullable();
            $table->text('renal_comment')->nullable();
            // lipid profile
            $table->decimal('lipid_total', 6,2)->nullable();
            $table->decimal('lipid_trigly', 6,2)->nullable();
            $table->decimal('lipid_hdl', 6,2)->nullable();
            $table->decimal('lipid_ldl', 6,2)->nullable();
            $table->text('lipid_comment')->nullable();
            // electrolysis 
            $table->decimal('electro_potas', 6,2)->nullable();
            $table->decimal('electro_sodium', 6,2)->nullable();
            $table->decimal('electro_chloride', 6,2)->nullable();
            $table->decimal('electro_cca', 6,2)->nullable();
            $table->decimal('electro_ica', 6,2)->nullable();
            $table->decimal('electro_tca', 6,2)->nullable();
            $table->decimal('electro_ph', 6,2)->nullable();
            $table->text('electro_comment')->nullable();
            // uric acid
            $table->decimal('uric_acid', 6,2)->nullable();
            $table->text('uric_comment')->nullable();
            // glycated
            $table->decimal('glycated_hba1c', 6,2)->nullable();
            $table->text('glycated_comment')->nullable();
            // serum
            $table->decimal('serum_total', 6,2)->nullable();
            $table->decimal('serum_direct', 6,2)->nullable();
            $table->decimal('serum_indirect', 6,2)->nullable();
            $table->text('serum_comment')->nullable();
            // DM Profile
            $table->string('dm_fbs_rbs_2', 20)->nullable();
            $table->string('dm_fbs_rbs', 20)->nullable();
            $table->string('dm_urine_glucose', 20)->nullable();
            $table->string('dm_urine_factor', 20)->nullable();
            // ANC Urine
            $table->string('anc_uri_glucose', 20)->nullable();
            $table->string('anc_glo_factor', 20)->nullable();
            $table->string('anc_uri_profile', 20)->nullable();
            $table->string('anc_pro_factor', 20)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labs_chemistries_episodes');
    }
}
