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
                    <form method="POST" action="{{ route('companies.services.store') }}" enctype="multipart/form-data">
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
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                カテゴリ <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="category_id"
                                name="category_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category_id') border-red-500 @enderror"
                                required
                            >
                                <option value="">選択してください</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- サービス画像 -->
                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                サービス画像（任意）
                            </label>
                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/jpeg,image/jpg,image/png,image/webp"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror"
                                onchange="previewImage(event)"
                            >
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">JPEG、PNG、WEBP形式、最大2MB</p>

                            <!-- 画像プレビュー -->
                            <div id="image-preview" class="mt-4 hidden">
                                <img id="preview" class="max-w-md rounded-lg border border-gray-300" alt="プレビュー">
                            </div>
                        </div>

                        <!-- サービス・技術の詳細 -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                サービス・技術の詳細 <span class="text-red-500">*</span>
                            </label>
                            <x-tiptap-editor
                                name="description"
                                :value="old('description')"
                                :required="true"
                                placeholder="サービスや技術の内容を詳しく説明してください"
                            />
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">最大3000文字</p>
                        </div>

                        <!-- 導入実績・事例 -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                導入実績・事例（任意）
                            </label>
                            <x-tiptap-editor
                                name="case_studies"
                                :value="old('case_studies')"
                                placeholder="これまでの導入実績や事例があれば記載してください"
                            />
                            @error('case_studies')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">最大2000文字</p>
                        </div>

                        <!-- 自社の強み -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                自社の強み（任意）
                            </label>
                            <x-tiptap-editor
                                name="strengths"
                                :value="old('strengths')"
                                placeholder="このサービス・技術に関する自社の強みを記載してください"
                            />
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

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('image-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>
