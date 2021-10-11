<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsLipidProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_lipid_profiles', function (Blueprint $table) {
            $table->id('lipid_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->decimal('lipid_total', 6,2)->nullable();
            $table->decimal('lipid_trigly', 6,2)->nullable();
            $table->decimal('lipid_hdl', 6,2)->nullable();
            $table->decimal('lipid_ldl', 6,2)->nullable();
            $table->text('lipid_comment')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_lipid_profiles');
    }
}
