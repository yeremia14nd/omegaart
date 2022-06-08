<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_id');
            $table->foreignId('user_id');
            $table->date('start_installment');
            $table->time('start_installment_time');
            $table->boolean('is_customer_confirm_date')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('worker');
            $table->string('file_asset')->nullable();
            $table->boolean('is_installed')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('installments');
    }
}
