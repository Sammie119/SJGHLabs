<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsHighVaginalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_high_vaginals', function (Blueprint $table) {
            $table->id('vaginal_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->decimal('vaginal_epith', 6,1)->nullable();
            $table->decimal('vaginal_pus', 6,1)->nullable();
            $table->decimal('vaginal_red', 6,1)->nullable();
            $table->decimal('vaginal_clue', 6,1)->nullable();
            $table->string('vaginal_whiff', 20)->nullable();
            $table->string('vaginal_koh', 20)->nullable();
            $table->decimal('vaginal_tricho', 6,1)->nullable();
            $table->text('vaginal_gram')->nullable();
            $table->text('vaginal_others')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_high_vaginals');
    }
}
