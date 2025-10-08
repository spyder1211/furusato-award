# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## プロジェクト概要

**ふるさとアワード マッチングプラットフォーム**は、首長同士のマッチングと自治体・企業のマッチングを促進し、地域課題の解決と自治体間連携を支援するプラットフォームです。アイハーツが仲介役として、円滑なマッチングと信頼性の担保を行います。

### MVP範囲
- **優先順位1：首長×首長マッチング機能**
- **優先順位2：企業×自治体マッチング機能**
- シンプルなオファー型のマッチング機能
- 管理者（アイハーツ）による手動仲介を前提とした設計
- 開発期間：4週間

## 技術スタック

### フレームワーク
- **Laravel** (純粋なLaravelアプリケーション)

### フロントエンド
- **Blade** テンプレートエンジン
- **Tailwind CSS** (CDN版) - 一般ユーザー向けページ
- **Filament 3.3** - 管理画面（Livewire + Alpine.js + Tailwind CSS）

### データベース
- **MySQL**
- **Eloquent ORM** (Laravel標準)

### 認証
- **Laravel標準認証** - 一般ユーザー向け（首長・企業）
- **Filament認証** - 管理者向け

### 管理画面
- **Filament 3.3** - Admin Panel
- 管理画面URL: `/admin`
- ユーザー管理、オファー管理、統計ダッシュボード等

### メール送信
- **Laravel Mail** (Mailtrap、SendGrid、Resend等)

### 開発環境
- PHP 8.1以上
- Composer
- MySQL 8.0以上

### AI開発支援ツール
- **Laravel Boost 1.3** - AI駆動の開発支援ツール
- **Laravel MCP** - Model Context Protocol統合
- コード生成の加速化、AIによる提案とコード補完

## 開発コマンド

### 初期セットアップ
```bash
# 依存関係のインストール
composer install

# 環境設定ファイルのコピー
cp .env.example .env

# アプリケーションキーの生成
php artisan key:generate

# データベースマイグレーション実行
php artisan migrate

# シーダー実行（必要に応じて）
php artisan db:seed
```

### 開発サーバー起動
```bash
php artisan serve
```

### データベース操作
```bash
# マイグレーションファイル作成
php artisan make:migration create_xxxxx_table

# マイグレーション実行
php artisan migrate

# マイグレーションロールバック
php artisan migrate:rollback

# マイグレーションリフレッシュ（全テーブル再作成）
php artisan migrate:fresh

# シーダー作成
php artisan make:seeder XxxxxSeeder
```

### モデル・コントローラー作成
```bash
# モデル作成
php artisan make:model ModelName

# マイグレーション付きモデル作成
php artisan make:model ModelName -m

# コントローラー作成
php artisan make:controller ControllerName

# リソースコントローラー作成
php artisan make:controller ControllerName --resource
```

### テスト実行
```bash
# 全テスト実行
php artisan test

# 特定のテスト実行
php artisan test --filter TestName
```

### キャッシュクリア
```bash
# アプリケーションキャッシュクリア
php artisan cache:clear

# 設定キャッシュクリア
php artisan config:clear

# ルートキャッシュクリア
php artisan route:clear

# ビューキャッシュクリア
php artisan view:clear
```

### Filament関連コマンド
```bash
# Filamentリソース作成（CRUD管理画面）
php artisan make:filament-resource ModelName

# 管理者ユーザー作成
php artisan make:filament-user

# Filamentページ作成
php artisan make:filament-page PageName

# Filamentウィジェット作成（ダッシュボード用）
php artisan make:filament-widget WidgetName

# Filamentリレーションマネージャー作成
php artisan make:filament-relation-manager ModelNameResource RelationName
```

## データベース構造

### 主要テーブル

**users**
- `id`: bigint (primary key)
- `email`: string (unique)
- `password`: string (hashed)
- `role`: enum('municipality', 'company', 'admin')
- `name`: string (首長名または担当者名)
- `phone`: string
- `is_approved`: boolean (default: false)
- `email_verified_at`: timestamp (nullable)
- `remember_token`: string (nullable)
- `created_at`, `updated_at`: timestamps

