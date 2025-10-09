<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            企業サービス一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- フィルターフォーム -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">カテゴリで絞り込み</h3>
                    <form method="GET" action="{{ route('services.public.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- カテゴリフィルター -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">カテゴリ</label>
                                <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">すべて</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                検索
                            </button>
                            <a href="{{ route('services.public.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                リセット
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- サービス一覧 -->
            @if($services->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($services as $service)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200">
                            <div class="p-6">
                                <!-- カテゴリバッジ -->
                                <div class="mb-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
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
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ $service->title }}
                                </h3>

                                <!-- 企業名 -->
                                <p class="text-sm text-gray-600 mb-3">
                                    {{ $service->user->companyProfile->company_name ?? $service->user->name }}
                                </p>

                                <!-- 説明（抜粋） -->
                                <p class="text-sm text-gray-700 mb-4">
                                    {{ Str::limit($service->description, 120) }}
                                </p>

                                <!-- 詳細ボタン -->
                                <div class="flex justify-end">
                                    <a href="{{ route('services.show', $service->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        詳細を見る
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- ページネーション -->
                <div class="mt-6">
                    {{ $services->links() }}
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-500">
                        該当するサービスが見つかりませんでした
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
