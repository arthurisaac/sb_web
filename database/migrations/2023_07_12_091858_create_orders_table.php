<?php

use App\Models\Box;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user');
            $table->foreignIdFor(Box::class, 'box');
            $table->string("delivery")->nullable(true);
            $table->string("delivery_place")->nullable(true);
            $table->string("nom_client")->nullable(true);
            $table->string("prenom_client")->nullable(true);
            $table->string("ville_client")->nullable(true);
            $table->string("pays_client")->nullable(true);
            $table->string("telephone_client")->nullable(true);
            $table->string("mail_client")->nullable(true);
            $table->string("promo_code")->nullable(true);
            $table->double("total")->default(0)->nullable(true);
            $table->double("payment_method")->nullable(true);
            $table->boolean("order_confirmation")->default(false)->nullable(true);
            $table->boolean("delivrey_confirmation")->default(false)->nullable(true);
            $table->string("trique")->unique()->nullable(true);
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
