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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('address_id')->references('id')->on('addresses')->cascadeOnDelete();
            $table->string('sumDiscount');
            $table->string('sumPrice');
            $table->string('keyOrders',30)->unique();
            $table->string('priceSend');
            $table->string('priceFinal');
            $table->enum('payment_status',\arghavan\Payment\Models\Order::$statuses)->default(\arghavan\Payment\Models\Order::STATUS_PENDING);
            $table->enum('status',\arghavan\Payment\Models\Order::$type)->default(\arghavan\Payment\Models\Order::TYPE_PREPARING);
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
};
