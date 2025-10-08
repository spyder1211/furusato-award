<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 管理者ユーザーが既に存在する場合はスキップ
        if (User::where('email', 'admin@ihearts.co.jp')->exists()) {
            $this->command->info('管理者ユーザーは既に存在します。');
            return;
        }

        User::create([
            'name' => 'アイハーツ管理者',
            'email' => 'admin@ihearts.co.jp',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '000-0000-0000',
            'is_approved' => true,
            'email_verified_at' => now(),
        ]);

        $this->command->info('管理者ユーザーを作成しました。');
        $this->command->info('Email: admin@ihearts.co.jp');
        $this->command->info('Password: password');
    }
}
