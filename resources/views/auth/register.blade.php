<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Role Selection -->
        <div>
            <x-input-label for="role" value="登録区分" />
            <div class="mt-2 space-y-2">
                <div class="flex items-center">
                    <input id="role_municipality" type="radio" name="role" value="municipality"
                           class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                           {{ old('role') === 'municipality' ? 'checked' : '' }} required>
                    <label for="role_municipality" class="ml-2 text-sm text-gray-700">
                        首長（自治体）
                    </label>
                </div>
                <div class="flex items-center">
                    <input id="role_company" type="radio" name="role" value="company"
                           class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                           {{ old('role') === 'company' ? 'checked' : '' }} required>
                    <label for="role_company" class="ml-2 text-sm text-gray-700">
                        企業
                    </label>
                </div>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" value="お名前（担当者名）" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" value="メールアドレス" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" value="電話番号" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="パスワード" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="パスワード（確認）" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                すでに登録済みですか？
            </a>

            <x-primary-button class="ms-4">
                登録する
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
