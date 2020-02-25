<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddDescriptionToProjectEntityFieldsTable
 */
class AddDescriptionToProjectEntityFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_entity_fields', function (Blueprint $table) {
            $table->string('description', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_entity_fields', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
