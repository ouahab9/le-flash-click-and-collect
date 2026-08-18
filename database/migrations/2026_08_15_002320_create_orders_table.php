<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('pickup_slot_id')
                ->nullable()
                ->constrained('pickup_slots')
                ->nullOnDelete();

            $table->string('order_number')->unique();

            $table->string('customer_name');
            $table->string('customer_phone');

            $table->string('status')->default('pending');

            $table->date('pickup_date');

            $table->time('pickup_time');

            $table->decimal('total', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};