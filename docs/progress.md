# ふるさとアワード マッチングプラットフォーム - 開発進捗状況

**最終更新**: 2025年10月8日（首長マッチング機能完成）

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

#### 5. Eloquentモデルの作成
すべてのモデルを作成し、リレーション・キャスト・Fillable定義を完了：

**✅ User モデル拡張**
- $fillable に role, phone, is_approved 追加
- $casts に is_approved => 'boolean' 追加
- リレーション定義完了:
  - hasOne MunicipalityProfile
  - hasOne CompanyProfile
  - hasMany CompanyServices
  - hasMany sentMunicipalityOffers (sender_id)
  - hasMany receivedMunicipalityOffers (receiver_id)
  - hasMany CompanyOffers (municipality_user_id)

**✅ MunicipalityProfile モデル**
- $fillable 定義完了（全カラム）
- $casts 定義: population (decimal:2), election_count (integer), furusato_tax_amount (integer)
- リレーション: belongsTo User

**✅ CompanyProfile モデル**
- $fillable 定義完了（全カラム）
- リレーション: belongsTo User

**✅ CompanyService モデル**
- $fillable 定義完了（全カラム）
- リレーション定義:
  - belongsTo User
  - hasMany CompanyOffers (service_id)

**✅ MunicipalityOffer モデル**
- $fillable 定義完了（全カラム）
- リレーション定義:
  - belongsTo sender (User, sender_id)
  - belongsTo receiver (User, receiver_id)

**✅ CompanyOffer モデル**
- $fillable 定義完了（全カラム）
- リレーション定義:
  - belongsTo CompanyService (service_id)
  - belongsTo municipality (User, municipality_user_id)

#### 6. Filament管理画面の構築
すべてのFilamentリソースを作成し、管理画面機能が完成：

**✅ 管理者ユーザー作成**
- AdminUserSeeder 作成
- Email: admin@ihearts.co.jp / Password: password
- role: admin, is_approved: true

**✅ UserResource（ユーザー管理）**
- 日本語ラベル対応
- role別バッジ表示（首長/企業/管理者）
- 承認/却下アクション実装
- フィルター機能（role、承認状態）
- パスワード編集対応（作成時必須、編集時任意）

**✅ MunicipalityOfferResource（首長マッチング管理）**
- 送信者・受信者情報表示（名前、自治体名）
- ステータス管理（新規/対応中/完了）
- ステータス変更アクション実装
- 管理者メモ機能
- ステータスフィルター

**✅ CompanyServiceResource（企業サービス管理）**
- 企業名・カテゴリ表示
- カテゴリ別バッジ（7カテゴリ対応）
- 公開状態管理（下書き/公開）
- カテゴリ・公開状態フィルター
- 企業ユーザーのみ選択可能

**✅ CompanyOfferResource（企業マッチング管理）**
- 自治体・企業・サービス情報表示
- ステータス管理（新規/対応中/完了）
- ステータス変更アクション実装
- 管理者メモ機能
- カテゴリ・ステータスフィルター

**管理画面アクセス情報:**
- URL: http://127.0.0.1:8001/admin
- Email: admin@ihearts.co.jp
- Password: password

#### 7. 一般ユーザー向け認証機能
Laravel Breezeをベースに、カスタム認証機能を実装完了：

**✅ Laravel Breeze インストール**
- Bladeスタック使用
- Tailwind CSS統合

**✅ 会員登録フォーム**
- 首長/企業の選択（ラジオボタン）
- 必須項目: 登録区分、名前、メール、電話番号、パスワード
- 登録時に is_approved = false に設定
- 日本語ラベル対応

**✅ ログインフォーム**
- メールアドレス + パスワード認証
- 日本語ラベル対応
- 新規登録へのリンク追加

**✅ 承認制システム**
- EnsureUserIsApprovedミドルウェア作成
- 承認されていないユーザーは承認待ちページにリダイレクト
- 管理者は承認チェックをスキップ
- 承認待ちページ実装（登録情報表示、ログアウト機能）

**✅ ミドルウェア登録**
- bootstrap/app.phpに 'approved' エイリアス登録
- dashboard, profileルートに適用

#### 8. 首長×首長マッチング機能（最優先機能）
首長マッチングのコア機能を完全実装：

**✅ コントローラー**
- `MunicipalityProfileController` - プロフィール一覧・詳細・編集
- `MunicipalityOfferController` - オファー送信・受信管理

**✅ ルーティング（routes/web.php）**
- 認証 + 承認済みミドルウェア適用
- プロフィール一覧: `/municipalities`
- プロフィール詳細: `/municipalities/{id}`
- マイページ: `/municipalities/my/profile`
- オファー送信: `POST /municipalities/offers`
- オファー受信一覧: `/municipalities/offers/received`
- オファー送信一覧: `/municipalities/offers/sent`

**✅ ビューファイル**
- `municipalities/index.blade.php` - プロフィール一覧
  - 都道府県・人口規模・得意分野フィルター
  - ページネーション（20件/ページ）
  - カード型レイアウト
- `municipalities/show.blade.php` - プロフィール詳細
  - 全プロフィール情報表示
  - オファー送信フォーム（首長アカウントのみ）
  - 送信済みチェック機能
- `municipalities/edit.blade.php` - マイページ（プロフィール編集）
  - 全プロフィール項目の編集
  - バリデーション対応
- `municipalities/offers/received.blade.php` - 受信オファー一覧
  - ステータスバッジ表示（新規/対応中/完了）
  - メッセージ表示
  - 送信元プロフィールへのリンク
- `municipalities/offers/sent.blade.php` - 送信オファー一覧
  - ステータスバッジ表示
  - 送信先プロフィールへのリンク

