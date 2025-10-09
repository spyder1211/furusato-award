<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            企業サービス詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- 成功メッセージ -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- サービス情報 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <!-- カテゴリバッジ -->
                    <div class="mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($service->category === '観光振興') bg-blue-100 text-blue-800
                            @elseif($service->category === '子育て支援') bg-pink-100 text-pink-800
                            @elseif($service->category === 'DX推進') bg-purple-100 text-purple-800
                            @elseif($service->category === 'インフラ整備') bg-yellow-100 text-yellow-800
                            @elseif($service->category === '地域活性化') bg-green-100 text-green-800
                            @elseif($service->category === '環境・エネルギー') bg-teal-100 text-teal-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $service->category }}
                        </span>
                    </div>

                    <!-- タイトル -->
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $service->title }}</h3>

                    <!-- 企業情報 -->
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800 mb-3">提供企業</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">企業名</dt>
                                <dd class="text-base text-gray-900">{{ $service->user->companyProfile->company_name ?? $service->user->name }}</dd>
                            </div>
                            @if($service->user->companyProfile && $service->user->companyProfile->description)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">事業概要</dt>
                                    <dd class="text-base text-gray-900">{{ Str::limit($service->user->companyProfile->description, 100) }}</dd>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- サービス・技術の詳細 -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-3">サービス・技術の詳細</h4>
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $service->description }}</p>
                    </div>

                    <!-- 導入実績・事例 -->
                    @if($service->case_studies)
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-3">導入実績・事例</h4>
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $service->case_studies }}</p>
                        </div>
                    @endif

                    <!-- 自社の強み -->
                    @if($service->strengths)
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-3">自社の強み</h4>
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $service->strengths }}</p>
                        </div>
                    @endif

                    <!-- 投稿日時 -->
                    <div class="text-sm text-gray-500 mt-6">
                        投稿日: {{ $service->created_at->format('Y年m月d日') }}
                    </div>
                </div>
            </div>

            <!-- オファー送信フォーム（自治体アカウントのみ） -->
            @if(Auth::user()->role === 'municipality')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">このサービスにオファーを送る</h4>

                        @if($alreadyOffered)
                            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">このサービスにはすでにオファーを送信済みです</span>
                            </div>
                        @else
                            <form method="POST" action="{{ route('companies.offers.store') }}">
                                @csrf
                                <input type="hidden" name="service_id" value="{{ $service->id }}">

                                <div class="mb-4">
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                        メッセージ（任意）
                                    </label>
                                    <textarea name="message" id="message" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="相談したい内容や背景を記載してください（最大1000文字）">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                @error('service_id')
                                    <p class="mb-4 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                <div class="flex gap-3">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        オファーを送信
                                    </button>
                                    <a href="{{ route('services.public.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        一覧に戻る
                                    </a>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            @else
                <!-- 一覧に戻るボタン -->
                <div class="flex justify-center">
                    <a href="{{ route('services.public.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        一覧に戻る
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
