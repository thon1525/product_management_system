<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name'); // For product name
            $table->decimal('product_price', 10, 2); // For product price
            $table->integer('product_qty'); // For product quantity
            $table->string('product_img'); // For product image URL or path
            $table->string('product_code')->unique(); // For unique product code
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
