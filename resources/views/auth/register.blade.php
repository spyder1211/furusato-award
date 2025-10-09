<x-guest-layout>
    <!-- Page Title -->
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 text-center mb-2">新規登録</h2>
        <p class="text-sm text-gray-600 text-center">アカウントを作成して、マッチング機能をご利用ください</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Role Selection -->
        <div>
            <x-input-label for="role" value="登録区分" class="text-gray-700 font-semibold mb-3" />
            <div class="grid grid-cols-2 gap-3">
                <label for="role_municipality"
                       class="relative flex items-center justify-center p-4 border-2 rounded-lg cursor-pointer transition-all duration-200 {{ old('role') === 'municipality' ? 'border-primary-600 bg-primary-50' : 'border-gray-300 hover:border-primary-300' }}">
                    <input id="role_municipality"
                           type="radio"
                           name="role"
                           value="municipality"
                           class="sr-only"
                           {{ old('role') === 'municipality' ? 'checked' : '' }}
                           required>
                    <div class="text-center">
                        <svg class="w-8 h-8 mx-auto mb-2 {{ old('role') === 'municipality' ? 'text-primary-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="text-sm font-semibold {{ old('role') === 'municipality' ? 'text-primary-600' : 'text-gray-700' }}">首長（自治体）</span>
                    </div>
                </label>

                <label for="role_company"
                       class="relative flex items-center justify-center p-4 border-2 rounded-lg cursor-pointer transition-all duration-200 {{ old('role') === 'company' ? 'border-secondary-600 bg-secondary-50' : 'border-gray-300 hover:border-secondary-300' }}">
                    <input id="role_company"
                           type="radio"
                           name="role"
                           value="company"
                           class="sr-only"
                           {{ old('role') === 'company' ? 'checked' : '' }}
                           required>
                    <div class="text-center">
                        <svg class="w-8 h-8 mx-auto mb-2 {{ old('role') === 'company' ? 'text-secondary-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm font-semibold {{ old('role') === 'company' ? 'text-secondary-600' : 'text-gray-700' }}">企業</span>
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" value="お名前（担当者名）" class="text-gray-700 font-semibold" />
            <x-text-input id="name"
                          class="block w-full"
                          type="text"
                          name="name"
                          :value="old('name')"
                          required
                          autofocus
                          autocomplete="name"
                          placeholder="山田 太郎" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="メールアドレス" class="text-gray-700 font-semibold" />
            <x-text-input id="email"
                          class="block w-full"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required
                          autocomplete="username"
                          placeholder="example@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" value="電話番号" class="text-gray-700 font-semibold" />
            <x-text-input id="phone"
                          class="block w-full"
                          type="tel"
                          name="phone"
                          :value="old('phone')"
                          required
                          autocomplete="tel"
                          placeholder="03-1234-5678" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="パスワード" class="text-gray-700 font-semibold" />
            <x-text-input id="password"
                          class="block w-full"
                          type="password"
                          name="password"
                          required
                          autocomplete="new-password"
                          placeholder="8文字以上" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="パスワード（確認）" class="text-gray-700 font-semibold" />
            <x-text-input id="password_confirmation"
                          class="block w-full"
                          type="password"
                          name="password_confirmation"
                          required
                          autocomplete="new-password"
                          placeholder="パスワードを再入力" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Actions -->
        <div class="space-y-4 pt-2">
            <x-primary-button class="w-full justify-center">
                登録する
            </x-primary-button>

            <div class="text-center">
                <a class="text-sm text-primary-600 hover:text-primary-700 font-medium transition-colors duration-200"
                   href="{{ route('login') }}">
                    すでに登録済みですか？
                </a>
            </div>
        </div>
    </form>

    <!-- Additional Info -->
    <div class="mt-8 pt-6 border-t border-gray-200">
        <p class="text-xs text-gray-500 text-center leading-relaxed">
            登録することで、<a href="{{ route('terms') }}" class="text-primary-600 hover:text-primary-700">利用規約</a>と<a href="{{ route('privacy') }}" class="text-primary-600 hover:text-primary-700">プライバシーポリシー</a>に同意したものとみなされます。
        </p>
    </div>

    <script>
        // ラジオボタンのラベルをクリックした時の動作
        document.querySelectorAll('input[name="role"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // すべてのラベルをリセット
                document.querySelectorAll('label[for^="role_"]').forEach(label => {
                    label.classList.remove('border-primary-600', 'bg-primary-50', 'border-secondary-600', 'bg-secondary-50');
                    label.classList.add('border-gray-300');
                });

                // 選択されたラジオボタンのラベルを強調
                const selectedLabel = document.querySelector(`label[for="${this.id}"]`);
                selectedLabel.classList.remove('border-gray-300');

                if (this.value === 'municipality') {
                    selectedLabel.classList.add('border-primary-600', 'bg-primary-50');
                } else {
                    selectedLabel.classList.add('border-secondary-600', 'bg-secondary-50');
                }
            });
        });
    </script>
</x-guest-layout>
