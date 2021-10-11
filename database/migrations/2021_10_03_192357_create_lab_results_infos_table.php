<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results_infos', function (Blueprint $table) {
            $table->bigIncrements('lab_info_id');
            $table->integer('patient_id')->references('patient_id')->on('patient')->onDelete('cascade');
            $table->mediumInteger('department_id')->references('dropdown_id')->on('dropdowns')->onDelete('cascade');
            $table->string('lab_number', 10);
            $table->tinyInteger('age');
            $table->tinyInteger('created_by')->references('user_id')->on('users')->onDelete('cascade');
            $table->tinyInteger('updated_by')->references('user_id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_results_infos');
    }
}
