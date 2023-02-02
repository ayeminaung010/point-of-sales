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
        Schema::create('credit_card_methods', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('order_code');
            $table->string('total_price');
            $table->bigInteger('card_number');
            $table->string('expired_date');
            $table->integer('cvv_code');
            $table->string('transaction_id');
            $table->string('card_name');
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
        Schema::dropIfExists('credit_card_methods');
    }
};
