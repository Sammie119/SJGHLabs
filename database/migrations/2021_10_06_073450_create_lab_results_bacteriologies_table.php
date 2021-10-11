<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsBacteriologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_bacteriologies', function (Blueprint $table) {
            $table->id('bacter_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
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

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_bacteriologies');
    }
}
