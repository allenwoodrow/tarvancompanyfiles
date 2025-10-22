<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_product_variants_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('color');
            $table->string('size');
            $table->integer('stock')->default(0);
            $table->decimal('price', 10, 2)->nullable(); // Optional: variant-specific pricing
            $table->string('sku')->nullable(); // Stock Keeping Unit
            $table->string('image')->nullable(); // Optional: variant-specific images
            $table->timestamps();
            
            $table->unique(['product_id', 'color', 'size']); // Prevent duplicate variants
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
}