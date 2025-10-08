# ふるさとアワード マッチングプラットフォーム - 開発進捗状況

**最終更新**: 2025年10月8日

## プロジェクト概要

首長同士のマッチングと自治体・企業のマッチングを促進する、地域課題解決支援プラットフォーム。
アイハーツが仲介役として、円滑なマッチングと信頼性を担保。

## 現在のステータス

### ✅ 完了したタスク

#### 1. 環境構築
- [x] Laravel 11.46.1 インストール完了
- [x] MySQL データベース作成（`furusato_award`）
- [x] 日本語設定（タイムゾーン: Asia/Tokyo、ロケール: ja）
- [x] 開発サーバー起動確認（http://127.0.0.1:8001）

#### 2. パッケージインストール
- [x] **Filament 3.3.43** - 管理画面パネル
  - 管理画面URL: `/admin`
  - AdminPanelProvider作成済み
- [x] **Laravel Boost 1.3.0** - AI開発支援ツール
- [x] **Laravel MCP 0.2.1** - Model Context Protocol

#### 3. データベース設計・マイグレーション
すべてのマイグレーションファイルを作成し、実行完了：

**✅ usersテーブル拡張**
- `role` enum('municipality', 'company', 'admin')
- `is_approved` boolean (default: false)
- `phone` string

**✅ municipality_profiles（首長プロフィール）**
- user_id (unique, foreign key)
- prefecture（都道府県）
- city（市区町村名）
- population（人口、万人）
- characteristics（特色）
- election_count（当選回数）
- birthplace（出身地）
- university（出身大学）
- philosophy（信条）
- expertise（得意分野）
- furusato_tax_amount（ふるさと納税金額）

**✅ company_profiles（企業プロフィール）**
- user_id (unique, foreign key)
- company_name（企業名）
- description（事業概要）
- services（提供可能なサービス・技術）

**✅ company_services（企業サービス・技術事例）**
- user_id (foreign key)
- title（タイトル）
- category（カテゴリ: 観光振興、子育て支援、DX推進、インフラ整備、地域活性化、環境・エネルギー、その他）
- description（サービス・技術の詳細）
- case_studies（導入実績・事例）
- strengths（自社の強み）
- status (draft / published)

**✅ municipality_offers（首長→首長オファー）**
- sender_id (foreign key -> users)
- receiver_id (foreign key -> users)
- message（オファーメッセージ）
- status (pending / contacted / completed)
- note（管理者用メモ）
- unique制約 (sender_id, receiver_id) - 重複オファー防止

**✅ company_offers（自治体→企業オファー）**
- service_id (foreign key -> company_services)
- municipality_user_id (foreign key -> users)
- message（オファーメッセージ）
- status (pending / contacted / completed)
- note（管理者用メモ）
- unique制約 (service_id, municipality_user_id) - 重複オファー防止

#### 4. ドキュメント整備
- [x] CLAUDE.md 作成・更新
  - 技術スタック詳細
  - データベース構造
  - Eloquentリレーション定義
  - 開発時の注意事項
  - Filament実装ガイド
- [x] mvp_requirements.md 更新
  - 優先順位の明確化（首長マッチング最優先）
  - 詳細な機能仕様
  - 技術スタック更新（Laravel + Filament）

## 技術スタック

### フレームワーク・ライブラリ
- **Laravel 11.46.1** - PHPフレームワーク
- **Filament 3.3.43** - 管理画面パネル
- **Laravel Boost 1.3.0** - AI開発支援
- **Livewire 3.6.4** - リアクティブコンポーネント（Filamentの依存）

### フロントエンド
- **Blade** - テンプレートエンジン
- **Tailwind CSS (CDN)** - 一般ユーザー向けページ
- **Filament UI** - 管理画面（Livewire + Alpine.js + Tailwind CSS）

### データベース
- **MySQL** - furusato_award
- **Eloquent ORM** - Laravel標準

### 開発環境
- PHP 8.1以上
- Composer
- MySQL 8.0以上

## 未完了のタスク

### 次のステップ（優先順位順）

#### 1. Eloquentモデルの作成
- [ ] User モデルの拡張
  - role、is_approved のキャスト設定
  - リレーション定義
- [ ] MunicipalityProfile モデル作成
- [ ] CompanyProfile モデル作成
- [ ] CompanyService モデル作成
- [ ] MunicipalityOffer モデル作成
- [ ] CompanyOffer モデル作成

