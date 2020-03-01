<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddDefaultValueToEntityFieldsTable
 */
class AddDefaultValueToEntityFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_entity_fields', function (Blueprint $table) {
            $table->string('default_value')->nullable();
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
            $table->dropColumn('default_value');
        });
    }
}
