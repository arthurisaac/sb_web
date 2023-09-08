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
        Schema::create('box_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Box::class, "box");
            $table->foreignIdFor(User::class, "user");
            $table->text("comment")->nullable(true);
            $table->double("notation")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('box_comments');
    }
};