#### 2. Filament管理画面の構築
- [ ] 管理者ユーザーの作成
- [ ] UserResource 作成（ユーザー管理CRUD）
- [ ] MunicipalityProfileResource 作成
- [ ] CompanyProfileResource 作成
- [ ] CompanyServiceResource 作成
- [ ] MunicipalityOfferResource 作成（オファー管理）
- [ ] CompanyOfferResource 作成（オファー管理）
- [ ] ダッシュボードウィジェット作成（統計表示）

#### 3. 一般ユーザー向け認証機能
- [ ] Laravel Breeze インストール（または手動実装）
- [ ] 会員登録フォーム作成
  - 首長/企業 選択
  - ロール別の入力項目
- [ ] ログイン機能
- [ ] ロール別リダイレクト処理

#### 4. 首長マッチング機能（最優先）
- [ ] 首長プロフィール一覧ページ
  - フィルター機能（都道府県、人口規模、得意分野）
  - ページネーション
- [ ] 首長プロフィール詳細ページ
- [ ] オファー送信機能
  - バリデーション（自分自身へのオファー防止）
  - 重複チェック
  - 管理者への通知メール
- [ ] オファー受信一覧ページ
- [ ] マイページ（自分のプロフィール編集）

#### 5. 企業マッチング機能
- [ ] 企業サービス一覧ページ
  - カテゴリフィルター
  - ページネーション
- [ ] 企業サービス詳細ページ
- [ ] 企業サービス投稿機能（企業のみ）
- [ ] オファー送信機能（自治体→企業）
  - 重複チェック
  - 管理者・企業への通知メール
- [ ] オファー受信一覧ページ（企業側）

#### 6. メール通知機能
- [ ] Mailable クラス作成
  - 首長オファー通知
  - 企業オファー通知
  - 管理者向け通知
- [ ] イベント/リスナー実装
- [ ] Mailtrap 設定（開発環境）

#### 7. テスト・デプロイ
- [ ] 機能テスト作成
- [ ] シーダー作成（テストデータ）
- [ ] 本番環境準備

## 重要な設定情報

### データベース接続
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=furusato_award
DB_USERNAME=root
DB_PASSWORD=
```

### アプリケーション設定
```
APP_NAME="ふるさとアワード"
APP_TIMEZONE=Asia/Tokyo
APP_LOCALE=ja
```

### Filament
- 管理画面パス: `/admin`
- プロバイダー: `app/Providers/Filament/AdminPanelProvider.php`

### 開発サーバー
```bash
php artisan serve
# http://127.0.0.1:8001
```

## マイグレーションファイル一覧

```
database/migrations/
├── 2025_10_08_212042_add_role_and_is_approved_to_users_table.php
├── 2025_10_08_212128_create_municipality_profiles_table.php
├── 2025_10_08_212236_create_company_profiles_table.php
├── 2025_10_08_212236_create_company_services_table.php
├── 2025_10_08_212237_create_municipality_offers_table.php
└── 2025_10_08_212237_create_company_offers_table.php
```

## コマンドクイックリファレンス

```bash
# マイグレーション
php artisan migrate
php artisan migrate:fresh  # リセット

# モデル作成
php artisan make:model ModelName -m

# Filamentリソース作成
php artisan make:filament-resource ModelName

# 管理者ユーザー作成
php artisan make:filament-user

# 開発サーバー
php artisan serve

# キャッシュクリア
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 参考ドキュメント

- `CLAUDE.md` - 開発ガイド（技術スタック、データベース構造、実装ガイドライン）
- `mvp_requirements.md` - MVP詳細仕様書
- `requirements.md` - 全体要件定義書
- [Laravel 11 Documentation](https://laravel.com/docs/11.x)
- [Filament 3 Documentation](https://filamentphp.com/docs/3.x)

## 注意事項

### 重要な実装ポイント
1. **オファーの重複防止**: データベースレベルでユニーク制約を設定済み
2. **自分自身へのオファー防止**: フロントエンド・バックエンドでバリデーション必要
3. **管理者への通知**: オファー送信時に必ずメール通知を実装
4. **承認制**: 新規登録ユーザーは `is_approved=false`、管理者承認後に利用可能
5. **ロール別アクセス制御**: Middleware、Policy、Gateで実装

### 開発の優先順位
1. **首長×首長マッチング** - 最優先機能
2. **企業×自治体マッチング** - 次優先
3. **管理画面（Filament）** - 並行して実装

## 次回セッション開始時のアクションプラン

1. Eloquentモデルを一括作成
2. 各モデルにリレーション・キャスト・Fillable定義を追加
3. Filament管理者ユーザーを作成
4. UserResourceから順にFilamentリソースを作成

---

**プロジェクト進捗**: データベース設計完了（約20%）
**次のマイルストーン**: モデル作成とFilament管理画面構築（目標: Week 2完了）