**✅ 実装機能**
- フィルター検索（都道府県、人口規模、得意分野）
- ページネーション（20件/ページ）
- オファー送信機能
  - 重複防止バリデーション
  - 自分自身への送信防止
  - データベースレベルのユニーク制約
- オファー管理（送信・受信タブ切り替え）
- ステータス管理（pending/contacted/completed）
- ナビゲーションメニュー統合（首長アカウントのみ表示）

**✅ テストデータ**
- `MunicipalitySeeder` - 8名の首長データ作成
  - 北海道札幌市、東京都八王子市、沖縄県那覇市、山梨県都留市、
    京都府京都市、福岡県福岡市、長野県松本市、広島県広島市
  - 各首長に詳細なプロフィール情報
  - 全ユーザー承認済み（is_approved: true）
  - パスワード: password

**テストアカウント:**
- Email: mayor1@example.com ~ mayor8@example.com
- Password: password（全員共通）

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

#### 1. Eloquentモデルの作成 ✅ **完了**
- [x] User モデルの拡張
  - role、is_approved のキャスト設定
  - リレーション定義
- [x] MunicipalityProfile モデル作成
- [x] CompanyProfile モデル作成
- [x] CompanyService モデル作成
- [x] MunicipalityOffer モデル作成
- [x] CompanyOffer モデル作成

#### 2. Filament管理画面の構築 ✅ **完了**
- [x] 管理者ユーザーの作成
- [x] UserResource 作成（ユーザー管理CRUD）
- [x] MunicipalityOfferResource 作成（オファー管理）
- [x] CompanyServiceResource 作成
- [x] CompanyOfferResource 作成（オファー管理）

**注:** プロフィールリソースとダッシュボードウィジェットは次フェーズで実装

#### 3. 一般ユーザー向け認証機能 ✅ **完了**
- [x] Laravel Breeze インストール（Bladeスタック）
- [x] 会員登録フォーム作成
  - 首長/企業 選択（ラジオボタン）
  - 電話番号フィールド追加
  - 日本語ラベル対応
- [x] ログイン機能（日本語化）
- [x] 承認制ミドルウェア実装
- [x] 承認待ちページ実装
- [x] ロール別リダイレクト処理

#### 4. 首長マッチング機能（最優先） ✅ **完了**
- [x] 首長プロフィール一覧ページ
  - フィルター機能（都道府県、人口規模、得意分野）
  - ページネーション
- [x] 首長プロフィール詳細ページ
- [x] オファー送信機能
  - バリデーション（自分自身へのオファー防止）
  - 重複チェック
  - ~~管理者への通知メール~~ （次のステップで実装）
- [x] オファー受信一覧ページ
- [x] オファー送信一覧ページ
- [x] マイページ（自分のプロフィール編集）
- [x] テストデータシーダー作成

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
- [x] シーダー作成（テストデータ） - 首長データ完了
- [ ] 企業テストデータシーダー作成
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

1. ✅ Eloquentモデルを一括作成 - **完了**
2. ✅ 各モデルにリレーション・キャスト・Fillable定義を追加 - **完了**
3. ✅ Filament管理者ユーザーを作成 - **完了**
4. ✅ UserResourceから順にFilamentリソースを作成 - **完了**
5. ✅ 管理画面でユーザー承認機能を実装 - **完了**
6. ✅ 一般ユーザー向け認証機能を実装（Laravel Breeze） - **完了**
7. ✅ 首長プロフィール一覧・詳細ページを作成 - **完了**
8. ✅ 首長マッチングのオファー機能を実装 - **完了**
9. メール通知機能を実装（オファー送信時の通知）
10. 企業マッチング機能を実装

## 作成済みファイル一覧

### Eloquentモデル
```
app/Models/
├── User.php (拡張済み)
├── MunicipalityProfile.php ✅
├── CompanyProfile.php ✅
├── CompanyService.php ✅
├── MunicipalityOffer.php ✅
└── CompanyOffer.php ✅
```

### Filamentリソース
```
app/Filament/Resources/
├── UserResource.php ✅
├── MunicipalityOfferResource.php ✅
├── CompanyServiceResource.php ✅
└── CompanyOfferResource.php ✅
```

### Seeder
```
database/seeders/
├── DatabaseSeeder.php ✅ (更新済み)
├── AdminUserSeeder.php ✅
└── MunicipalitySeeder.php ✅ (8名の首長テストデータ)
```

### 認証関連
```
app/Http/Controllers/Auth/
└── RegisteredUserController.php ✅ (カスタマイズ済み)

app/Http/Middleware/
└── EnsureUserIsApproved.php ✅

resources/views/auth/
├── register.blade.php ✅ (カスタマイズ済み)
├── login.blade.php ✅ (日本語化)
└── pending-approval.blade.php ✅

routes/
├── web.php ✅ (承認制ミドルウェア適用)
└── auth.php ✅ (Laravel Breeze標準)

bootstrap/
└── app.php ✅ (ミドルウェアエイリアス登録)
```

### 首長マッチング機能
```
app/Http/Controllers/
├── MunicipalityProfileController.php ✅
└── MunicipalityOfferController.php ✅

resources/views/municipalities/
├── index.blade.php ✅ (プロフィール一覧)
├── show.blade.php ✅ (プロフィール詳細)
├── edit.blade.php ✅ (マイページ・プロフィール編集)
└── offers/
    ├── received.blade.php ✅ (受信オファー一覧)
    └── sent.blade.php ✅ (送信オファー一覧)

resources/views/layouts/
└── navigation.blade.php ✅ (首長メニュー追加)

routes/
└── web.php ✅ (首長マッチングルート追加)
```

---

**プロジェクト進捗**: 首長マッチング機能完了（約75%）
**次のマイルストーン**: メール通知機能 + 企業マッチング機能（目標: Week 3完了）
