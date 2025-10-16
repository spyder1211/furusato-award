<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                サービス・技術投稿管理
            </h2>
            <a href="{{ route('companies.services.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                新規投稿
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($services->count() > 0)
                        <div class="space-y-6">
                            @foreach($services as $service)
                                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-3 mb-2">
                                                <span class="px-3 py-1 text-sm rounded-full
                                                    @if($service->category->name === '観光振興') bg-blue-100 text-blue-800
                                                    @elseif($service->category->name === '子育て支援') bg-pink-100 text-pink-800
                                                    @elseif($service->category->name === 'DX推進') bg-purple-100 text-purple-800
                                                    @elseif($service->category->name === 'インフラ整備') bg-gray-100 text-gray-800
                                                    @elseif($service->category->name === '地域活性化') bg-green-100 text-green-800
                                                    @elseif($service->category->name === '環境・エネルギー') bg-teal-100 text-teal-800
                                                    @else bg-yellow-100 text-yellow-800
                                                    @endif">
                                                    {{ $service->category->name }}
                                                </span>
                                                <span class="px-3 py-1 text-sm rounded-full
                                                    @if($service->status === 'published') bg-green-100 text-green-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ $service->status === 'published' ? '公開中' : '下書き' }}
                                                </span>
                                            </div>

                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                                {{ $service->title }}
                                            </h3>

                                            <p class="text-gray-600 text-sm mb-4">
                                                {{ Str::limit($service->description, 200) }}
                                            </p>

                                            <p class="text-xs text-gray-500">
                                                投稿日: {{ $service->created_at->format('Y年m月d日') }}
                                            </p>
                                        </div>

                                        <div class="ml-4 flex flex-col space-y-2">
                                            <a href="{{ route('services.show', $service->id) }}"
                                               class="text-green-600 hover:text-green-900 text-sm">
                                                詳細
                                            </a>
                                            <a href="{{ route('companies.services.edit', $service->id) }}"
                                               class="text-blue-600 hover:text-blue-900 text-sm">
                                                編集
                                            </a>
                                            <form method="POST" action="{{ route('companies.services.destroy', $service->id) }}"
                                                  onsubmit="return confirm('本当に削除しますか？');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm">
                                                    削除
                                                </button>
                                            </form>
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
                        <div class="text-center py-12">
                            <p class="text-gray-500 mb-4">まだサービスが投稿されていません</p>
                            <a href="{{ route('companies.services.create') }}" class="text-blue-600 hover:text-blue-900">
                                最初のサービスを投稿する →
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
