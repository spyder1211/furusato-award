<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            送信したオファー（企業向け）
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- オファー一覧 -->
            @if($offers->count() > 0)
                <div class="space-y-4">
                    @foreach($offers as $offer)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                            {{ $offer->companyService->title }}
                                        </h3>
                                        <p class="text-sm text-gray-600 mb-2">
                                            <span class="font-semibold">企業名:</span>
                                            {{ $offer->companyService->user->companyProfile->company_name ?? $offer->companyService->user->name }}
                                        </p>
                                        <!-- カテゴリバッジ -->
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                            @if($offer->companyService->category === '観光振興') bg-blue-100 text-blue-800
                                            @elseif($offer->companyService->category === '子育て支援') bg-pink-100 text-pink-800
                                            @elseif($offer->companyService->category === 'DX推進') bg-purple-100 text-purple-800
                                            @elseif($offer->companyService->category === 'インフラ整備') bg-yellow-100 text-yellow-800
                                            @elseif($offer->companyService->category === '地域活性化') bg-green-100 text-green-800
                                            @elseif($offer->companyService->category === '環境・エネルギー') bg-teal-100 text-teal-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ $offer->companyService->category }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <!-- ステータスバッジ -->
                                        @if($offer->status === 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                新規
                                            </span>
                                        @elseif($offer->status === 'contacted')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                対応中
                                            </span>
                                        @elseif($offer->status === 'completed')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                完了
                                            </span>
                                        @endif

                                        <span class="text-sm text-gray-500">
                                            {{ $offer->created_at->format('Y/m/d H:i') }}
                                        </span>
                                    </div>
                                </div>

                                @if($offer->message)
                                    <div class="mb-4">
                                        <h4 class="text-sm font-semibold text-gray-700 mb-2">送信したメッセージ</h4>
                                        <p class="text-gray-700 whitespace-pre-wrap bg-gray-50 p-3 rounded">{{ $offer->message }}</p>
                                    </div>
                                @endif

                                <div class="flex justify-end">
                                    <a href="{{ route('services.show', $offer->companyService->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        サービス詳細を見る
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- ページネーション -->
                <div class="mt-6">
                    {{ $offers->links() }}
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-500">
                        まだ企業にオファーを送信していません
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
