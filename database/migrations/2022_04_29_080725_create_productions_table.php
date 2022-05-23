<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id');
            $table->foreignId('payment_id');
            $table->foreignId('order_id');
            $table->string('customer_name');
            $table->date('startProduction');
            $table->string('workDuration');
            $table->string('fileAsset');
            $table->string('worker_name');
            $table->boolean('isFinished');
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
        Schema::dropIfExists('productions');
    }
}
