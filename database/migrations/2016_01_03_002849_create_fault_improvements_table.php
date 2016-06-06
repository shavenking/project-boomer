<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaultImprovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fault_improvements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_checkitem_id')->unsigned();
            $table->string('before_photo')->nullable();
            $table->string('before_notes')->nullable();
            $table->string('current_photo')->nullable();
            $table->string('current_notes')->nullable();
            $table->string('after_photo')->nullable();
            $table->string('after_notes')->nullable();
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
        Schema::drop('fault_improvements');
    }
}
