<!-- ヘッダー -->
<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="/" class="text-xl font-bold text-blue-600">ふるさとコネクト</a>
            </div>
            <nav class="flex space-x-4">
                <a href="/" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">トップ</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">ダッシュボード</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">ログイン</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg text-sm font-medium">新規登録</a>
                @endauth
            </nav>
        </div>
    </div>
</header>
