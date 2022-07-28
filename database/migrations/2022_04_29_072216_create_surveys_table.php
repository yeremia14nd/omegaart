<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->string('address');
            $table->string('city');
            $table->string('phoneNumber');
            $table->string('description');
            $table->boolean('is_schedule_confirmed')->nullable();
            $table->string('assignTo')->nullable();
            $table->string('surveyFile')->nullable();
            $table->date('surveyDate');
            $table->time('surveyTime');
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
        Schema::dropIfExists('surveys');
    }
}
