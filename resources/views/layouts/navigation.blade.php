<nav x-data="{ open: false }"
     class="sticky top-0 z-50 border-b border-blue-900/20 bg-[#0B2345] shadow-md">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            {{-- Logo dan Brand --}}
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#FFB629] text-xl font-extrabold text-[#0B2345] shadow-sm">
                        P
                    </div>

                    <div class="hidden sm:block">
                        <div class="text-base font-extrabold tracking-wide text-white">
                            PERPUSTAKAAN
                        </div>
                        <div class="text-[10px] font-medium uppercase tracking-[0.2em] text-blue-200">
                            Portal Layanan Buku
                        </div>
                    </div>
                </a>

                {{-- Navigasi Desktop --}}
                <div class="ml-8 hidden items-center gap-1 lg:flex">

                    {{-- Admin --}}
                    @role('admin')
                        <x-nav-link
                            :href="route('admin.dashboard')"
                            :active="request()->routeIs('admin.dashboard')">
                            Dashboard Admin
                        </x-nav-link>

                        @can('kelola data pengguna')
                            <x-nav-link
                                :href="route('admin.users.index')"
                                :active="request()->routeIs('admin.users.*')">
                                Kelola Pengguna
                            </x-nav-link>
                        @endcan

                        @can('lihat laporan perpustakaan')
                            <x-nav-link
                                :href="route('admin.laporan-peminjaman')"
                                :active="request()->routeIs('admin.laporan-peminjaman')">
                                Laporan
                            </x-nav-link>
                        @endcan
                    @endrole

                    {{-- Petugas --}}
                    @role('petugas')
                        <x-nav-link
                            :href="route('petugas.dashboard')"
                            :active="request()->routeIs('petugas.dashboard')">
                            Dashboard Petugas
                        </x-nav-link>
                    @endrole

                    @can('kelola data anggota')
                        <x-nav-link
                            :href="route('petugas.anggota.index')"
                            :active="request()->routeIs('petugas.anggota.*')">
                            Data Anggota
                        </x-nav-link>
                    @endcan

                    @can('kelola peminjaman')
                        <x-nav-link
                            :href="route('admin.peminjaman.index')"
                            :active="request()->routeIs('admin.peminjaman.*')">
                            Peminjaman
                        </x-nav-link>
                    @endcan

                    @can('kelola pengembalian')
                        <x-nav-link
                            :href="route('admin.pengembalian.index')"
                            :active="request()->routeIs('admin.pengembalian.*')">
                            Pengembalian
                        </x-nav-link>
                    @endcan

                    {{-- Siswa --}}
                    @role('siswa')
                        <x-nav-link
                            :href="route('buku.index')"
                            :active="request()->routeIs('buku.index')">
                            Dashboard Siswa
                        </x-nav-link>
                    @endrole

                    {{-- Menu bersama --}}
                    @can('lihat daftar buku')
                        <x-nav-link
                            :href="route('buku.index')"
                            :active="request()->routeIs('buku.index')">
                            Daftar Buku
                        </x-nav-link>
                    @endcan

                    @can('mengajukan peminjaman buku')
                        <x-nav-link
                            :href="route('peminjaman.saya.create')"
                            :active="request()->routeIs('peminjaman.saya.create')">
                            Ajukan Buku
                        </x-nav-link>
                    @endcan

                    @can('melihat status peminjaman sendiri')
                        <x-nav-link
                            :href="route('peminjaman.saya.status')"
                            :active="request()->routeIs('peminjaman.saya.status')">
                            Status Saya
                        </x-nav-link>
                    @endcan

                    @can('melihat riwayat peminjaman sendiri')
                        <x-nav-link
                            :href="route('peminjaman.saya.riwayat')"
                            :active="request()->routeIs('peminjaman.saya.riwayat')">
                            Riwayat
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            {{-- Profil Desktop --}}
            <div class="hidden items-center sm:flex">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center gap-2 rounded-lg border border-white/15 bg-white/10 px-3 py-2 text-sm font-semibold text-white transition hover:bg-white/20 focus:outline-none">

                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-[#FFB629] font-bold text-[#0B2345]">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>

                            <span class="max-w-28 truncate">
                                {{ Auth::user()->name }}
                            </span>

                            <svg class="h-4 w-4 fill-current"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="border-b border-gray-100 px-4 py-3">
                            <p class="font-semibold text-gray-800">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="truncate text-xs text-gray-500">
                                {{ Auth::user()->email }}
                            </p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            Profil Saya
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 transition hover:bg-gray-100 focus:bg-gray-100 focus:outline-none">
                                Keluar
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Tombol Mobile --}}
            <button
                @click="open = !open"
                class="inline-flex items-center justify-center rounded-lg p-2 text-white transition hover:bg-white/10 focus:outline-none sm:hidden"
                aria-label="Buka menu navigasi">

                <svg class="h-6 w-6"
                     stroke="currentColor"
                     fill="none"
                     viewBox="0 0 24 24">
                    <path
                        :class="{ 'hidden': open, 'inline-flex': !open }"
                        class="inline-flex"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>

                    <path
                        :class="{ 'hidden': !open, 'inline-flex': open }"
                        class="hidden"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Navigasi Mobile --}}
    <div x-cloak
         x-show="open"
         x-transition
         class="border-t border-white/10 bg-[#0B2345] sm:hidden">

        <div class="space-y-1 px-4 py-3">

            {{-- Admin --}}
            @role('admin')
                <x-responsive-nav-link
                    :href="route('admin.dashboard')"
                    :active="request()->routeIs('admin.dashboard')">
                    Dashboard Admin
                </x-responsive-nav-link>

                @can('kelola data pengguna')
                    <x-responsive-nav-link
                        :href="route('admin.users.index')"
                        :active="request()->routeIs('admin.users.*')">
                        Kelola Pengguna
                    </x-responsive-nav-link>
                @endcan

                @can('lihat laporan perpustakaan')
                    <x-responsive-nav-link
                        :href="route('admin.laporan-peminjaman')"
                        :active="request()->routeIs('admin.laporan-peminjaman')">
                        Laporan
                    </x-responsive-nav-link>
                @endcan
            @endrole

            {{-- Petugas --}}
            @role('petugas')
                <x-responsive-nav-link
                    :href="route('petugas.dashboard')"
                    :active="request()->routeIs('petugas.dashboard')">
                    Dashboard Petugas
                </x-responsive-nav-link>
            @endrole

            {{-- Siswa --}}
            @role('siswa')
                <x-responsive-nav-link
                    :href="route('buku.index')"
                    :active="request()->routeIs('buku.index')">
                    Dashboard Siswa
                </x-responsive-nav-link>
            @endrole

            {{-- Menu bersama --}}
            @can('kelola data anggota')
                <x-responsive-nav-link
                    :href="route('petugas.anggota.index')"
                    :active="request()->routeIs('petugas.anggota.*')">
                    Data Anggota
                </x-responsive-nav-link>
            @endcan

            @can('kelola peminjaman')
                <x-responsive-nav-link
                    :href="route('admin.peminjaman.index')"
                    :active="request()->routeIs('admin.peminjaman.*')">
                    Peminjaman
                </x-responsive-nav-link>
            @endcan

            @can('kelola pengembalian')
                <x-responsive-nav-link
                    :href="route('admin.pengembalian.index')"
                    :active="request()->routeIs('admin.pengembalian.*')">
                    Pengembalian
                </x-responsive-nav-link>
            @endcan

            @can('lihat daftar buku')
                <x-responsive-nav-link
                    :href="route('buku.index')"
                    :active="request()->routeIs('buku.index')">
                    Daftar Buku
                </x-responsive-nav-link>
            @endcan

            @can('mengajukan peminjaman buku')
                <x-responsive-nav-link
                    :href="route('peminjaman.saya.create')"
                    :active="request()->routeIs('peminjaman.saya.create')">
                    Ajukan Peminjaman
                </x-responsive-nav-link>
            @endcan

            @can('melihat status peminjaman sendiri')
                <x-responsive-nav-link
                    :href="route('peminjaman.saya.status')"
                    :active="request()->routeIs('peminjaman.saya.status')">
                    Status Peminjaman
                </x-responsive-nav-link>
            @endcan

            @can('melihat riwayat peminjaman sendiri')
                <x-responsive-nav-link
                    :href="route('peminjaman.saya.riwayat')"
                    :active="request()->routeIs('peminjaman.saya.riwayat')">
                    Riwayat Peminjaman
                </x-responsive-nav-link>
            @endcan
        </div>

        {{-- Profil Mobile --}}
        <div class="border-t border-white/10 px-4 py-4">
            <div class="font-semibold text-white">
                {{ Auth::user()->name }}
            </div>
            <div class="mt-1 text-sm text-blue-200">
                {{ Auth::user()->email }}
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profil Saya
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full rounded-md px-4 py-2 text-left text-sm font-medium text-blue-100 transition hover:bg-white/10 hover:text-white">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
