<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodBankLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_bank_labs', function (Blueprint $table) {
            $table->id('blood_labs_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->string('anti_tpha', 20)->nullable();
            $table->string('hbs_ag', 20)->nullable();
            $table->string('hcv', 20)->nullable();
            $table->string('bf', 20)->nullable();
            $table->string('blood', 20)->nullable();
            $table->string('retro', 20)->nullable();
            $table->tinyInteger('mass')->nullable();
            $table->string('bp', 20)->nullable();
            $table->string('status', 20)->nullable();
            $table->mediumInteger('blood_number')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_bank_labs');
    }
}
