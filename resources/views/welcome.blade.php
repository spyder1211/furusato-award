<x-layouts.landing>
    <!-- Header / Global Navigation -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm shadow-sm" x-data="{ mobileMenuOpen: false }">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl md:text-3xl font-bold gradient-text">
                        ふるさとコネクト
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#overview" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">サービス概要</a>
                    <a href="#municipality" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">首長マッチング</a>
                    <a href="#company" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">企業マッチング</a>
                    <a href="#flow" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">利用の流れ</a>
                </div>

                <!-- CTA Buttons (Desktop) -->
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">ダッシュボード</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">ログイン</a>
                        <a href="{{ route('register') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105">新規登録</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" x-cloak x-transition class="md:hidden pb-4 border-t border-gray-200 mt-2">
                <div class="flex flex-col space-y-3 pt-4">
                    <a href="#overview" @click="mobileMenuOpen = false" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">サービス概要</a>
                    <a href="#municipality" @click="mobileMenuOpen = false" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">首長マッチング</a>
                    <a href="#company" @click="mobileMenuOpen = false" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">企業マッチング</a>
                    <a href="#flow" @click="mobileMenuOpen = false" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">利用の流れ</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">ダッシュボード</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">ログイン</a>
                        <a href="{{ route('register') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold text-center transition-all duration-200">新規登録</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 md:pt-40 md:pb-32 overflow-hidden bg-gradient-to-br from-primary-50 via-white to-secondary-50">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center animate-on-scroll">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                    地域をつなぐ、<br class="md:hidden">
                    <span class="gradient-text">未来をつくる</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto mb-10 leading-relaxed">
                    首長同士の連携、自治体と企業のマッチングを促進。<br>
                    アイハーツが信頼できる仲介役として、地域の未来をサポートします。
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('register') }}?role=municipality" class="w-full sm:w-auto bg-primary-600 hover:bg-primary-700 text-white px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="flex items-center justify-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            首長として登録する
                        </span>
                    </a>
                    <a href="{{ route('register') }}?role=company" class="w-full sm:w-auto bg-secondary-600 hover:bg-secondary-700 text-white px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="flex items-center justify-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            企業として登録する
                        </span>
                    </a>
                    <a href="#overview" class="w-full sm:w-auto bg-white hover:bg-gray-50 text-primary-600 border-2 border-primary-600 px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-200">
                        サービス詳細を見る
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Overview Section -->
    <section id="overview" class="py-20 md:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">ふるさとコネクトとは</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    ふるさとコネクトは、自治体間の連携と企業とのマッチングを促進する<br class="hidden md:block">
                    プラットフォームです。首長同士の交流、地域課題の解決、<br class="hidden md:block">
                    イノベーションの創出をサポートします。
                </p>
            </div>

            <!-- 3 Features -->
            <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
                <!-- Feature 1 -->
                <div class="text-center animate-on-scroll">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-primary-100 rounded-full mb-6">
                        <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">信頼できる仲介</h3>
                    <ul class="text-gray-600 space-y-2 leading-relaxed">
                        <li>アイハーツが全マッチングを仲介</li>
                        <li>安心・安全なビジネス環境</li>
                        <li>プロフェッショナルなサポート</li>
                    </ul>
                </div>

                <!-- Feature 2 -->
                <div class="text-center animate-on-scroll">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-secondary-100 rounded-full mb-6">
                        <svg class="w-10 h-10 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">効率的なマッチング</h3>
                    <ul class="text-gray-600 space-y-2 leading-relaxed">
                        <li>プロフィール検索で最適な相手を発見</li>
                        <li>オファー機能で簡単コンタクト</li>
                        <li>メール通知で見逃さない</li>
                    </ul>
                </div>

                <!-- Feature 3 -->
                <div class="text-center animate-on-scroll">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-accent-100 rounded-full mb-6">
                        <svg class="w-10 h-10 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">実績とノウハウ</h3>
                    <ul class="text-gray-600 space-y-2 leading-relaxed">
                        <li>自治体・企業双方のニーズを理解</li>
                        <li>地域活性化の豊富な実績</li>
                        <li>継続的なサポート体制</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Municipality Matching Section -->
    <section id="municipality" class="py-20 md:py-32 bg-gradient-to-br from-primary-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">首長×首長マッチング</h2>
                <p class="text-xl text-gray-600 mb-2">自治体間の連携で、地域課題を解決</p>
                <p class="text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    先進事例を持つ自治体、同じ課題を抱える自治体と繋がり、<br class="hidden md:block">
                    相互に学び合い、連携協定を結ぶきっかけを作ります。
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <!-- Feature 1 -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 animate-on-scroll">
                    <div class="flex items-center justify-center w-16 h-16 bg-primary-100 rounded-lg mb-6">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">プロフィール検索</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>都道府県、人口規模で絞り込み</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>得意分野から探す</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>詳細なプロフィール情報</span>
                        </li>
                    </ul>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 animate-on-scroll">
                    <div class="flex items-center justify-center w-16 h-16 bg-primary-100 rounded-lg mb-6">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">オファー機能</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>気になる自治体にオファー送信</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>アイハーツが仲介・調整</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>安心の商談サポート</span>
                        </li>
                    </ul>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 animate-on-scroll">
                    <div class="flex items-center justify-center w-16 h-16 bg-primary-100 rounded-lg mb-6">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">マイページ</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>自治体プロフィール編集</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>受信・送信オファー管理</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>ステータス確認</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Use Cases -->
            <div class="bg-white rounded-xl p-8 md:p-10 shadow-lg animate-on-scroll">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">活用シーン例</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-primary-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">観光振興の先進事例を学びたい</span>
                    </div>
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-primary-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">子育て支援の施策について意見交換したい</span>
                    </div>
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-primary-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">DX推進で連携できる自治体を探したい</span>
                    </div>
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-primary-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">移住促進の取り組みを共有したい</span>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-12 animate-on-scroll">
                <a href="{{ route('register') }}?role=municipality" class="inline-block bg-primary-600 hover:bg-primary-700 text-white px-10 py-4 rounded-lg font-semibold text-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    首長として登録する
                </a>
            </div>
        </div>
    </section>

    <!-- Company Matching Section -->
    <section id="company" class="py-20 md:py-32 bg-gradient-to-br from-secondary-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">企業×自治体マッチング</h2>
                <p class="text-xl text-gray-600 mb-2">あなたのサービスで、地域課題を解決</p>
                <p class="text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    自治体が抱える課題に対し、あなたの企業が持つサービス・技術で<br class="hidden md:block">
                    解決策を提案。新しいビジネスチャンスを創出します。
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <!-- Feature 1 -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 animate-on-scroll">
                    <div class="flex items-center justify-center w-16 h-16 bg-secondary-100 rounded-lg mb-6">
                        <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">サービス掲載</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>自社サービスを登録・公開</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>7つのカテゴリから選択</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>導入実績・事例をアピール</span>
                        </li>
                    </ul>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 animate-on-scroll">
                    <div class="flex items-center justify-center w-16 h-16 bg-secondary-100 rounded-lg mb-6">
                        <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">オファー受信</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>自治体からオファーを受け取る</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>アイハーツが商談を調整</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>確実なビジネス機会</span>
                        </li>
                    </ul>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 animate-on-scroll">
                    <div class="flex items-center justify-center w-16 h-16 bg-secondary-100 rounded-lg mb-6">
                        <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">効率的な営業</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>全国の自治体にリーチ</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>ターゲティングされた商談</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>成約率の向上</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Categories -->
            <div class="bg-white rounded-xl p-8 md:p-10 shadow-lg mb-12 animate-on-scroll">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">対応カテゴリ</h3>
                <div class="flex flex-wrap justify-center gap-3">
                    <span class="px-6 py-3 bg-secondary-100 text-secondary-700 rounded-full font-semibold">観光振興</span>
                    <span class="px-6 py-3 bg-secondary-100 text-secondary-700 rounded-full font-semibold">子育て支援</span>
                    <span class="px-6 py-3 bg-secondary-100 text-secondary-700 rounded-full font-semibold">DX推進</span>
                    <span class="px-6 py-3 bg-secondary-100 text-secondary-700 rounded-full font-semibold">インフラ整備</span>
                    <span class="px-6 py-3 bg-secondary-100 text-secondary-700 rounded-full font-semibold">地域活性化</span>
                    <span class="px-6 py-3 bg-secondary-100 text-secondary-700 rounded-full font-semibold">環境・エネルギー</span>
                    <span class="px-6 py-3 bg-secondary-100 text-secondary-700 rounded-full font-semibold">その他</span>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center animate-on-scroll">
                <a href="{{ route('register') }}?role=company" class="inline-block bg-secondary-600 hover:bg-secondary-700 text-white px-10 py-4 rounded-lg font-semibold text-lg transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    企業として登録する
                </a>
            </div>
        </div>
    </section>

    <!-- Flow Section -->
    <section id="flow" class="py-20 md:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">ご利用の流れ</h2>
            </div>

            <!-- Municipality Flow -->
            <div class="mb-20">
                <h3 class="text-2xl font-bold text-primary-600 mb-10 text-center">首長の場合</h3>
                <div class="grid md:grid-cols-4 gap-8">
                    <!-- Step 1 -->
                    <div class="text-center animate-on-scroll">
                        <div class="flex items-center justify-center w-20 h-20 bg-primary-100 rounded-full mx-auto mb-6 relative">
                            <span class="text-3xl font-bold text-primary-600">1</span>
                            <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-primary-200"></div>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">会員登録</h4>
                        <p class="text-gray-600 leading-relaxed">
                            詳細なプロフィール情報を入力<br>
                            （都道府県、市区町村、人口、得意分野など）
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center animate-on-scroll">
                        <div class="flex items-center justify-center w-20 h-20 bg-primary-100 rounded-full mx-auto mb-6 relative">
                            <span class="text-3xl font-bold text-primary-600">2</span>
                            <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-primary-200"></div>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">管理者承認</h4>
                        <p class="text-gray-600 leading-relaxed">
                            アイハーツによる審査・承認<br>
                            （通常1〜2営業日）
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center animate-on-scroll">
                        <div class="flex items-center justify-center w-20 h-20 bg-primary-100 rounded-full mx-auto mb-6 relative">
                            <span class="text-3xl font-bold text-primary-600">3</span>
                            <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-primary-200"></div>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">検索・オファー</h4>
                        <p class="text-gray-600 leading-relaxed">
                            他の首長プロフィールを検索<br>
                            気になる自治体にオファー送信
                        </p>
                    </div>

                    <!-- Step 4 -->
                    <div class="text-center animate-on-scroll">
                        <div class="flex items-center justify-center w-20 h-20 bg-primary-100 rounded-full mx-auto mb-6">
                            <span class="text-3xl font-bold text-primary-600">4</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">商談・連携</h4>
                        <p class="text-gray-600 leading-relaxed">
                            アイハーツが両者を仲介<br>
                            オンライン面談・連携協定へ
                        </p>
                    </div>
                </div>
            </div>

            <!-- Company Flow -->
            <div>
                <h3 class="text-2xl font-bold text-secondary-600 mb-10 text-center">企業の場合</h3>
                <div class="grid md:grid-cols-4 gap-8">
                    <!-- Step 1 -->
                    <div class="text-center animate-on-scroll">
                        <div class="flex items-center justify-center w-20 h-20 bg-secondary-100 rounded-full mx-auto mb-6 relative">
                            <span class="text-3xl font-bold text-secondary-600">1</span>
                            <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-secondary-200"></div>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">会員登録</h4>
                        <p class="text-gray-600 leading-relaxed">
                            企業情報とサービス内容を入力<br>
                            （企業名、事業概要、提供サービスなど）
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center animate-on-scroll">
                        <div class="flex items-center justify-center w-20 h-20 bg-secondary-100 rounded-full mx-auto mb-6 relative">
                            <span class="text-3xl font-bold text-secondary-600">2</span>
                            <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-secondary-200"></div>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">管理者承認</h4>
                        <p class="text-gray-600 leading-relaxed">
                            アイハーツによる審査・承認<br>
                            （通常1〜2営業日）
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center animate-on-scroll">
                        <div class="flex items-center justify-center w-20 h-20 bg-secondary-100 rounded-full mx-auto mb-6 relative">
                            <span class="text-3xl font-bold text-secondary-600">3</span>
                            <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-secondary-200"></div>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">サービス掲載</h4>
                        <p class="text-gray-600 leading-relaxed">
                            自社サービス・技術事例を登録<br>
                            カテゴリ別に公開
                        </p>
                    </div>

                    <!-- Step 4 -->
                    <div class="text-center animate-on-scroll">
                        <div class="flex items-center justify-center w-20 h-20 bg-secondary-100 rounded-full mx-auto mb-6">
                            <span class="text-3xl font-bold text-secondary-600">4</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">オファー受信・商談</h4>
                        <p class="text-gray-600 leading-relaxed">
                            自治体からオファーを受信<br>
                            アイハーツが商談を調整
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 md:py-32 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">よくあるご質問</h2>
            </div>

            <div class="space-y-4" x-data="{ openFaq: null }">
                <!-- FAQ 1 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden animate-on-scroll">
                    <button @click="openFaq = openFaq === 1 ? null : 1" class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">
                        <span class="text-lg font-semibold text-gray-900">登録は無料ですか?</span>
                        <svg class="w-6 h-6 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': openFaq === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 1" x-cloak x-transition class="px-6 pb-5">
                        <p class="text-gray-600 leading-relaxed">
                            はい、完全無料でご利用いただけます。会員登録、プロフィール掲載、オファー送信・受信、すべて無料です。
                        </p>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden animate-on-scroll">
                    <button @click="openFaq = openFaq === 2 ? null : 2" class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">
                        <span class="text-lg font-semibold text-gray-900">どのような自治体・企業が登録できますか?</span>
                        <svg class="w-6 h-6 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': openFaq === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 2" x-cloak x-transition class="px-6 pb-5">
                        <p class="text-gray-600 leading-relaxed">
                            全国の自治体（首長およびその代理者）、自治体との取引を希望する民間企業が登録可能です。アイハーツによる審査がございます。
                        </p>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden animate-on-scroll">
                    <button @click="openFaq = openFaq === 3 ? null : 3" class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">
                        <span class="text-lg font-semibold text-gray-900">マッチング後のサポートはありますか?</span>
                        <svg class="w-6 h-6 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': openFaq === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 3" x-cloak x-transition class="px-6 pb-5">
                        <p class="text-gray-600 leading-relaxed">
                            はい、アイハーツが仲介役として商談調整、オンライン面談の設定、契約支援（オプション）までサポートいたします。
                        </p>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden animate-on-scroll">
                    <button @click="openFaq = openFaq === 4 ? null : 4" class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">
                        <span class="text-lg font-semibold text-gray-900">オファーを送ったら必ず商談できますか?</span>
                        <svg class="w-6 h-6 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': openFaq === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 4" x-cloak x-transition class="px-6 pb-5">
                        <p class="text-gray-600 leading-relaxed">
                            オファー送信後、アイハーツが両者に連絡し、双方の意向を確認した上で商談を調整いたします。必ずしも商談が実現するとは限りませんが、マッチング精度を高めるサポートをいたします。
                        </p>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden animate-on-scroll">
                    <button @click="openFaq = openFaq === 5 ? null : 5" class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">
                        <span class="text-lg font-semibold text-gray-900">プライバシーは保護されますか?</span>
                        <svg class="w-6 h-6 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': openFaq === 5 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 5" x-cloak x-transition class="px-6 pb-5">
                        <p class="text-gray-600 leading-relaxed">
                            はい、個人情報は厳重に管理しております。SSL通信による暗号化、アクセス制限など、セキュリティ対策を実施しております。
                        </p>
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden animate-on-scroll">
                    <button @click="openFaq = openFaq === 6 ? null : 6" class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">
                        <span class="text-lg font-semibold text-gray-900">企業サービスの掲載基準はありますか?</span>
                        <svg class="w-6 h-6 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': openFaq === 6 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="openFaq === 6" x-cloak x-transition class="px-6 pb-5">
                        <p class="text-gray-600 leading-relaxed">
                            自治体向けのサービス・技術であること、実績や信頼性があることを基準に審査いたします。詳細はお問い合わせください。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="py-20 md:py-32 bg-gradient-to-br from-primary-600 to-secondary-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-on-scroll">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">今すぐ始めませんか?</h2>
            <p class="text-lg md:text-xl mb-10 opacity-90 leading-relaxed">
                地域課題の解決、新しいビジネスチャンス創出に向けて、<br class="hidden md:block">
                ふるさとコネクトで第一歩を踏み出しましょう。
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('register') }}?role=municipality" class="w-full sm:w-auto bg-white text-primary-600 hover:bg-gray-100 px-10 py-4 rounded-lg font-semibold text-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                    首長として登録する
                </a>
                <a href="{{ route('register') }}?role=company" class="w-full sm:w-auto bg-white text-secondary-600 hover:bg-gray-100 px-10 py-4 rounded-lg font-semibold text-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                    企業として登録する
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <!-- Company Info -->
                <div class="md:col-span-2">
                    <h3 class="text-2xl font-bold text-white mb-4">ふるさとコネクト</h3>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        自治体と企業のマッチングプラットフォーム。<br>
                        地域課題の解決をサポートします。
                    </p>
                    <div class="text-sm text-gray-400">
                        <p class="font-semibold text-white mb-2">運営: アイハーツ株式会社</p>
                        <p>お問い合わせ: <a href="mailto:info@ihearts.co.jp" class="text-primary-400 hover:text-primary-300 transition-colors duration-200">info@i-hearts.co.jp</a></p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4">メニュー</h4>
                    <ul class="space-y-2">
                        <li><a href="#overview" class="text-gray-400 hover:text-white transition-colors duration-200">サービス概要</a></li>
                        <li><a href="#municipality" class="text-gray-400 hover:text-white transition-colors duration-200">首長マッチング</a></li>
                        <li><a href="#company" class="text-gray-400 hover:text-white transition-colors duration-200">企業マッチング</a></li>
                        <li><a href="#flow" class="text-gray-400 hover:text-white transition-colors duration-200">利用の流れ</a></li>
                    </ul>
                </div>

                <!-- Legal Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4">法的情報</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('terms') }}" class="text-gray-400 hover:text-white transition-colors duration-200">利用規約</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-gray-400 hover:text-white transition-colors duration-200">プライバシーポリシー</a></li>
                        <li><a href="mailto:info@ihearts.co.jp" class="text-gray-400 hover:text-white transition-colors duration-200">お問い合わせ</a></li>
                    </ul>
                </div>
            </div>

            <!-- Social Links & Copyright -->
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2025 i-hearts, Inc. All Rights Reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200" aria-label="Twitter">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200" aria-label="Facebook">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200" aria-label="LinkedIn">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button
        x-data="{ show: false }"
        @scroll.window="show = window.pageYOffset > 300"
        x-show="show"
        x-cloak
        x-transition
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-8 right-8 bg-primary-600 hover:bg-primary-700 text-white p-3 rounded-full shadow-lg transition-all duration-200 transform hover:scale-110 z-40"
        aria-label="トップに戻る"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>
</x-layouts.landing>