**municipality_profiles (首長プロフィール)**
- `id`: bigint (primary key)
- `user_id`: bigint (foreign key -> users.id, unique)
- `prefecture`: string (都道府県)
- `city`: string (市区町村名)
- `population`: decimal (人口、万人)
- `characteristics`: text (特色)
- `election_count`: integer (当選回数)
- `birthplace`: string (出身地)
- `university`: string (出身大学)
- `philosophy`: text (信条)
- `expertise`: text (得意分野)
- `furusato_tax_amount`: bigint (ふるさと納税金額、円)
- `created_at`, `updated_at`: timestamps

**company_profiles (企業プロフィール)**
- `id`: bigint (primary key)
- `user_id`: bigint (foreign key -> users.id, unique)
- `company_name`: string (企業名)
- `description`: text (事業概要)
- `services`: text (提供可能なサービス・技術)
- `created_at`, `updated_at`: timestamps

**company_services (企業サービス・技術事例)**
- `id`: bigint (primary key)
- `user_id`: bigint (foreign key -> users.id)
- `title`: string
- `category`: enum('観光振興', '子育て支援', 'DX推進', 'インフラ整備', '地域活性化', '環境・エネルギー', 'その他')
- `description`: text (サービス・技術の詳細)
- `case_studies`: text (nullable, 導入実績・事例)
- `strengths`: text (nullable, 自社の強み)
- `status`: enum('draft', 'published') (default: 'published')
- `created_at`, `updated_at`: timestamps

**municipality_offers (首長→首長オファー)**
- `id`: bigint (primary key)
- `sender_id`: bigint (foreign key -> users.id, 送信側の首長)
- `receiver_id`: bigint (foreign key -> users.id, 受信側の首長)
- `message`: text (nullable, オファーメッセージ)
- `status`: enum('pending', 'contacted', 'completed') (default: 'pending')
- `note`: text (nullable, 管理者用メモ)
- `created_at`, `updated_at`: timestamps

**company_offers (自治体→企業オファー)**
- `id`: bigint (primary key)
- `service_id`: bigint (foreign key -> company_services.id)
- `municipality_user_id`: bigint (foreign key -> users.id, 送信側の自治体)
- `message`: text (nullable, オファーメッセージ)
- `status`: enum('pending', 'contacted', 'completed') (default: 'pending')
- `note`: text (nullable, 管理者用メモ)
- `created_at`, `updated_at`: timestamps

### リレーション

```php
// User.php
public function municipalityProfile() { return $this->hasOne(MunicipalityProfile::class); }
public function companyProfile() { return $this->hasOne(CompanyProfile::class); }
public function companyServices() { return $this->hasMany(CompanyService::class); }
public function sentMunicipalityOffers() { return $this->hasMany(MunicipalityOffer::class, 'sender_id'); }
public function receivedMunicipalityOffers() { return $this->hasMany(MunicipalityOffer::class, 'receiver_id'); }
public function companyOffers() { return $this->hasMany(CompanyOffer::class, 'municipality_user_id'); }

// MunicipalityProfile.php
public function user() { return $this->belongsTo(User::class); }

// CompanyProfile.php
public function user() { return $this->belongsTo(User::class); }

// CompanyService.php
public function user() { return $this->belongsTo(User::class); }
public function companyOffers() { return $this->hasMany(CompanyOffer::class, 'service_id'); }

// MunicipalityOffer.php
public function sender() { return $this->belongsTo(User::class, 'sender_id'); }
public function receiver() { return $this->belongsTo(User::class, 'receiver_id'); }

// CompanyOffer.php
public function companyService() { return $this->belongsTo(CompanyService::class, 'service_id'); }
public function municipality() { return $this->belongsTo(User::class, 'municipality_user_id'); }
```

## コア機能

### 1. 会員登録・認証
- メールアドレス + パスワード
- 首長/企業を選択
- 管理者による承認制（承認までは閲覧のみ可能）

**首長登録時のプロフィール項目:**
- 都道府県、市区町村名
- 人口、特色
- 当選回数、出身地、出身大学
- 信条、得意分野
- ふるさと納税金額

**企業登録時のプロフィール項目:**
- 企業名、担当者名
- 事業概要
- 提供可能なサービス・技術

### 2. 首長×首長マッチング（最優先機能）
- 首長プロフィール一覧・詳細表示
- フィルター機能（都道府県、人口規模、得意分野）
- オファー機能（首長→首長）
- オファー送信時、管理者にフラグが上がる
- 受信したオファーの一覧・詳細表示
- ページネーション（20件/ページ）

