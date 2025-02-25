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
        Schema::create('order_item_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->references('id')->on('services')->onDelete('set null');
            $table->foreignId('order_item_id')->nullable()->references('id')->on('order_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_services');
    }
};
