<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_banks', function (Blueprint $table) {
            $table->id('bloodbank_id');
            $table->tinyInteger('blood_number');
            $table->mediumInteger('donor_id')->references('donor_id')->on('blood_donors')->onDelete('cascade');
            $table->date('taken_date')->nullable();
            $table->date('exp_date')->nullable();
            $table->string('patient_name')->nullable();
            $table->tinyInteger('volume')->nullable();
            $table->tinyInteger('created_by')->references('user_id')->on('users')->onDelete('cascade');
            $table->tinyInteger('updated_by')->references('user_id')->on('users')->onDelete('cascade');
            $table->string('status', 5)->default('No');
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
        Schema::dropIfExists('blood_banks');
    }
}
