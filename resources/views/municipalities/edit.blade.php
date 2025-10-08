<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            マイページ - プロフィール編集
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('municipalities.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- 基本情報 -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">基本情報</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- 都道府県 -->
                                <div>
                                    <label for="prefecture" class="block text-sm font-medium text-gray-700">都道府県 <span class="text-red-500">*</span></label>
                                    <input type="text" name="prefecture" id="prefecture" value="{{ old('prefecture', $profile->prefecture) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('prefecture')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- 市区町村名 -->
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700">市区町村名 <span class="text-red-500">*</span></label>
                                    <input type="text" name="city" id="city" value="{{ old('city', $profile->city) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('city')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- 人口 -->
                                <div>
                                    <label for="population" class="block text-sm font-medium text-gray-700">人口（万人） <span class="text-red-500">*</span></label>
                                    <input type="number" name="population" id="population" value="{{ old('population', $profile->population) }}" step="0.1" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('population')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- 当選回数 -->
                                <div>
                                    <label for="election_count" class="block text-sm font-medium text-gray-700">当選回数 <span class="text-red-500">*</span></label>
                                    <input type="number" name="election_count" id="election_count" value="{{ old('election_count', $profile->election_count) }}" min="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('election_count')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- 出身地 -->
                                <div>
                                    <label for="birthplace" class="block text-sm font-medium text-gray-700">出身地</label>
                                    <input type="text" name="birthplace" id="birthplace" value="{{ old('birthplace', $profile->birthplace) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('birthplace')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- 出身大学 -->
                                <div>
                                    <label for="university" class="block text-sm font-medium text-gray-700">出身大学</label>
                                    <input type="text" name="university" id="university" value="{{ old('university', $profile->university) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('university')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- ふるさと納税金額 -->
                                <div class="md:col-span-2">
                                    <label for="furusato_tax_amount" class="block text-sm font-medium text-gray-700">ふるさと納税金額（円） <span class="text-red-500">*</span></label>
                                    <input type="number" name="furusato_tax_amount" id="furusato_tax_amount" value="{{ old('furusato_tax_amount', $profile->furusato_tax_amount) }}" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('furusato_tax_amount')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- 詳細情報 -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">詳細情報</h3>
                            <div class="space-y-4">
                                <!-- 地域の特色 -->
                                <div>
                                    <label for="characteristics" class="block text-sm font-medium text-gray-700">地域の特色</label>
                                    <textarea name="characteristics" id="characteristics" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="地域の特色や魅力を記載してください">{{ old('characteristics', $profile->characteristics) }}</textarea>
                                    @error('characteristics')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- 信条 -->
                                <div>
                                    <label for="philosophy" class="block text-sm font-medium text-gray-700">信条</label>
                                    <textarea name="philosophy" id="philosophy" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="あなたの信条や大切にしていることを記載してください">{{ old('philosophy', $profile->philosophy) }}</textarea>
                                    @error('philosophy')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- 得意分野 -->
                                <div>
                                    <label for="expertise" class="block text-sm font-medium text-gray-700">得意分野</label>
                                    <textarea name="expertise" id="expertise" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="例: 観光振興、子育て支援、DX推進など">{{ old('expertise', $profile->expertise) }}</textarea>
                                    @error('expertise')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- 送信ボタン -->
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                キャンセル
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                保存する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
