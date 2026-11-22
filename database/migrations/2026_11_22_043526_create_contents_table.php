<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->enum('platform', ['ig_reels', 'tiktok', 'youtube', 'shorts']);
            $table->string('script_link')->nullable();
            $table->string('asset_link')->nullable();
            $table->enum('status', ['idea', 'scripting', 'shooting', 'editing', 'published'])->default('idea');
            $table->date('deadline');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};