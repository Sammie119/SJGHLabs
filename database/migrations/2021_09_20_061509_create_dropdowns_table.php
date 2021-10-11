<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDropdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dropdowns', function (Blueprint $table) {
            $table->mediumIncrements('dropdown_id');
            $table->tinyInteger('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->string('dropdown');
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
        Schema::dropIfExists('dropdowns');
    }
}
