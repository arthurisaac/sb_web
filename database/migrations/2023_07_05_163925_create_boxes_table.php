<?php

use App\Models\Category;
use App\Models\Partner;
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
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class, 'category');
            $table->foreignIdFor(Partner::class, 'partner');
            $table->foreignIdFor(User::class, 'user');
            $table->string("name")->nullable(true);
            $table->double("notation")->default(0)->nullable(true);
            $table->double("notation_count")->default(0)->nullable(true);
            $table->double("price")->default(0)->nullable(true);
            $table->double("discount")->default(0)->nullable(true);
            $table->string("discount_code")->nullable(true);
            $table->integer("min_person")->default(0)->nullable(true);
            $table->integer("max_person")->default(0)->nullable(true);
            $table->date("start_time")->nullable(true);
            $table->date("end_time")->nullable(true);
            $table->double("validity")->nullable(true);
            $table->text("description")->nullable(true);
            $table->text("must_know")->nullable(true);
            $table->text("is_inside")->nullable(true);
            $table->text("country")->nullable(true);
            $table->boolean("enable")->default(true)->nullable(true);
            $table->string("image")->nullable(true);
            $table->string("trique")->unique()->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boxes');
    }
};
