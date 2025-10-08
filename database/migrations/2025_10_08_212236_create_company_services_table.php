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
        Schema::create('company_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('category', ['観光振興', '子育て支援', 'DX推進', 'インフラ整備', '地域活性化', '環境・エネルギー', 'その他']);
            $table->text('description')->comment('サービス・技術の詳細');
            $table->text('case_studies')->nullable()->comment('導入実績・事例');
            $table->text('strengths')->nullable()->comment('自社の強み');
            $table->enum('status', ['draft', 'published'])->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_services');
    }
};
