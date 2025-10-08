<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        <div class="flex items-center justify-center mb-6">
            <svg class="w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>

        <h2 class="text-xl font-semibold text-center mb-4 text-gray-900">
            アカウント承認待ち
        </h2>

        <p class="text-center mb-4">
            ご登録ありがとうございます。<br>
            現在、管理者によるアカウント承認をお待ちいただいております。
        </p>

        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        承認が完了するまで、一部機能がご利用いただけません。<br>
                        承認完了後、ご登録いただいたメールアドレスに通知をお送りいたします。
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600 mb-4">
                お問い合わせがある場合は、以下の情報をご確認ください。
            </p>
            <div class="bg-gray-50 rounded-lg p-4 text-left">
                <p class="text-sm"><strong>ご登録いただいた情報:</strong></p>
                <p class="text-sm mt-2">メールアドレス: {{ auth()->user()->email }}</p>
                <p class="text-sm">登録区分: {{ auth()->user()->role === 'municipality' ? '首長（自治体）' : '企業' }}</p>
                <p class="text-sm">登録日時: {{ auth()->user()->created_at->format('Y年m月d日 H:i') }}</p>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                ログアウト
            </button>
        </form>
    </div>
</x-guest-layout>
