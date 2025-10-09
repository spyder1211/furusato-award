<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            オファー管理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- タブナビゲーション -->
            <div class="mb-6">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <a href="{{ route('municipalities.offers.received') }}" class="border-indigo-500 text-indigo-600 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                            首長から受信
                        </a>
                        <a href="{{ route('municipalities.offers.sent') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                            首長へ送信
                        </a>
                        <a href="{{ route('companies.offers.sent') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                            企業へ送信
                        </a>
                    </nav>
                </div>
            </div>

            <!-- オファー一覧 -->
            @if($offers->count() > 0)
                <div class="space-y-4">
                    @foreach($offers as $offer)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            {{ $offer->sender->name }}
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            @if($offer->sender->municipalityProfile)
                                                {{ $offer->sender->municipalityProfile->prefecture }}
                                                {{ $offer->sender->municipalityProfile->city }}
                                            @endif
                                        </p>
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
                                        <h4 class="text-sm font-semibold text-gray-700 mb-2">メッセージ</h4>
                                        <p class="text-gray-700 whitespace-pre-wrap bg-gray-50 p-3 rounded">{{ $offer->message }}</p>
                                    </div>
                                @endif

                                <div class="flex justify-end">
                                    <a href="{{ route('municipalities.show', $offer->sender->municipalityProfile->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        プロフィールを見る
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
                        まだオファーを受信していません
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