### 3. 企業×自治体マッチング
- 企業がサービス・技術事例を掲載
- すべてのユーザーがサービス一覧を閲覧可能
- カテゴリフィルター
- オファー機能（自治体→企業）
- オファー送信時、管理者にフラグが上がる
- 受信したオファーの一覧・詳細表示

### 4. 通知機能
- メール通知のみ
- 送信タイミング:
  - 首長オファーが送られた（オファー先首長・管理者向け）
  - 企業オファーが送られた（オファー先企業・管理者向け）

### 5. 管理機能
- ユーザー承認/却下
- プロフィール編集機能
- 首長マッチング管理（オファー一覧、ステータス管理、メモ機能）
- 企業マッチング管理（サービス一覧、オファー一覧、ステータス管理、メモ機能）
- 基本統計（ユーザー数、オファー数、マッチング成立数）

## MVP で除外する機能

以下は次フェーズ以降に実装:
- システム内チャット機能
- ファイルアップロード機能
- 高度な検索機能（キーワード検索など）
- おすすめ機能・レコメンド
- 詳細な分析レポート
- プロフィール画像アップロード
- パスワードリセット機能（管理者が手動対応）
- 二段階認証
- マッチング後の商談日程調整機能
- 双方向承認フロー（オファーは一方向のみ）

## ユーザーフロー

### 首長（首長マッチング）
1. 会員登録（詳細なプロフィール入力） → 管理者承認待ち
2. 承認後、他の首長プロフィールを閲覧
3. 気になる首長にオファーを送信
4. 他の首長からオファーを受信
5. アイハーツから連絡を受けて商談調整

### 首長（企業マッチング）
1. 会員登録（首長マッチングと同じ）→ 管理者承認待ち
2. 承認後、企業サービス一覧を閲覧
3. 気になる企業サービスにオファーを送信
4. アイハーツから連絡を受けて商談調整

### 企業
1. 会員登録（企業プロフィール入力） → 管理者承認待ち
2. 承認後、自社のサービス・技術事例を掲載
3. 自治体からオファーを受信
4. アイハーツから連絡を受けて商談調整

### 管理者（アイハーツ）
1. 新規登録を承認
2. オファー通知を受ける（首長→首長、自治体→企業）
3. 両者に連絡し、商談を調整
4. ステータスを更新（対応中/完了）
5. メモで対応履歴を記録

## 開発時の注意事項

### アーキテクチャ
- **MVC パターン**に従う（Model-View-Controller）
- ビジネスロジックはモデルまたはサービスクラスに配置
- コントローラーは薄く保ち、ルーティングとビューの橋渡しのみ
- Bladeテンプレートは `/resources/views/` に配置
- コンポーネント化が必要な場合はBlade Componentsを活用

### ルーティング
- ルート定義は `/routes/web.php` に記述
- リソースフルなルーティングには `Route::resource()` を使用
- 認証が必要なルートには `auth` ミドルウェアを適用

### 認証・認可
- **ロールベースのアクセス制御**を実装
- `role` カラム: `municipality` / `company` / `admin`
- 承認待ちユーザーは `is_approved` フラグで管理し、閲覧のみ可能
- Middleware（`EnsureUserIsApproved` など）で承認状態をチェック
- Gate または Policy を使用して認可ロジックを実装
- コントローラーで `$this->authorize()` を使用

### Eloquentモデル
- リレーションは必ずモデルに定義する
  - User hasOne MunicipalityProfile, hasOne CompanyProfile
  - User hasMany CompanyServices
  - User hasMany MunicipalityOffers (sent/received)
  - User hasMany CompanyOffers
  - MunicipalityProfile belongsTo User
  - CompanyProfile belongsTo User
  - CompanyService belongsTo User, hasMany CompanyOffers
  - MunicipalityOffer belongsTo User (sender), belongsTo User (receiver)
  - CompanyOffer belongsTo CompanyService, belongsTo User (municipality)
- Mass Assignment対策として `$fillable` または `$guarded` を設定
- キャストは `$casts` プロパティで定義
- enumカラムは必ず `$casts` でキャストする

### Bladeテンプレート
- レイアウトファイル（`layouts/app.blade.php`）を作成し、`@extends` で継承
- Tailwind CSS CDNを `<head>` タグ内で読み込む
- 共通コンポーネントは `/resources/views/components/` に配置
- XSS対策のため `{{ }}` を使用（`{!! !!}` は避ける）
- フォームには必ず `@csrf` トークンを含める

