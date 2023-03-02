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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id'); // ایدی خریدار
            $table->foreignId('order_id'); // ایدی سفارش
            $table->string('keyOrders',30)->unique(); // کد سفارش
            $table->string('amount', 10); // هزینه پرداخت
            $table->string('invoice_id'); //کدی درگاه پرداخت میده
            $table->string('gateway'); // درگاه های پرداخت زرین پال یا ملت یا ...
            $table->enum('status', \arghavan\Payment\Models\Payment::$statuses);
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
        Schema::dropIfExists('payments');
    }
};
