<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => '観光振興', 'slug' => 'tourism', 'sort_order' => 1, 'is_active' => true],
            ['name' => '子育て支援', 'slug' => 'childcare', 'sort_order' => 2, 'is_active' => true],
            ['name' => 'DX推進', 'slug' => 'dx', 'sort_order' => 3, 'is_active' => true],
            ['name' => 'インフラ整備', 'slug' => 'infrastructure', 'sort_order' => 4, 'is_active' => true],
            ['name' => '地域活性化', 'slug' => 'regional-revitalization', 'sort_order' => 5, 'is_active' => true],
            ['name' => '環境・エネルギー', 'slug' => 'environment-energy', 'sort_order' => 6, 'is_active' => true],
            ['name' => 'その他', 'slug' => 'other', 'sort_order' => 99, 'is_active' => true],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
