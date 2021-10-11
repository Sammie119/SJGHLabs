<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsSerumLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_serum_labs', function (Blueprint $table) {
            $table->id('serum_id');
            $table->bigInteger('lab_info_id')->references('lab_info_id')->on('lab_results_infos')->onDelete('cascade');
            $table->decimal('serum_total', 6,2)->nullable();
            $table->decimal('serum_direct', 6,2)->nullable();
            $table->decimal('serum_indirect', 6,2)->nullable();
            $table->text('serum_comment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_serum_labs');
    }
}
