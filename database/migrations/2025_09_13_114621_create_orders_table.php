<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pending'); // pending, paid, shipped, completed, cancelled
            $table->decimal('total_amount', 10, 2);
            $table->string('shipping_address')->nullable();
            $table->string('billing_address')->nullable();
            $table->timestamps();
        });

        // Pivot table for products in an order
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
    }
};
