<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl md:text-3xl text-gray-900">
            ダッシュボード
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="bg-gradient-to-br from-primary-600 to-secondary-600 rounded-xl shadow-lg p-8 mb-8 text-white">
                <h3 class="text-2xl md:text-3xl font-bold mb-2">ようこそ、{{ Auth::user()->name }}さん！</h3>
                <p class="text-primary-100 text-lg">
                    @if(Auth::user()->role === 'municipality')
                        首長マッチングと企業サービスをご活用ください。
                    @elseif(Auth::user()->role === 'company')
                        自社サービスの掲載と自治体からのオファーをご確認ください。
                    @else
                        管理者として全機能をご利用いただけます。
                    @endif
                </p>
            </div>

            @if(Auth::user()->role === 'municipality')
                <!-- Municipality Dashboard -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- 首長マッチング -->
                    <a href="{{ route('municipalities.index') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 group">
                        <div class="flex items-center justify-center w-16 h-16 bg-primary-100 rounded-lg mb-4 group-hover:bg-primary-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">首長マッチング</h3>
                        <p class="text-gray-600 text-sm">他の自治体と繋がり、連携を促進</p>
                    </a>

                    <!-- 企業サービス -->
                    <a href="{{ route('services.public.index') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 group">
                        <div class="flex items-center justify-center w-16 h-16 bg-secondary-100 rounded-lg mb-4 group-hover:bg-secondary-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">企業サービス</h3>
                        <p class="text-gray-600 text-sm">企業が提供するサービスを検索</p>
                    </a>

                    <!-- マイページ -->
                    <a href="{{ route('municipalities.edit') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 group">
                        <div class="flex items-center justify-center w-16 h-16 bg-blue-100 rounded-lg mb-4 group-hover:bg-blue-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">マイページ</h3>
                        <p class="text-gray-600 text-sm">プロフィール情報を編集</p>
                    </a>

                    <!-- オファー管理 -->
                    <a href="{{ route('municipalities.offers.received') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 group">
                        <div class="flex items-center justify-center w-16 h-16 bg-purple-100 rounded-lg mb-4 group-hover:bg-purple-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">オファー管理</h3>
                        <p class="text-gray-600 text-sm">受信・送信したオファーを確認</p>
                    </a>
                </div>

            @elseif(Auth::user()->role === 'company')
                <!-- Company Dashboard -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- サービス管理 -->
                    <a href="{{ route('companies.services.index') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 group">
                        <div class="flex items-center justify-center w-16 h-16 bg-secondary-100 rounded-lg mb-4 group-hover:bg-secondary-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">サービス管理</h3>
                        <p class="text-gray-600 text-sm">自社サービス・技術事例を管理</p>
                    </a>

                    <!-- 企業サービス -->
                    <a href="{{ route('services.public.index') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 group">
                        <div class="flex items-center justify-center w-16 h-16 bg-blue-100 rounded-lg mb-4 group-hover:bg-blue-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">企業サービス一覧</h3>
                        <p class="text-gray-600 text-sm">他社のサービスを閲覧</p>
                    </a>

                    <!-- マイページ -->
                    <a href="{{ route('companies.profile.edit') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 group">
                        <div class="flex items-center justify-center w-16 h-16 bg-primary-100 rounded-lg mb-4 group-hover:bg-primary-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">マイページ</h3>
                        <p class="text-gray-600 text-sm">企業プロフィールを編集</p>
                    </a>

                    <!-- オファー受信 -->
                    <a href="{{ route('companies.offers.received') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 group">
                        <div class="flex items-center justify-center w-16 h-16 bg-purple-100 rounded-lg mb-4 group-hover:bg-purple-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">オファー受信</h3>
                        <p class="text-gray-600 text-sm">自治体からのオファーを確認</p>
                    </a>
                </div>

            @else
                <!-- Admin Dashboard -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- 管理画面 -->
                    <a href="/admin" class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 group">
                        <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-lg mb-4 group-hover:bg-red-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">管理画面</h3>
                        <p class="text-gray-600 text-sm">Filament管理パネルにアクセス</p>
                    </a>
                </div>
            @endif

            <!-- Info Card -->
            <div class="mt-8 bg-white rounded-xl shadow-md p-6">
                <h4 class="text-lg font-bold text-gray-900 mb-4">ご利用ガイド</h4>
                <div class="space-y-3 text-gray-700">
                    @if(Auth::user()->role === 'municipality')
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-primary-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>首長マッチングで他の自治体とつながり、先進事例を共有できます。</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-primary-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>企業サービスから地域課題の解決につながるサービスを探せます。</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-primary-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>オファー送信後、アイハーツが仲介して商談を調整します。</span>
                        </div>
                    @elseif(Auth::user()->role === 'company')
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-secondary-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>自社のサービス・技術事例を登録して、全国の自治体にアピールできます。</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-secondary-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>自治体からオファーを受け取ると、アイハーツが商談を調整します。</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-secondary-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>導入実績や事例を充実させることで、マッチング率が向上します。</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
