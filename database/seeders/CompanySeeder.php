<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CompanyProfile;
use App\Models\CompanyService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'user' => [
                    'name' => '山田次郎',
                    'email' => 'company1@example.com',
                    'phone' => '03-1234-5678',
                ],
                'profile' => [
                    'company_name' => '株式会社観光DXソリューション',
                    'description' => '観光業界向けのDXソリューションを提供。デジタルマーケティング、予約システム、観光データ分析など幅広くサポート。',
                    'services' => 'デジタルマーケティング、予約管理システム、観光データ分析',
                ],
                'company_services' => [
                    [
                        'title' => 'AI活用観光プロモーションシステム',
                        'category' => '観光振興',
                        'description' => "AIを活用した観光プロモーションシステムで、訪日外国人観光客の動向分析や効果的な広告配信を実現。\n\n主な機能：\n- SNSデータ分析による観光トレンド把握\n- ターゲット層に最適化された広告配信\n- 多言語対応の観光情報発信\n- リアルタイムでの効果測定",
                        'case_studies' => '沖縄県A市での導入事例：訪日観光客数が前年比30%増加、SNSエンゲージメント率が2倍に向上。',
                        'strengths' => '10年以上の観光業界での実績、AIエンジニア20名以上在籍、多言語対応（15言語）',
                        'status' => 'published',
                    ],
                    [
                        'title' => 'スマート観光予約プラットフォーム',
                        'category' => '観光振興',
                        'description' => "観光施設・体験プログラムの予約をワンストップで管理できるプラットフォーム。\n\n特徴：\n- 複数施設の一括予約管理\n- キャッシュレス決済対応\n- 多言語対応（英語・中国語・韓国語）\n- スマホアプリ対応",
                        'case_studies' => '北海道B市で導入、20施設が参加し、年間予約数10万件を突破。',
                        'strengths' => '導入実績50自治体以上、24時間365日サポート体制、初期費用無料プランあり',
                        'status' => 'published',
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => '鈴木三郎',
                    'email' => 'company2@example.com',
                    'phone' => '06-2345-6789',
                ],
                'profile' => [
                    'company_name' => '株式会社子育て支援テック',
                    'description' => '子育て世代をサポートするICTサービスを開発。保育園管理システム、子育て情報アプリなど。',
                    'services' => '保育園管理システム、子育て情報アプリ、オンライン相談サービス',
                ],
                'company_services' => [
                    [
                        'title' => 'スマート保育園管理システム',
                        'category' => '子育て支援',
                        'description' => "保育園の業務をデジタル化し、保育士の負担を軽減。保護者とのコミュニケーションも円滑に。\n\n主な機能：\n- 園児の出欠管理\n- 連絡帳のデジタル化\n- 写真共有機能\n- 請求書自動作成\n- 保護者向けアプリ連携",
                        'case_studies' => '東京都内50園で導入、保育士の事務作業時間を40%削減、保護者満足度95%達成。',
                        'strengths' => '保育現場の声を反映した使いやすいUI、導入サポート充実、月額低コスト',
                        'status' => 'published',
                    ],
                    [
                        'title' => '子育て支援情報プラットフォーム',
                        'category' => '子育て支援',
                        'description' => "地域の子育て支援情報をワンストップで提供するアプリ。\n\n機能：\n- 自治体の子育て支援制度検索\n- イベント情報配信\n- ママ友コミュニティ\n- 専門家への相談機能\n- 予防接種スケジュール管理",
                        'case_studies' => '大阪府C市で導入、アプリダウンロード数3万件突破、利用者満足度92%。',
                        'strengths' => 'ユーザー目線の設計、自治体向けカスタマイズ対応、セキュリティ対策万全',
                        'status' => 'published',
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => '田中四郎',
                    'email' => 'company3@example.com',
                    'phone' => '052-3456-7890',
                ],
                'profile' => [
                    'company_name' => '株式会社スマートシティソリューションズ',
                    'description' => '自治体DX推進を総合的にサポート。行政システムのクラウド化、データ分析、デジタル人材育成まで。',
                    'services' => '行政システムクラウド化、データ分析・可視化、デジタル人材育成研修',
                ],
                'company_services' => [
                    [
                        'title' => '自治体DX推進パッケージ',
                        'category' => 'DX推進',
                        'description' => "自治体のDX推進を包括的にサポートするサービス。\n\n提供内容：\n- DX推進計画策定支援\n- 既存システムの現状分析\n- クラウド移行支援\n- 職員向けDX研修\n- デジタル人材育成プログラム",
                        'case_studies' => '山梨県D市で導入、年間システム運用コストを30%削減、住民サービスのオンライン化率80%達成。',
                        'strengths' => '自治体DX支援実績100件以上、総務省推奨システム採用、伴走型支援',
                        'status' => 'published',
                    ],
                    [
                        'title' => 'オープンデータ活用プラットフォーム',
                        'category' => 'DX推進',
                        'description' => "自治体が保有するデータをオープンデータとして公開・活用するプラットフォーム。\n\n特徴：\n- データカタログ自動生成\n- API自動公開機能\n- データ可視化ダッシュボード\n- 利用状況分析機能",
                        'case_studies' => '愛知県E市で導入、公開データセット数500件突破、民間企業との連携事業10件創出。',
                        'strengths' => '国のオープンデータ基準完全対応、継続的なデータ更新支援、低コスト運用',
                        'status' => 'published',
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => '佐藤五郎',
                    'email' => 'company4@example.com',
                    'phone' => '092-4567-8901',
                ],
                'profile' => [
                    'company_name' => '株式会社インフラマネジメント',
                    'description' => '道路・橋梁などのインフラ管理をICT化。点検・診断・補修計画までトータルサポート。',
                    'services' => 'インフラ点検システム、橋梁管理システム、補修計画策定支援',
                ],
                'company_services' => [
                    [
                        'title' => 'AI道路・橋梁点検システム',
                        'category' => 'インフラ整備',
                        'description' => "AIとドローンを活用した効率的なインフラ点検システム。\n\n主な機能：\n- ドローンによる自動撮影\n- AIによる損傷箇所自動検出\n- 点検記録のデジタル管理\n- 補修優先度の自動判定\n- 長期修繕計画策定支援",
                        'case_studies' => '福岡県F市で導入、点検作業時間を60%削減、点検精度向上により事故リスク30%低減。',
                        'strengths' => 'AI判定精度95%以上、ドローン操縦士常駐、国土交通省認定技術',
                        'status' => 'published',
                    ],
                    [
                        'title' => 'インフラ長寿命化管理システム',
                        'category' => 'インフラ整備',
                        'description' => "道路・橋梁・トンネル等のインフラ情報を一元管理し、長寿命化を実現。\n\n機能：\n- インフラ台帳のデジタル化\n- 点検履歴管理\n- 劣化予測シミュレーション\n- 予算最適化提案\n- GISとの連携",
                        'case_studies' => '広島県G市で導入、管理対象橋梁200基のデータを一元管理、維持管理コスト20%削減。',
                        'strengths' => '国のインフラ長寿命化計画に完全対応、導入実績30自治体、充実した研修プログラム',
                        'status' => 'published',
                    ],
                ],
            ],
            [
                'user' => [
                    'name' => '高橋六郎',
                    'email' => 'company5@example.com',
                    'phone' => '011-5678-9012',
                ],
                'profile' => [
                    'company_name' => '株式会社グリーンエナジーソリューション',
                    'description' => '再生可能エネルギー導入支援、省エネ診断、カーボンニュートラル実現コンサルティング。',
                    'services' => '太陽光発電導入支援、省エネ診断、カーボンニュートラル計画策定',
                ],
                'company_services' => [
                    [
                        'title' => '自治体向けカーボンニュートラル実現支援',
                        'category' => '環境・エネルギー',
                        'description' => "2050年カーボンニュートラル実現に向けた総合支援サービス。\n\n支援内容：\n- CO2排出量の現状分析\n- 削減目標設定支援\n- 再生可能エネルギー導入計画\n- 省エネ施策提案\n- 進捗管理・効果測定",
                        'case_studies' => '長野県H市で導入、CO2排出量を5年間で25%削減、再エネ比率40%達成。',
                        'strengths' => '環境省認定コンサルタント在籍、補助金申請サポート、継続的なフォローアップ',
                        'status' => 'published',
                    ],
                    [
                        'title' => '公共施設エネルギーマネジメントシステム',
                        'category' => '環境・エネルギー',
                        'description' => "公共施設のエネルギー使用状況を見える化し、最適制御を実現。\n\n機能：\n- リアルタイムエネルギー監視\n- AI による最適制御\n- 電力使用量予測\n- コスト削減提案\n- レポート自動作成",
                        'case_studies' => '北海道I市で20施設に導入、年間電気代を15%削減、CO2排出量20%削減。',
                        'strengths' => '初期費用ゼロのサブスクモデル、遠隔監視対応、全国対応可能',
                        'status' => 'published',
                    ],
                    [
                        'title' => '地域新電力会社設立支援',
                        'category' => '地域活性化',
                        'description' => "地域の再生可能エネルギーを活用した新電力会社設立を全面サポート。\n\n支援内容：\n- 事業性調査\n- 事業計画策定\n- 小売電気事業者登録支援\n- 需給管理システム提供\n- 運営ノウハウ提供",
                        'case_studies' => '全国10自治体で新電力会社設立を支援、地域経済への年間総還元額10億円以上。',
                        'strengths' => '新電力設立実績10件、エネルギー専門家チーム、地域経済循環を重視',
                        'status' => 'published',
                    ],
                ],
            ],
        ];

        foreach ($companies as $company) {
            // ユーザー作成
            $user = User::create([
                'name' => $company['user']['name'],
                'email' => $company['user']['email'],
                'password' => Hash::make('password'),
                'phone' => $company['user']['phone'],
                'role' => 'company',
                'is_approved' => true, // テストデータは承認済み
            ]);

            // 企業プロフィール作成
            CompanyProfile::create([
                'user_id' => $user->id,
                'company_name' => $company['profile']['company_name'],
                'description' => $company['profile']['description'],
                'services' => $company['profile']['services'],
            ]);

            // 企業サービス作成
            foreach ($company['company_services'] as $service) {
                CompanyService::create([
                    'user_id' => $user->id,
                    'title' => $service['title'],
                    'category' => $service['category'],
                    'description' => $service['description'],
                    'case_studies' => $service['case_studies'] ?? null,
                    'strengths' => $service['strengths'] ?? null,
                    'status' => $service['status'],
                ]);
            }
        }
    }
}
