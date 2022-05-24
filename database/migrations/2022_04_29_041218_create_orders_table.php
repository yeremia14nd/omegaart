<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products');
            $table->boolean('is_surveyed')->nullable();
            $table->boolean('is_invoice_sent')->nullable();
            $table->boolean('is_paid_invoiced')->nullable();
            $table->boolean('is_productioned')->nullable();
            $table->boolean('is_installed')->nullable();
            $table->boolean('is_final_invoice_sent')->nullable();
            $table->boolean('is_final_invoice_paid')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
