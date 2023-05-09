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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->json('products');
            $table->string('is_delivered_by');
            $table->double('total_price');
            $table->string('comments');
            $table->boolean('delivered')->default(false);
            $table->boolean('paid')->default(false);
            $table->dateTime('order_updated_at')->nullable();
            $table->integer('user_phone_number');
            $table->decimal('location_lat', 18, 15);
            $table->decimal('location_long', 18, 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};