<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            サービス・技術新規投稿
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('companies.services.store') }}">
                        @csrf

                        <!-- タイトル -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                タイトル <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                                placeholder="例: 観光地向けAI多言語案内システム"
                                required
                            >
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- カテゴリ -->
                        <div class="mb-6">
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                カテゴリ <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="category"
                                name="category"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category') border-red-500 @enderror"
                                required
                            >
                                <option value="">選択してください</option>
                                <option value="観光振興" {{ old('category') === '観光振興' ? 'selected' : '' }}>観光振興</option>
                                <option value="子育て支援" {{ old('category') === '子育て支援' ? 'selected' : '' }}>子育て支援</option>
                                <option value="DX推進" {{ old('category') === 'DX推進' ? 'selected' : '' }}>DX推進</option>
                                <option value="インフラ整備" {{ old('category') === 'インフラ整備' ? 'selected' : '' }}>インフラ整備</option>
                                <option value="地域活性化" {{ old('category') === '地域活性化' ? 'selected' : '' }}>地域活性化</option>
                                <option value="環境・エネルギー" {{ old('category') === '環境・エネルギー' ? 'selected' : '' }}>環境・エネルギー</option>
                                <option value="その他" {{ old('category') === 'その他' ? 'selected' : '' }}>その他</option>
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- サービス・技術の詳細 -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                サービス・技術の詳細 <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                rows="8"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                                placeholder="サービスや技術の内容を詳しく説明してください"
                                required
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">最大3000文字</p>
                        </div>

                        <!-- 導入実績・事例 -->
                        <div class="mb-6">
                            <label for="case_studies" class="block text-sm font-medium text-gray-700 mb-2">
                                導入実績・事例（任意）
                            </label>
                            <textarea
                                id="case_studies"
                                name="case_studies"
                                rows="6"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('case_studies') border-red-500 @enderror"
                                placeholder="これまでの導入実績や事例があれば記載してください"
                            >{{ old('case_studies') }}</textarea>
                            @error('case_studies')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">最大2000文字</p>
                        </div>

                        <!-- 自社の強み -->
                        <div class="mb-6">
                            <label for="strengths" class="block text-sm font-medium text-gray-700 mb-2">
                                自社の強み（任意）
                            </label>
                            <textarea
                                id="strengths"
                                name="strengths"
                                rows="6"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('strengths') border-red-500 @enderror"
                                placeholder="このサービス・技術に関する自社の強みを記載してください"
                            >{{ old('strengths') }}</textarea>
                            @error('strengths')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">最大2000文字</p>
                        </div>

                        <!-- 公開ステータス -->
                        <div class="mb-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                公開ステータス <span class="text-red-500">*</span>
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="status" value="published" {{ old('status', 'published') === 'published' ? 'checked' : '' }} class="mr-2">
                                    <span>公開（すぐに自治体が閲覧可能になります）</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="status" value="draft" {{ old('status') === 'draft' ? 'checked' : '' }} class="mr-2">
                                    <span>下書き（自分のみ閲覧可能）</span>
                                </label>
                            </div>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ボタン -->
                        <div class="flex items-center justify-between">
                            <a href="{{ route('companies.services.index') }}" class="text-gray-600 hover:text-gray-900">
                                ← 一覧に戻る
                            </a>
                            <button
                                type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition"
                            >
                                投稿する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
