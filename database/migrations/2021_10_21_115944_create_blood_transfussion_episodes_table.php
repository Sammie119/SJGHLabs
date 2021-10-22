<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodTransfussionEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_transfussion_episodes', function (Blueprint $table) {
            $table->id('bloodtrans_id');
            $table->bigInteger('bloodbank_id')->references('bloodbank_id')->on('blood_banks')->onDelete('cascade');
            $table->string('patient_name')->nullable();
            $table->string('patient_gender', 10)->nullable();
            $table->tinyInteger('patient_age')->nullable();
            $table->string('nurse_name')->nullable();
            $table->string('department', 50)->nullable();
            $table->date('transfusion_date');
            $table->tinyInteger('volume');
            $table->string('blood_product', 50)->nullable();
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
        Schema::dropIfExists('blood_transfussion_episodes');
    }
}
