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
            $table->id(); // Primary key
            $table->string('name_order'); // For order name
            $table->integer('order_qty'); // For order quantity
            $table->decimal('price_product', 10, 2); // For product price
            $table->unsignedBigInteger('product_id'); // Foreign key column
            $table->timestamps();

            // Foreign key constraint referencing the `products` table
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
