# セットアップガイド

このドキュメントは、開発環境のセットアップ手順をまとめたものです。

## 前提条件

- PHP 8.1 以上
- Composer
- MySQL 8.0 以上
- Node.js & npm（Vite用、オプション）

## 初回セットアップ

### 1. リポジトリのクローン

```bash
cd /Users/spyder/i-hearts/furusato_award
```

### 2. 依存関係のインストール

```bash
composer install
```

### 3. 環境設定

```bash
# .envファイルが存在しない場合
cp .env.example .env

# アプリケーションキー生成
php artisan key:generate
```

### 4. データベースの作成

```bash
mysql -uroot -e "CREATE DATABASE IF NOT EXISTS furusato_award CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 5. .envファイルの設定

`.env`ファイルを開いて、以下の設定を確認：

```env
APP_NAME="ふるさとアワード"
APP_ENV=local
APP_DEBUG=true
APP_TIMEZONE=Asia/Tokyo
APP_URL=http://localhost:8001

APP_LOCALE=ja
APP_FALLBACK_LOCALE=ja
APP_FAKER_LOCALE=ja_JP

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=furusato_award
DB_USERNAME=root
DB_PASSWORD=
```

### 6. マイグレーション実行

```bash
php artisan migrate
```

### 7. 開発サーバー起動

```bash
php artisan serve
```

サーバーが起動したら、ブラウザで以下にアクセス：
- フロント: http://127.0.0.1:8001
- 管理画面: http://127.0.0.1:8001/admin

## 既存環境の再セットアップ

### データベースをリセットする場合

```bash
# すべてのテーブルを削除して再作成
php artisan migrate:fresh

# シーダーも実行する場合
php artisan migrate:fresh --seed
```

### キャッシュをクリアする場合

```bash
# すべてのキャッシュをクリア
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# または一括で
php artisan optimize:clear
```

## Filament管理者ユーザーの作成

```bash
php artisan make:filament-user
```

対話形式で以下を入力：
- Name: 管理者名
- Email: admin@example.com
- Password: パスワード

## トラブルシューティング

### マイグレーションエラー

```bash
# マイグレーションをロールバック
php artisan migrate:rollback

# 特定のステップ数だけロールバック
php artisan migrate:rollback --step=3

# すべてリセットして再実行
php artisan migrate:fresh
```

### Composerエラー

```bash
# Composerキャッシュをクリア
composer clear-cache

# 依存関係を再インストール
rm -rf vendor composer.lock
composer install
```

### パーミッションエラー

```bash
# storage と bootstrap/cache のパーミッション設定
chmod -R 775 storage bootstrap/cache
```

## 開発時によく使うコマンド

```bash
# モデル作成（マイグレーション付き）
php artisan make:model ModelName -m

# コントローラー作成
php artisan make:controller ControllerName

# Filamentリソース作成
php artisan make:filament-resource ModelName

# シーダー作成
php artisan make:seeder ModelNameSeeder

# テスト実行
php artisan test
```

## インストール済みパッケージ

- **laravel/framework**: ^11.0
- **filament/filament**: ^3.2
- **laravel/boost**: ^1.3
- **laravel/tinker**: ^2.10
- **laravel/pail**: ^1.2

開発用：
- **phpunit/phpunit**: ^11.0
- **laravel/pint**: ^1.0
- **nunomaduro/collision**: ^8.0

## ディレクトリ構造

```
furusato_award/
├── app/
│   ├── Models/              # Eloquentモデル
│   ├── Http/
│   │   └── Controllers/     # コントローラー
│   ├── Filament/
│   │   └── Resources/       # Filament管理画面リソース
│   └── Providers/
│       └── Filament/
│           └── AdminPanelProvider.php
├── database/
│   ├── migrations/          # マイグレーションファイル
│   ├── seeders/             # シーダーファイル
│   └── factories/           # ファクトリー
├── resources/
│   └── views/               # Bladeテンプレート
├── routes/
│   └── web.php              # Webルート定義
├── docs/                    # プロジェクトドキュメント
├── CLAUDE.md                # 開発ガイド
├── mvp_requirements.md      # MVP仕様書
└── requirements.md          # 要件定義書
```

## 次のステップ

セットアップが完了したら、`docs/progress.md` を確認して、次のタスクに進んでください。
