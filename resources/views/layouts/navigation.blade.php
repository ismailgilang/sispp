<nav x-data="{ open: false }" class="bg-gradient-to-r from-indigo-600 to-indigo-700 shadow-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-white hover:text-indigo-200 transition-colors duration-300">
                    <img src="{{ asset('images/login/lg.jpg') }}" class="w-10 rounded-full" alt="">
                </a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-4">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-indigo-200">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if (Auth::user()->role === 'admin')
                        <x-nav-link :href="route('Users.index')" :active="request()->routeIs('Users.index')" class="text-white hover:text-indigo-200">
                            {{ __('Users') }}
                        </x-nav-link>
                        <x-nav-link :href="route('Jurusan.index')" :active="request()->routeIs('Jurusan.index')" class="text-white hover:text-indigo-200">
                            {{ __('Jurusan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('Kelas.index')" :active="request()->routeIs('Kelas.index')" class="text-white hover:text-indigo-200">
                            {{ __('Kelas') }}
                        </x-nav-link>
                        <x-nav-link :href="route('Siswa.index')" :active="request()->routeIs('Siswa.index')" class="text-white hover:text-indigo-200">
                            {{ __('Siswa') }}
                        </x-nav-link>
                        <x-nav-link :href="route('Spp.index')" :active="request()->routeIs('Spp.index')" class="text-white hover:text-indigo-200">
                            {{ __('SPP') }}
                        </x-nav-link>
                        <x-nav-link :href="route('Pembayaran.index')" :active="request()->routeIs('Pembayaran.index')" class="text-white hover:text-indigo-200">
                            {{ __('Pembayaran') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->role === 'siswa')
                        <x-nav-link :href="route('user.spp')" :active="request()->routeIs('user.spp')" class="text-white hover:text-indigo-200">
                            {{ __('Tagihan SPP') }}
                        </x-nav-link>
                        <x-nav-link :href="route('user.pembayaran')" :active="request()->routeIs('user.pembayaran')" class="text-white hover:text-indigo-200">
                            {{ __('Hasil Pembayaran') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-2 px-4 py-2 rounded-lg text-white bg-indigo-500 hover:bg-indigo-400 transition duration-300">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.25 8.27a.75.75 0 01-.02-1.06z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-indigo-50">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="hover:bg-indigo-50">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-white hover:bg-indigo-500 focus:outline-none transition duration-200">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'block': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'block': open, 'hidden': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gradient-to-r from-indigo-600 to-indigo-700 text-white">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:bg-indigo-500">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if (Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('Users.index')" class="text-white hover:bg-indigo-500">
                    {{ __('Users') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('Jurusan.index')" class="text-white hover:bg-indigo-500">
                    {{ __('Jurusan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('Kelas.index')" class="text-white hover:bg-indigo-500">
                    {{ __('Kelas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('Siswa.index')" class="text-white hover:bg-indigo-500">
                    {{ __('Siswa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('Spp.index')" class="text-white hover:bg-indigo-500">
                    {{ __('SPP') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('Pembayaran.index')" class="text-white hover:bg-indigo-500">
                    {{ __('Pembayaran') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Mobile User Info -->
        <div class="pt-4 pb-1 border-t border-indigo-400">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-indigo-200">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:bg-indigo-500">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="text-white hover:bg-indigo-500"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>