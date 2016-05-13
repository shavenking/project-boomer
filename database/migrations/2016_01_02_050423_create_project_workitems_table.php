<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectWorkitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_workitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_work_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('cost_type_id')->unsigned();
            $table->string('name');
            $table->integer('order')->unsigned();
            $table->double('amount', 15, 8)->unsigned();
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
        Schema::drop('project_workitems');
    }
}
