<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyLaborsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_labors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('construction_daily_daily_labor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construction_daily_id')->unsigned();
            $table->integer('daily_labor_id')->unsigned();
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
        Schema::drop('daily_labors');
        Schema::drop('construction_daily_daily_labor');
    }
}
