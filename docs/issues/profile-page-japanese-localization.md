# Issue: プロフィールページの日本語化

## 概要
現在のプロフィールページ（`http://localhost:8000/profile`）の表示言語を日本語化する。

## 影響範囲
- URL: `/profile`
- ファイル:
  - `resources/views/profile/edit.blade.php`
  - `resources/views/profile/partials/update-profile-information-form.blade.php`
  - `resources/views/profile/partials/update-password-form.blade.php`
  - `resources/views/profile/partials/delete-user-form.blade.php`

## 現状
- テンプレートファイルは `__()` ヘルパー関数を使用しているが、英語表示のまま
- 日本向けサイトのため、多言語化は不要

## 方針
- 言語ファイルは使用せず、Bladeビューファイルを直接日本語に書き換える
- `{{ __('...') }}` の部分を日本語テキストに置き換える

## 要件

### 日本語化が必要な項目

#### メインページ（edit.blade.php）
| 英語キー | 日本語翻訳 |
|---------|-----------|
| Profile | プロフィール |

#### プロフィール情報更新セクション
| 英語キー | 日本語翻訳 |
|---------|-----------|
| Profile Information | プロフィール情報 |
| Update your account's profile information and email address. | アカウントのプロフィール情報とメールアドレスを更新します。 |
| Name | 名前 |
| Email | メールアドレス |
| Your email address is unverified. | メールアドレスが未確認です。 |
| Click here to re-send the verification email. | 確認メールを再送信するにはこちらをクリックしてください。 |
| A new verification link has been sent to your email address. | 新しい確認リンクがメールアドレスに送信されました。 |
| Save | 保存 |
| Saved. | 保存しました。 |

#### パスワード更新セクション
| 英語キー | 日本語翻訳 |
|---------|-----------|
| Update Password | パスワード変更 |
| Ensure your account is using a long, random password to stay secure. | アカウントのセキュリティを保つため、長くランダムなパスワードを使用してください。 |
| Current Password | 現在のパスワード |
| New Password | 新しいパスワード |
| Confirm Password | パスワード確認 |
| Save | 保存 |
| Saved. | 保存しました。 |

#### アカウント削除セクション
| 英語キー | 日本語翻訳 |
|---------|-----------|
| Delete Account | アカウント削除 |
| Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain. | アカウントを削除すると、すべてのリソースとデータが完全に削除されます。アカウントを削除する前に、保持したいデータや情報をダウンロードしてください。 |
| Are you sure you want to delete your account? | 本当にアカウントを削除しますか？ |
| Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account. | アカウントを削除すると、すべてのリソースとデータが完全に削除されます。アカウントを完全に削除する場合は、パスワードを入力して確認してください。 |
| Password | パスワード |
| Cancel | キャンセル |

### 実装手順

#### 1. edit.blade.php の修正
- `{{ __('Profile') }}` → `プロフィール`

#### 2. update-profile-information-form.blade.php の修正
- `{{ __('Profile Information') }}` → `プロフィール情報`
- `{{ __("Update your account's profile information and email address.") }}` → `アカウントのプロフィール情報とメールアドレスを更新します。`
- `:value="__('Name')"` → `:value="'名前'"`
- `:value="__('Email')"` → `:value="'メールアドレス'"`
- その他の `__()` ヘルパーをすべて日本語テキストに置き換え

#### 3. update-password-form.blade.php の修正
- `{{ __('Update Password') }}` → `パスワード変更`
- `{{ __('Ensure your account is using a long, random password to stay secure.') }}` → `アカウントのセキュリティを保つため、長くランダムなパスワードを使用してください。`
- その他の `__()` ヘルパーをすべて日本語テキストに置き換え

#### 4. delete-user-form.blade.php の修正
- `{{ __('Delete Account') }}` → `アカウント削除`
- その他の `__()` ヘルパーをすべて日本語テキストに置き換え

#### 5. 動作確認
- `http://localhost:8000/profile` にアクセス
- 全テキストが日本語で表示されることを確認

### テスト項目
- [ ] ページヘッダーが「プロフィール」と表示される
- [ ] プロフィール情報セクションが日本語で表示される
- [ ] パスワード変更セクションが日本語で表示される
- [ ] アカウント削除セクションが日本語で表示される
- [ ] フォーム送信時の成功メッセージ「保存しました。」が表示される
- [ ] メール未確認の場合、日本語で警告が表示される
- [ ] アカウント削除モーダルが日本語で表示される
- [ ] バリデーションエラーメッセージが日本語で表示される

## 優先度
**中** - ユーザビリティ向上のため、早期対応が望ましい

## 関連Issue
- 認証ページの日本語化（登録、ログイン）
- 首長プロフィール編集ページの日本語化
- 企業プロフィール編集ページの日本語化

## 備考
- Filament管理画面は既に日本語化されている
- Laravel Breezeの認証ページ（登録・ログイン）も同様に日本語化が必要
- 統一感を持たせるため、他のページと翻訳用語を統一すること
- 本サイトは日本向けのため、多言語化は実装しない（将来的に必要になった場合は言語ファイル化を検討）

## 完了条件
- [ ] 4つのBladeファイルがすべて日本語化されている
- [ ] プロフィールページの全テキストが日本語で表示される
- [ ] 成功メッセージが日本語で表示される（「保存しました。」）
- [ ] レスポンシブデザインが維持されている
- [ ] 既存機能に影響がない

## 推定作業時間
30分〜1時間

## 作成日
2025-10-13
