<?php

use App\Models\Order;
use App\Models\User;
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
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class, 'order');
            $table->foreignIdFor(User::class, 'user');
            $table->string('payment_method')->nullable(true);
            $table->string('phone_number')->nullable(true);
            $table->string('opt_code')->nullable(true);
            $table->text("description")->nullable(true);
            $table->double("amount")->default(0)->nullable(true);
            $table->boolean("status")->default(false)->nullable(true);
            $table->boolean("confirmation")->default(false)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_payments');
    }
};
