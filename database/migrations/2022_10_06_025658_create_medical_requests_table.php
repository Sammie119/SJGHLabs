<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_requests', function (Blueprint $table) {
            $table->id('req_id');
            $table->bigInteger('lab_info_id')->nullable();
            $table->string('opd_number', 10);
            $table->string('ins_status', 20);
            $table->json('lab_requests')->nullable();
            $table->json('lab_alias')->nullable();
            $table->json('amounts')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->string('department');
            $table->tinyInteger('status')->default(0)->comment('0=request, 1=Pending payment, 2=paid');
            $table->tinyInteger('report')->default(0)->comment('0=pending, 1=ready');
            $table->string('receipt_no', 20)->nullable();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
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
        Schema::dropIfExists('medical_requests');
    }
}
