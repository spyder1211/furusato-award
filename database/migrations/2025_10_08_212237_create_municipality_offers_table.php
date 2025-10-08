<?php

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
        Schema::create('municipality_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade')->comment('送信側の首長');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade')->comment('受信側の首長');
            $table->text('message')->nullable()->comment('オファーメッセージ');
            $table->enum('status', ['pending', 'contacted', 'completed'])->default('pending');
            $table->text('note')->nullable()->comment('管理者用メモ');
            $table->timestamps();

            // 同じ首長に複数回オファーを送れないようにする
            $table->unique(['sender_id', 'receiver_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipality_offers');
    }
};
