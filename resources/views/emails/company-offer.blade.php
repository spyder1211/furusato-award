<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>企業オファー通知</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, 'Hiragino Kaku Gothic ProN', 'Hiragino Sans', Meiryo, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #10b981;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9fafb;
            padding: 30px;
            border: 1px solid #e5e7eb;
            border-top: none;
        }
        .info-box {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #10b981;
            border-radius: 4px;
        }
        .info-label {
            font-weight: bold;
            color: #6b7280;
            font-size: 0.9em;
            margin-bottom: 5px;
        }
        .info-value {
            color: #111827;
            font-size: 1.1em;
            margin-bottom: 15px;
        }
        .category-badge {
            display: inline-block;
            background-color: #dbeafe;
            color: #1e40af;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        .message-box {
            background-color: #fef3c7;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            border: 1px solid #fbbf24;
        }
        .button {
            display: inline-block;
            background-color: #10b981;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 0.9em;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $isForAdmin ? '【管理者通知】' : '' }}新しい企業オファー</h1>
    </div>

    <div class="content">
        @if($isForAdmin)
            <p>新しい企業マッチングオファーが送信されました。</p>
        @else
            <p>{{ $offer->companyService->user->name }} 様</p>
            <p>いつもふるさとアワードをご利用いただきありがとうございます。<br>
            貴社のサービスに対して、自治体からオファーが届きました。</p>
        @endif

        <div class="info-box">
            <div class="info-label">オファー元の自治体</div>
            <div class="info-value">
                {{ $offer->municipality->municipalityProfile->prefecture }}
                {{ $offer->municipality->municipalityProfile->city }}<br>
                {{ $offer->municipality->name }}
            </div>

            <div class="info-label">対象サービス</div>
            <div class="info-value">
                <span class="category-badge">{{ $offer->companyService->category }}</span><br>
                <strong>{{ $offer->companyService->title }}</strong>
            </div>

            @if(!$isForAdmin)
                <div class="info-label">企業名</div>
                <div class="info-value">
                    {{ $offer->companyService->user->companyProfile->company_name }}
                </div>
            @endif

            @if($offer->message)
                <div class="info-label">メッセージ</div>
                <div class="message-box">
                    {!! nl2br(e($offer->message)) !!}
                </div>
            @endif

            <div class="info-label">送信日時</div>
            <div class="info-value">{{ $offer->created_at->format('Y年m月d日 H:i') }}</div>
        </div>

        @if($isForAdmin)
            <p>
                <a href="{{ config('app.url') }}/admin/company-offers/{{ $offer->id }}/edit" class="button">
                    管理画面で確認する
                </a>
            </p>
            <p style="color: #6b7280; font-size: 0.9em;">
                ※ 両者への連絡調整を行い、ステータスを更新してください。
            </p>
        @else
            <p>
                <a href="{{ config('app.url') }}/companies/offers/received" class="button">
                    オファー一覧を見る
                </a>
            </p>
            <p style="color: #6b7280; font-size: 0.9em;">
                ※ アイハーツより後日連絡調整のご連絡をさせていただきます。
            </p>
        @endif
    </div>

    <div class="footer">
        <p>このメールは ふるさとアワード マッチングプラットフォーム より自動送信されています。</p>
        <p>株式会社アイハーツ<br>
        Email: noreply@ihearts.co.jp</p>
    </div>
</body>
</html>
