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
        Schema::create('company_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('company_services')->onDelete('cascade');
            $table->foreignId('municipality_user_id')->constrained('users')->onDelete('cascade')->comment('送信側の自治体');
            $table->text('message')->nullable()->comment('オファーメッセージ');
            $table->enum('status', ['pending', 'contacted', 'completed'])->default('pending');
            $table->text('note')->nullable()->comment('管理者用メモ');
            $table->timestamps();

            // 同じサービスに複数回オファーを送れないようにする
            $table->unique(['service_id', 'municipality_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_offers');
    }
};
