<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_works', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('detailingflow_type_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('workflow_id')->unsigned();
            $table->string('name');
            $table->integer('amount')->unsigned();
            $table->integer('unit_price')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project_works');
    }
}
