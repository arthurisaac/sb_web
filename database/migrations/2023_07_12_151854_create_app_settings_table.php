<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean("banner_ad_enable")->default(false)->nullable();
            $table->string("banner_ad")->nullable();
            $table->string("header_background")->default("images/default_header_background.png")->nullable();
            $table->string("header_title")->nullable();
            $table->foreignIdFor(Category::class,"header_categoory")->nullable();
            $table->boolean("header_hide_button")->default(false)->nullable();
            $table->boolean("maintenance_mode")->default(false)->nullable();
            $table->string("min_version")->default("0.1")->nullable();
            $table->text("banner_ad_detail")->nullable();
            $table->timestamps();
        });

        DB::table('app_settings')->insert( array(
            [
                'banner_ad_enable' => false,
                'banner_ad' => "Pas de réduction aujourd'hui",
                'header_background' => "images/default_header_background.png",
                'header_categoory' => 1
            ],
        ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_settings');
    }
};
