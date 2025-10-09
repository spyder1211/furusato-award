<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 md:h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-2xl md:text-3xl font-bold gradient-text">
                        ふるさとアワード
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex md:items-center md:space-x-8 md:ml-10">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('dashboard') ? 'text-primary-600 border-b-2 border-primary-600' : '' }}">
                        ダッシュボード
                    </a>

                    <!-- 企業サービス一覧（全ユーザー共通） -->
                    <a href="{{ route('services.public.index') }}" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('services.public.index') || request()->routeIs('services.show') ? 'text-primary-600 border-b-2 border-primary-600' : '' }}">
                        企業サービス
                    </a>

                    @if(Auth::user()->role === 'municipality')
                        <a href="{{ route('municipalities.index') }}" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('municipalities.index') || request()->routeIs('municipalities.show') ? 'text-primary-600 border-b-2 border-primary-600' : '' }}">
                            首長マッチング
                        </a>
                        <a href="{{ route('municipalities.edit') }}" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('municipalities.edit') ? 'text-primary-600 border-b-2 border-primary-600' : '' }}">
                            マイページ
                        </a>
                        <a href="{{ route('municipalities.offers.received') }}" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('municipalities.offers.*') || request()->routeIs('companies.offers.sent') ? 'text-primary-600 border-b-2 border-primary-600' : '' }}">
                            オファー管理
                        </a>
                    @endif

                    @if(Auth::user()->role === 'company')
                        <a href="{{ route('companies.services.index') }}" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('companies.services.*') && !request()->routeIs('services.public.index') && !request()->routeIs('services.show') ? 'text-primary-600 border-b-2 border-primary-600' : '' }}">
                            サービス管理
                        </a>
                        <a href="{{ route('companies.profile.edit') }}" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('companies.profile.edit') ? 'text-primary-600 border-b-2 border-primary-600' : '' }}">
                            マイページ
                        </a>
                        <a href="{{ route('companies.offers.received') }}" class="text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('companies.offers.received') ? 'text-primary-600 border-b-2 border-primary-600' : '' }}">
                            オファー受信
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-all duration-200">
                        <div>{{ Auth::user()->name }}</div>
                        <svg class="ml-2 h-4 w-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 border border-gray-200 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            プロフィール設定
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                ログアウト
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" x-cloak x-transition class="md:hidden border-t border-gray-200 bg-white">
        <div class="px-4 py-4 space-y-3">
            <a href="{{ route('dashboard') }}" class="block text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('dashboard') ? 'text-primary-600' : '' }}">
                ダッシュボード
            </a>

            <!-- 企業サービス一覧（全ユーザー共通） -->
            <a href="{{ route('services.public.index') }}" class="block text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('services.public.index') || request()->routeIs('services.show') ? 'text-primary-600' : '' }}">
                企業サービス
            </a>

            @if(Auth::user()->role === 'municipality')
                <a href="{{ route('municipalities.index') }}" class="block text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('municipalities.index') || request()->routeIs('municipalities.show') ? 'text-primary-600' : '' }}">
                    首長マッチング
                </a>
                <a href="{{ route('municipalities.edit') }}" class="block text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('municipalities.edit') ? 'text-primary-600' : '' }}">
                    マイページ
                </a>
                <a href="{{ route('municipalities.offers.received') }}" class="block text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('municipalities.offers.*') || request()->routeIs('companies.offers.sent') ? 'text-primary-600' : '' }}">
                    オファー管理
                </a>
            @endif

            @if(Auth::user()->role === 'company')
                <a href="{{ route('companies.services.index') }}" class="block text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('companies.services.*') && !request()->routeIs('services.public.index') && !request()->routeIs('services.show') ? 'text-primary-600' : '' }}">
                    サービス管理
                </a>
                <a href="{{ route('companies.profile.edit') }}" class="block text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('companies.profile.edit') ? 'text-primary-600' : '' }}">
                    マイページ
                </a>
                <a href="{{ route('companies.offers.received') }}" class="block text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium {{ request()->routeIs('companies.offers.received') ? 'text-primary-600' : '' }}">
                    オファー受信
                </a>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="px-4 py-4 border-t border-gray-200 bg-gray-50">
            <div class="mb-3">
                <div class="font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                <div class="text-sm text-gray-600">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-2">
                <a href="{{ route('profile.edit') }}" class="block text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">
                    プロフィール設定
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left text-gray-700 hover:text-primary-600 transition-colors duration-200 font-medium">
                        ログアウト
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
