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
            $table->foreignId('user_id');
            $table->foreignId('product_id');
            $table->string('product_name');
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('phoneNumber');
            $table->string('description');
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
