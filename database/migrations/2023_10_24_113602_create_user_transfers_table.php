<?php

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
        Schema::create('user_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user');
            $table->foreignIdFor(User::class, 'created_by');
            $table->integer('amount')->default(0)->nullable();
            $table->integer('before_amount')->default(0)->nullable();
            $table->integer('after_amount')->default(0)->nullable();
            $table->string("method")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_transfers');
    }
};
