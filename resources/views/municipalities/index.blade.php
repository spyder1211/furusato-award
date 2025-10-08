<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            首長プロフィール一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- フィルターフォーム -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">絞り込み検索</h3>
                    <form method="GET" action="{{ route('municipalities.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- 都道府県フィルター -->
                            <div>
                                <label for="prefecture" class="block text-sm font-medium text-gray-700">都道府県</label>
                                <select name="prefecture" id="prefecture" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">すべて</option>
                                    @foreach($prefectures as $prefecture)
                                        <option value="{{ $prefecture }}" {{ request('prefecture') == $prefecture ? 'selected' : '' }}>
                                            {{ $prefecture }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- 人口規模フィルター（最小） -->
                            <div>
                                <label for="population_min" class="block text-sm font-medium text-gray-700">人口（最小・万人）</label>
                                <input type="number" name="population_min" id="population_min" value="{{ request('population_min') }}" step="0.1" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- 人口規模フィルター（最大） -->
                            <div>
                                <label for="population_max" class="block text-sm font-medium text-gray-700">人口（最大・万人）</label>
                                <input type="number" name="population_max" id="population_max" value="{{ request('population_max') }}" step="0.1" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- 得意分野フィルター -->
                            <div>
                                <label for="expertise" class="block text-sm font-medium text-gray-700">得意分野</label>
                                <input type="text" name="expertise" id="expertise" value="{{ request('expertise') }}" placeholder="例: 観光" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                検索
                            </button>
                            <a href="{{ route('municipalities.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                リセット
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- プロフィール一覧 -->
            @if($profiles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($profiles as $profile)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ $profile->user->name }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    {{ $profile->prefecture }} {{ $profile->city }}
                                </p>

                                <div class="space-y-2 text-sm text-gray-700 mb-4">
                                    <p><span class="font-semibold">人口:</span> {{ number_format($profile->population, 1) }}万人</p>
                                    <p><span class="font-semibold">得意分野:</span> {{ Str::limit($profile->expertise, 50) }}</p>
                                    @if($profile->furusato_tax_amount)
                                        <p><span class="font-semibold">ふるさと納税:</span> {{ number_format($profile->furusato_tax_amount) }}円</p>
                                    @endif
                                </div>

                                @if($profile->characteristics)
                                    <p class="text-sm text-gray-600 mb-4">
                                        {{ Str::limit($profile->characteristics, 100) }}
                                    </p>
                                @endif

                                <div class="flex justify-end">
                                    <a href="{{ route('municipalities.show', $profile->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        詳細を見る
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- ページネーション -->
                <div class="mt-6">
                    {{ $profiles->links() }}
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-500">
                        該当するプロフィールが見つかりませんでした
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
