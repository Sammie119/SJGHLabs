<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLididVldlToLabsChemistriesEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('labs_chemistries_episodes', function (Blueprint $table) {
            $table->decimal('lipid_vldl', 6,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('labs_chemistries_episodes', function (Blueprint $table) {
            $table->dropColumn('lipid_vldl');
        });
    }
}
