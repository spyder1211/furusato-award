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
                                <label for="category_id" class="block text-sm font-medium text-gray-700">カテゴリ</label>
                                <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">すべて</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
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
                            <!-- サービス画像 -->
                            @if($service->image_path)
                                <div class="aspect-video w-full overflow-hidden bg-gray-100">
                                    <img src="{{ asset('storage/' . $service->image_path) }}"
                                         alt="{{ $service->title }}"
                                         class="w-full h-full object-cover">
                                </div>
                            @else
                                <!-- 画像がない場合のプレースホルダー -->
                                <div class="aspect-video w-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif

                            <div class="p-6">
                                <!-- カテゴリバッジ -->
                                <div class="mb-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        @if($service->category->name === '観光振興') bg-blue-100 text-blue-800
                                        @elseif($service->category->name === '子育て支援') bg-pink-100 text-pink-800
                                        @elseif($service->category->name === 'DX推進') bg-purple-100 text-purple-800
                                        @elseif($service->category->name === 'インフラ整備') bg-yellow-100 text-yellow-800
                                        @elseif($service->category->name === '地域活性化') bg-green-100 text-green-800
                                        @elseif($service->category->name === '環境・エネルギー') bg-teal-100 text-teal-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $service->category->name }}
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
                                <p class="text-sm text-gray-700 mb-4 line-clamp-3">
                                    {{ Str::limit(strip_tags($service->description), 120) }}
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
