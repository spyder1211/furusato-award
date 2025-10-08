<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            首長プロフィール詳細
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

            <!-- プロフィール情報 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $profile->user->name }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- 基本情報 -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-3">基本情報</h4>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">都道府県・市区町村</dt>
                                    <dd class="text-base text-gray-900">{{ $profile->prefecture }} {{ $profile->city }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">人口</dt>
                                    <dd class="text-base text-gray-900">{{ number_format($profile->population, 1) }}万人</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">当選回数</dt>
                                    <dd class="text-base text-gray-900">{{ $profile->election_count }}回</dd>
                                </div>
                                @if($profile->birthplace)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">出身地</dt>
                                        <dd class="text-base text-gray-900">{{ $profile->birthplace }}</dd>
                                    </div>
                                @endif
                                @if($profile->university)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">出身大学</dt>
                                        <dd class="text-base text-gray-900">{{ $profile->university }}</dd>
                                    </div>
                                @endif
                                @if($profile->furusato_tax_amount)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">ふるさと納税金額</dt>
                                        <dd class="text-base text-gray-900">{{ number_format($profile->furusato_tax_amount) }}円</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        <!-- 特色・信条 -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-3">地域の特色</h4>
                            @if($profile->characteristics)
                                <p class="text-gray-700 whitespace-pre-wrap">{{ $profile->characteristics }}</p>
                            @else
                                <p class="text-gray-400">記載なし</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-6">
                        <!-- 信条 -->
                        @if($profile->philosophy)
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-3">信条</h4>
                                <p class="text-gray-700 whitespace-pre-wrap">{{ $profile->philosophy }}</p>
                            </div>
                        @endif

                        <!-- 得意分野 -->
                        @if($profile->expertise)
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-3">得意分野</h4>
                                <p class="text-gray-700 whitespace-pre-wrap">{{ $profile->expertise }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- オファー送信フォーム（首長アカウントのみ、自分自身以外） -->
            @if(Auth::user()->role === 'municipality' && Auth::id() !== $profile->user_id)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">オファーを送る</h4>

                        @if($alreadyOffered)
                            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">この首長にはすでにオファーを送信済みです</span>
                            </div>
                        @else
                            <form method="POST" action="{{ route('municipalities.offers.store') }}">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $profile->user_id }}">

                                <div class="mb-4">
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                        メッセージ（任意）
                                    </label>
                                    <textarea name="message" id="message" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="連携したい内容や理由を記載してください（最大1000文字）">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                @error('receiver_id')
                                    <p class="mb-4 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                <div class="flex gap-3">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        オファーを送信
                                    </button>
                                    <a href="{{ route('municipalities.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
                    <a href="{{ route('municipalities.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        一覧に戻る
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
