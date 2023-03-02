<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('priority')->nullable();
            $table->string('price',10);
            $table->string('discount',10)->nullable();
            $table->string('weight',10);
            $table->string('numbers',10);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->unsignedBigInteger('image_id')->nullable();
            $table->enum('confirmation_status',\arghavan\Product\Models\Product::$confirmationStatuses)->default(\arghavan\Product\Models\Product::CONFIRMATION_STATUS_PENDING);
            $table->string('description');
            $table->longText('body')->nullable();
            $table->boolean('post')->default(1);
            $table->timestamps();

            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('SET NULL');

            $table->foreign('brand_id')->references('id')
                ->on('brands')->onDelete('SET NULL');

            $table->foreign('model_id')->references('id')
                ->on('models')->onDelete('SET NULL');

            $table->foreign('image_id')->references('id')->on('media')
                ->onDelete('SET NULL');
        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
};
