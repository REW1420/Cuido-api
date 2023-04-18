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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',8)->unique();
            $table->string('order_id',8)->unique();
            $table->json('products');
            $table->string('is_delivered_by',8)->unique();
            $table->double('total_price');
            $table->string('comments');
            $table->boolean('delivered')->default(false);
            $table->boolean('paid')->default(false);
            $table->dateTime('order_updated_at')->nullable();
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
