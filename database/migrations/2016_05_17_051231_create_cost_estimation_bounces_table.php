<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostEstimationBouncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_estimation_bounces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('unit_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('cost_estimation_cost_estimation_bounce', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cost_estimation_id')->unsigned();
            $table->integer('cost_estimation_bounce_id')->unsigned();
            $table->integer('unit_price')->unsigned();
            $table->integer('amount')->unsigned();
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
        Schema::drop('cost_estimation_bounces');
        Schema::drop('cost_estimation_cost_estimation_bounce');
    }
}
