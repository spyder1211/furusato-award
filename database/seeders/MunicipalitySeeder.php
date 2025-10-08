<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MunicipalityProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipalities = [
            [
                'user' => [
                    'name' => '田中太郎',
                    'email' => 'mayor1@example.com',
                    'phone' => '090-1234-5678',
                ],
                'profile' => [
                    'prefecture' => '北海道',
                    'city' => '札幌市',
                    'population' => 196.5,
                    'characteristics' => '北海道の中心都市。観光と食が豊かで、雪まつりなど国際的なイベントも多数。',
                    'election_count' => 2,
                    'birthplace' => '北海道',
                    'university' => '北海道大学',
                    'philosophy' => '市民一人ひとりが輝く、活力ある街づくりを目指しています。',
                    'expertise' => '観光振興、地域活性化、国際交流',
                    'furusato_tax_amount' => 500000000,
                ],
            ],
            [
                'user' => [
                    'name' => '佐藤花子',
                    'email' => 'mayor2@example.com',
                    'phone' => '090-2345-6789',
                ],
                'profile' => [
                    'prefecture' => '東京都',
                    'city' => '八王子市',
                    'population' => 57.8,
                    'characteristics' => '東京都の中核都市。多摩地域の商業・文化の中心地として発展。',
                    'election_count' => 1,
                    'birthplace' => '東京都',
                    'university' => '早稲田大学',
                    'philosophy' => '子育て世代が住みやすい街づくりを推進します。',
                    'expertise' => '子育て支援、教育、DX推進',
                    'furusato_tax_amount' => 300000000,
                ],
            ],
            [
                'user' => [
                    'name' => '鈴木一郎',
                    'email' => 'mayor3@example.com',
                    'phone' => '090-3456-7890',
                ],
                'profile' => [
                    'prefecture' => '沖縄県',
                    'city' => '那覇市',
                    'population' => 32.1,
                    'characteristics' => '沖縄県の県庁所在地。観光業が盛んで、独自の文化と歴史を持つ。',
                    'election_count' => 3,
                    'birthplace' => '沖縄県',
                    'university' => '琉球大学',
                    'philosophy' => '伝統文化を大切にしながら、未来に向けた発展を目指します。',
                    'expertise' => '観光振興、文化振興、環境保護',
                    'furusato_tax_amount' => 450000000,
                ],
            ],
            [
                'user' => [
                    'name' => '高橋健太',
                    'email' => 'mayor4@example.com',
                    'phone' => '090-4567-8901',
                ],
                'profile' => [
                    'prefecture' => '山梨県',
                    'city' => '都留市',
                    'population' => 3.0,
                    'characteristics' => '富士山麓に位置し、豊かな自然と良質な水に恵まれた街。',
                    'election_count' => 2,
                    'birthplace' => '山梨県',
                    'university' => '山梨大学',
                    'philosophy' => '自然と共生する持続可能な地域づくりを推進します。',
                    'expertise' => '環境・エネルギー、地域活性化、移住促進',
                    'furusato_tax_amount' => 80000000,
                ],
            ],
            [
                'user' => [
                    'name' => '伊藤美咲',
                    'email' => 'mayor5@example.com',
                    'phone' => '090-5678-9012',
                ],
                'profile' => [
                    'prefecture' => '京都府',
                    'city' => '京都市',
                    'population' => 146.9,
                    'characteristics' => '歴史と伝統文化の街。世界遺産が多数あり、国内外から多くの観光客が訪れる。',
                    'election_count' => 1,
                    'birthplace' => '京都府',
                    'university' => '京都大学',
                    'philosophy' => '伝統文化を継承しつつ、先進的な街づくりを進めます。',
                    'expertise' => '観光振興、文化振興、DX推進',
                    'furusato_tax_amount' => 700000000,
                ],
            ],
            [
                'user' => [
                    'name' => '渡辺誠',
                    'email' => 'mayor6@example.com',
                    'phone' => '090-6789-0123',
                ],
                'profile' => [
                    'prefecture' => '福岡県',
                    'city' => '福岡市',
                    'population' => 161.0,
                    'characteristics' => '九州最大の都市。ビジネスと観光の拠点として発展。',
                    'election_count' => 2,
                    'birthplace' => '福岡県',
                    'university' => '九州大学',
                    'philosophy' => 'アジアに開かれた国際都市を目指します。',
                    'expertise' => 'インフラ整備、国際交流、DX推進',
                    'furusato_tax_amount' => 600000000,
                ],
            ],
            [
                'user' => [
                    'name' => '中村陽子',
                    'email' => 'mayor7@example.com',
                    'phone' => '090-7890-1234',
                ],
                'profile' => [
                    'prefecture' => '長野県',
                    'city' => '松本市',
                    'population' => 23.9,
                    'characteristics' => '北アルプスの麓に位置する城下町。観光と農業が盛ん。',
                    'election_count' => 1,
                    'birthplace' => '長野県',
                    'university' => '信州大学',
                    'philosophy' => '自然と歴史を活かした観光と農業の振興を推進します。',
                    'expertise' => '観光振興、農業振興、地域活性化',
                    'furusato_tax_amount' => 150000000,
                ],
            ],
            [
                'user' => [
                    'name' => '小林大輔',
                    'email' => 'mayor8@example.com',
                    'phone' => '090-8901-2345',
                ],
                'profile' => [
                    'prefecture' => '広島県',
                    'city' => '広島市',
                    'population' => 120.3,
                    'characteristics' => '平和記念都市として世界的に知られる。産業と文化が融合した街。',
                    'election_count' => 2,
                    'birthplace' => '広島県',
                    'university' => '広島大学',
                    'philosophy' => '平和と繁栄の街づくりを進めます。',
                    'expertise' => '平和教育、産業振興、国際交流',
                    'furusato_tax_amount' => 550000000,
                ],
            ],
        ];

        foreach ($municipalities as $municipality) {
            // ユーザー作成
            $user = User::create([
                'name' => $municipality['user']['name'],
                'email' => $municipality['user']['email'],
                'password' => Hash::make('password'),
                'phone' => $municipality['user']['phone'],
                'role' => 'municipality',
                'is_approved' => true, // テストデータは承認済み
            ]);

            // プロフィール作成
            MunicipalityProfile::create([
                'user_id' => $user->id,
                'prefecture' => $municipality['profile']['prefecture'],
                'city' => $municipality['profile']['city'],
                'population' => $municipality['profile']['population'],
                'characteristics' => $municipality['profile']['characteristics'],
                'election_count' => $municipality['profile']['election_count'],
                'birthplace' => $municipality['profile']['birthplace'],
                'university' => $municipality['profile']['university'],
                'philosophy' => $municipality['profile']['philosophy'],
                'expertise' => $municipality['profile']['expertise'],
                'furusato_tax_amount' => $municipality['profile']['furusato_tax_amount'],
            ]);
        }
    }
}