### UI/UX
- シンプルで直感的なUIを重視
- Tailwind CSSのユーティリティクラスを活用
- レスポンシブデザイン（PC、タブレット、スマートフォン対応）
- アクセシビリティを考慮したマークアップ

### バリデーション
- Form Requestクラスを作成し、バリデーションロジックを分離
- `php artisan make:request XxxxxRequest`
- 日本語エラーメッセージは `/resources/lang/ja/validation.php` で定義

### 通知
- メール通知のみ実装（プッシュ通知は次フェーズ）
- Laravel Mailableクラスを使用
- 送信タイミング:
  - 首長オファーが送られた（オファー先首長・管理者向け）
  - 企業オファーが送られた（オファー先企業・管理者向け）
- 開発時はMailtrapを使用してメールテスト
- 管理者へのフラグ通知は、オファー作成時にイベント/リスナーで実装すると保守性が高い

### セキュリティ
- SSL/TLS通信
- パスワードの自動ハッシュ化（Laravel標準機能）
- CSRF保護（全POSTリクエストに `@csrf` 必須）
- SQLインジェクション対策（Eloquent ORM使用）
- XSS対策（Bladeの `{{ }}` を使用）
- Mass Assignment対策（`$fillable` 設定）

### 首長マッチング実装時の注意点
- 同じ首長に複数回オファーを送れないようにバリデーション（unique制約またはビジネスロジック）
- 自分自身にオファーを送れないようにバリデーション
- オファー送信時は必ず管理者にメール通知
- プロフィール一覧のフィルター機能は、URLクエリパラメータを使用して実装
- 人口は decimal 型で保存し、表示時に「〇〇万人」と表示

### 企業マッチング実装時の注意点
- 企業サービスは企業アカウントのみ投稿可能
- 企業オファーは首長アカウントのみ送信可能
- 同じサービスに複数回オファーを送れないようにバリデーション
- オファー送信時は必ず管理者と企業にメール通知

### Filament管理画面実装時の注意点
- **Filamentリソース**: 各モデルに対してFilamentリソースを作成し、CRUD操作を実装
  - `php artisan make:filament-resource User --generate`
  - `--generate` オプションで既存モデルから自動生成可能
- **日本語化**: Filamentは日本語に対応しているため、`config/app.php` の `locale` を `ja` に設定
- **認証**: Filamentは独自の認証システムを持つため、管理者ユーザーは `is_admin` や `role` で判定
- **リレーション**: `RelationManager` を使用してリレーションデータを管理
- **カスタムアクション**: テーブルやフォームにカスタムアクションを追加可能
- **ウィジェット**: ダッシュボードに統計情報を表示するウィジェットを作成
- **通知**: Filamentの通知機能を使用して、管理者に通知を送信可能
- **ポリシー**: Laravelのポリシーを使用して、管理画面のアクセス制御を実装

### Filamentリソースの例
```php
// app/Filament/Resources/UserResource.php
public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('name')->label('名前')->searchable(),
            TextColumn::make('email')->label('メール')->searchable(),
            BadgeColumn::make('role')->label('ロール')
                ->colors([
                    'success' => 'municipality',
                    'warning' => 'company',
                    'danger' => 'admin',
                ])
                ->enum([
                    'municipality' => '首長',
                    'company' => '企業',
                    'admin' => '管理者',
                ]),
            IconColumn::make('is_approved')->label('承認状態')->boolean(),
        ])
        ->filters([
            SelectFilter::make('role')->label('ロール')
                ->options([
                    'municipality' => '首長',
                    'company' => '企業',
                    'admin' => '管理者',
                ]),
            TernaryFilter::make('is_approved')->label('承認済み'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
}
```

## 成功指標（KPI）

MVPフェーズで検証すべき指標:
- ユーザー登録数: 首長20名、企業30社
- 首長オファー数: 15件以上
- 企業サービス投稿数: 30件以上
- 企業オファー数: 20件以上
- マッチング成立数: 10件以上（首長5件、企業5件）

## 関連ドキュメント

- `requirements.md`: 全体要件定義書
- `mvp_requirements.md`: MVP詳細仕様書
- [Laravel 11 Documentation](https://laravel.com/docs/11.x)
- [Filament 3 Documentation](https://filamentphp.com/docs/3.x)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
