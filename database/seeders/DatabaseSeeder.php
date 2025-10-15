<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // カテゴリデータを先に作成（CompanySeederで必要）
        $this->call([
            CategorySeeder::class,
        ]);

        // 管理者ユーザー、首長、企業データを作成
        $this->call([
            AdminUserSeeder::class,
            MunicipalitySeeder::class,
            CompanySeeder::class,
        ]);
    }
}
