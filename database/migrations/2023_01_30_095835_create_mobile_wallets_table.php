<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_wallets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('order_code');
            $table->string('total_price');
            $table->string('transaction_id');
            $table->string('payment_name');
            $table->string('image');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->longText('address');
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('mobile_wallets');
    }
};
