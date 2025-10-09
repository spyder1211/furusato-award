<x-guest-layout>
    <!-- Page Title -->
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 text-center mb-2">ログイン</h2>
        <p class="text-sm text-gray-600 text-center">アカウントにログインして、マッチング機能をご利用ください</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="メールアドレス" class="text-gray-700 font-semibold" />
            <x-text-input id="email"
                          class="block w-full"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required
                          autofocus
                          autocomplete="username"
                          placeholder="example@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="パスワード" class="text-gray-700 font-semibold" />
            <x-text-input id="password"
                          class="block w-full"
                          type="password"
                          name="password"
                          required
                          autocomplete="current-password"
                          placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me"
                   type="checkbox"
                   class="w-4 h-4 rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500"
                   name="remember">
            <label for="remember_me" class="ml-3 text-sm text-gray-700 cursor-pointer">
                ログイン状態を保持する
            </label>
        </div>

        <!-- Actions -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center">
                ログイン
            </x-primary-button>

            <div class="text-center">
                <a class="text-sm text-primary-600 hover:text-primary-700 font-medium transition-colors duration-200"
                   href="{{ route('register') }}">
                    新規登録はこちら
                </a>
            </div>
        </div>
    </form>

    <!-- Additional Info -->
    <div class="mt-8 pt-6 border-t border-gray-200">
        <p class="text-xs text-gray-500 text-center leading-relaxed">
            ログインすることで、<a href="{{ route('terms') }}" class="text-primary-600 hover:text-primary-700">利用規約</a>と<a href="{{ route('privacy') }}" class="text-primary-600 hover:text-primary-700">プライバシーポリシー</a>に同意したものとみなされます。
        </p>
    </div>
</x-guest-layout>
