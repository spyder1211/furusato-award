<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. category_id カラムを追加（nullable）
        Schema::table('company_services', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('title')->constrained()->onDelete('restrict');
        });

        // 2. 既存データを category から category_id に移行
        $categoryMapping = [
            '観光振興' => 'tourism',
            '子育て支援' => 'childcare',
            'DX推進' => 'dx',
            'インフラ整備' => 'infrastructure',
            '地域活性化' => 'regional-revitalization',
            '環境・エネルギー' => 'environment-energy',
            'その他' => 'other',
        ];

        foreach ($categoryMapping as $oldCategory => $slug) {
            $category = Category::where('slug', $slug)->first();
            if ($category) {
                DB::table('company_services')
                    ->where('category', $oldCategory)
                    ->update(['category_id' => $category->id]);
            }
        }

        // 3. category_id を NOT NULL に変更
        Schema::table('company_services', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable(false)->change();
        });

        // 4. 古い category カラムを削除
        Schema::table('company_services', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. category カラムを再追加
        Schema::table('company_services', function (Blueprint $table) {
            $table->string('category')->nullable()->after('title');
        });

        // 2. データを category_id から category に戻す
        $categories = Category::all();
        foreach ($categories as $category) {
            DB::table('company_services')
                ->where('category_id', $category->id)
                ->update(['category' => $category->name]);
        }

        // 3. category を NOT NULL に変更
        Schema::table('company_services', function (Blueprint $table) {
            $table->string('category')->nullable(false)->change();
        });

        // 4. category_id カラムと外部キー制約を削除
        Schema::table('company_services', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
