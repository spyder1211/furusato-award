<!-- フッター -->
<footer class="bg-gray-900 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- サービス -->
            <div>
                <h3 class="text-lg font-semibold mb-4">サービス</h3>
                <ul class="space-y-2">
                    <li><a href="/#about" class="text-gray-400 hover:text-white">サービス概要</a></li>
                    <li><a href="{{ route('terms') }}" class="text-gray-400 hover:text-white">利用規約</a></li>
                    <li><a href="{{ route('privacy') }}" class="text-gray-400 hover:text-white">プライバシーポリシー</a></li>
                </ul>
            </div>

            <!-- サポート -->
            <div>
                <h3 class="text-lg font-semibold mb-4">サポート</h3>
                <ul class="space-y-2">
                    <li><a href="mailto:info@ihearts.co.jp" class="text-gray-400 hover:text-white">お問い合わせ</a></li>
                </ul>
            </div>

            <!-- 運営会社 -->
            <div>
                <h3 class="text-lg font-semibold mb-4">運営会社</h3>
                <p class="text-gray-400">株式会社アイハーツ</p>
                <p class="text-gray-400 mt-2">
                    お問い合わせ:<br>
                    <a href="mailto:info@ihearts.co.jp" class="hover:text-white">info@ihearts.co.jp</a>
                </p>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2025 i-hearts, Inc. All Rights Reserved.</p>
        </div>
    </div>
</footer>
