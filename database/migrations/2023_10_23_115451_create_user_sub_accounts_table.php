<?php

use App\Models\Category;
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
        Schema::create('user_sub_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user');
            $table->foreignIdFor(Category::class, 'category');
            $table->double('solde')->default(0)->nullable();
            $table->double('target')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sub_accounts');
    }
};
