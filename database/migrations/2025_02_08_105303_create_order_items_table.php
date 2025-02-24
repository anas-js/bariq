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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            // $table->tinyInteger('status');
            $table->integer('quantity');
            $table->foreignId('item_id')->nullable()->references('id')->on('items')->onDelete('set null');

            // $table->foreignId('order_item_servers_id')->nullable()->references('id')->on('order_item_servers');

            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_orders');
    }
};
