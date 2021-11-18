<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_donors', function (Blueprint $table) {
            $table->id('donor_id');
            $table->string('name');
            $table->string('gender', 10);
            $table->date('date_of_birth')->nullable();
            $table->string('blood_group', 20)->nullable();
            $table->string('marita_status', 20)->nullable();
            $table->string('profession', 500)->nullable();
            $table->string('address')->nullable();
            $table->string('mobile', 20)->nullable();
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
        Schema::dropIfExists('blood_donors');
    }
}
