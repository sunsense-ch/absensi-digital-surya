<nav x-data="{ mobileOpen: false }" class="border-b border-stone-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">

            <div class="flex">
                {{-- Brand --}}
                <a href="{{ route('dashboard') }}" class="flex shrink-0 items-center">
                    <span class="font-serif text-lg text-stone-800">Absensi Digital</span>
                </a>

                {{-- Desktop nav links --}}
                <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium transition-colors
                            {{ request()->routeIs('dashboard')
                                ? 'border-emerald-700 text-stone-800'
                                : 'border-transparent text-stone-500 hover:border-stone-300 hover:text-stone-800' }}">
                        Dashboard
                    </a>

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.classes.index') }}"
                            class="inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium transition-colors
                                {{ request()->routeIs('admin.classes.*')
                                    ? 'border-emerald-700 text-stone-800'
                                    : 'border-transparent text-stone-500 hover:border-stone-300 hover:text-stone-800' }}">
                            Data Kelas
                        </a>

                        <a href="{{ route('admin.students.index') }}"
                            class="inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium transition-colors
                                {{ request()->routeIs('admin.students.*')
                                    ? 'border-emerald-700 text-stone-800'
                                    : 'border-transparent text-stone-500 hover:border-stone-300 hover:text-stone-800' }}">
                            Data Siswa
                        </a>

                        <a href="{{ route('admin.qr-locations.index') }}"
                            class="inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium transition-colors
                                {{ request()->routeIs('admin.qr-locations.*')
                                    ? 'border-emerald-700 text-stone-800'
                                    : 'border-transparent text-stone-500 hover:border-stone-300 hover:text-stone-800' }}">
                            Lokasi QR
                        </a>
                    @endif
                </div>
            </div>

            {{-- Desktop user dropdown --}}
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <div x-data="{ open: false }" class="relative">
                    <button
                        @click="open = !open"
                        @click.outside="open = false"
                        class="flex items-center gap-1 rounded-md px-3 py-2 text-sm font-medium text-stone-600 transition-colors hover:bg-stone-50">
                        {{ Auth::user()->name }}
                        <svg class="h-4 w-4 text-stone-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div
                        x-show="open"
                        x-transition
                        style="display: none;"
                        class="absolute right-0 z-50 mt-2 w-44 rounded-md border border-stone-200 bg-white py-1">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-stone-600 hover:bg-stone-50">
                            Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full px-4 py-2 text-left text-sm text-stone-600 hover:bg-stone-50">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Mobile hamburger button --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button
                    @click="mobileOpen = !mobileOpen"
                    class="inline-flex items-center justify-center rounded-md p-2 text-stone-500 hover:bg-stone-50 hover:text-stone-700 focus:outline-none">
                    <svg class="h-6 w-6" :class="{ 'hidden': mobileOpen, 'block': !mobileOpen }" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" :class="{ 'hidden': !mobileOpen, 'block': mobileOpen }" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu panel --}}
    <div x-show="mobileOpen" style="display: none;" class="sm:hidden border-t border-stone-200">
        <div class="space-y-1 pb-3 pt-2">
            <a href="{{ route('dashboard') }}"
                class="block border-l-4 py-2 pl-3 pr-4 text-base font-medium
                    {{ request()->routeIs('dashboard')
                        ? 'border-emerald-700 bg-emerald-50 text-emerald-800'
                        : 'border-transparent text-stone-600 hover:border-stone-300 hover:bg-stone-50' }}">
                Dashboard
            </a>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.classes.index') }}"
                    class="block border-l-4 py-2 pl-3 pr-4 text-base font-medium
                        {{ request()->routeIs('admin.classes.*')
                            ? 'border-emerald-700 bg-emerald-50 text-emerald-800'
                            : 'border-transparent text-stone-600 hover:border-stone-300 hover:bg-stone-50' }}">
                    Data Kelas
                </a>

                <a href="{{ route('admin.students.index') }}"
                    class="block border-l-4 py-2 pl-3 pr-4 text-base font-medium
                        {{ request()->routeIs('admin.students.*')
                            ? 'border-emerald-700 bg-emerald-50 text-emerald-800'
                            : 'border-transparent text-stone-600 hover:border-stone-300 hover:bg-stone-50' }}">
                    Data Siswa
                </a>

                <a href="{{ route('admin.qr-locations.index') }}"
                    class="block border-l-4 py-2 pl-3 pr-4 text-base font-medium
                        {{ request()->routeIs('admin.qr-locations.*')
                            ? 'border-emerald-700 bg-emerald-50 text-emerald-800'
                            : 'border-transparent text-stone-600 hover:border-stone-300 hover:bg-stone-50' }}">
                    Lokasi QR
                </a>
            @endif
        </div>

        {{-- Mobile user info + actions --}}
        <div class="border-t border-stone-200 pb-3 pt-4">
            <div class="px-4">
                <div class="text-base font-medium text-stone-800">{{ Auth::user()->name }}</div>
                <div class="text-sm text-stone-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 text-base font-medium text-stone-600 hover:bg-stone-50">
                    Profil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full px-4 py-2 text-left text-base font-medium text-stone-600 hover:bg-stone-50">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
