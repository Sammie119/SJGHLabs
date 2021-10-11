<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVwDropdownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE OR REPLACE VIEW vw_dropdown as 
            SELECT dropdown_id, categories.category_id, category_name, dropdown 
            FROM categories
            LEFT JOIN dropdowns 
            ON categories.category_id = dropdowns.category_id
            WHERE dropdowns.deleted_at is NULL
            ORDER BY categories.category_id ASC');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS vw_dropdown');
    }
}
