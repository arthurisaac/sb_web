<?php

use App\Models\Box;
use App\Models\Experience;
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
        Schema::create('experience_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Experience::class, 'experience');
            $table->foreignIdFor(Box::class, 'box');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experience_items');
    }
};
