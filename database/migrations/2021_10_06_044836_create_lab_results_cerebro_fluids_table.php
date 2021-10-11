<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsCerebroFluidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_cerebro_fluids', function (Blueprint $table) {
            $table->id('cerebro_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->string('csf_appear', 50)->nullable();
            $table->string('csf_color', 50)->nullable();
            $table->decimal('csf_protein', 6,2)->nullable();
            $table->decimal('csf_glucose', 6,2)->nullable();
            $table->string('csf_globulin', 20)->nullable();
            $table->decimal('csf_count', 6,2)->nullable();
            $table->string('csf_type', 50)->nullable();
            $table->string('csf_gram', 50)->nullable();
            $table->text('csf_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_cerebro_fluids');
    }
}
