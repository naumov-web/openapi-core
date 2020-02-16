<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProjectEntityFieldsTable
 */
class CreateProjectEntityFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_entity_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 500);
            $table->unsignedBigInteger('type_id');
            $table->bigInteger('project_entity_id');
            $table->boolean('is_nullable')->default(false);
            $table->boolean('is_primary_key')->default(false);
            $table->timestamps();
        });

        Schema::table('project_entity_fields', function (Blueprint $table) {
            $table->foreign('project_entity_id')->references('id')->on('projects');
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
            $table->dropForeign(['project_entity_id']);
        });

        Schema::dropIfExists('project_entity_fields');
    }
}
