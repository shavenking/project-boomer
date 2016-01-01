<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCheckitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_checkitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_checklist_id')->unsigned();
            $table->string('name');
            $table->string('detail');
            $table->boolean('passes')->nullable();
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
        Schema::drop('project_checkitems');
    }
}
