<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table
                ->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();
            $table
                ->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();
            $table->unsignedMediumInteger('quantity')->default(1);
            $table->unsignedDecimal('price');
            $table->timestamps();

            $table->primary(['order_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
