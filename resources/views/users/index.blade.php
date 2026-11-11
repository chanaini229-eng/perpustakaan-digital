<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-start gap-4">
                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#0B2345] text-[#FFB629] shadow-lg">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m16-13a4 4 0 010 8m4 5v-2a4 4 0 00-3-3.87M9 11a4 4 0 100-8 4 4 0 000 8z"/>
                    </svg>
                </div>

                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#B7791F]">
                        Administrasi Perpustakaan
                    </p>
                    <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-[#0B2345] sm:text-3xl">
                        Kelola Pengguna
                    </h2>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Kelola akun, informasi pengguna, dan hak akses sistem perpustakaan.
                    </p>
                </div>
            </div>

            @if (Route::has('admin.users.create'))
                <a href="{{ route('admin.users.create') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0B2345] px-5 py-3 text-sm font-bold text-white shadow-md transition duration-200 hover:-translate-y-0.5 hover:bg-[#123B6D] hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#FFB629] focus:ring-offset-2">
                    <svg class="h-5 w-5 text-[#FFB629]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Pengguna
                </a>
            @endif
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Header visual --}}
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#0B2345] via-[#103B6B] to-[#1769AA] p-6 text-white shadow-lg sm:p-8">
                <div class="absolute right-0 top-0 h-full w-2 bg-[#FFB629]"></div>
                <div class="pointer-events-none absolute -right-10 -top-16 h-48 w-48 rounded-full border-[24px] border-white/5"></div>
                <div class="pointer-events-none absolute -bottom-20 right-32 h-44 w-44 rounded-full border-[20px] border-white/5"></div>

                <div class="relative z-10 max-w-2xl">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-blue-100">
                        <span class="h-2 w-2 rounded-full bg-[#FFB629]"></span>
                        PANEL ADMINISTRATOR
                    </span>

                    <h3 class="mt-4 text-2xl font-extrabold tracking-tight sm:text-3xl">
                        Manajemen Akun Perpustakaan
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-blue-100 sm:text-base">
                        Pantau akun terdaftar, periksa peran pengguna, dan kelola akses
                        sistem dari satu halaman.
                    </p>

                    <div class="mt-5 flex items-center gap-2 text-xs font-medium text-blue-100">
                        <svg class="h-4 w-4 text-[#FFB629]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 11c0 3-2 5-5 5m5-5c0-3 2-5 5-5m-5 5v9m-7-9a7 7 0 1114 0 7 7 0 01-14 0z"/>
                        </svg>
                        Akses pengguna dan pengelolaan akun
                    </div>
                </div>
            </section>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div role="status" class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 shadow-sm">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100 font-bold">✓</span>
                    <div>
                        <p class="font-bold">Berhasil</p>
                        <p class="mt-1 text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div role="alert" class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800 shadow-sm">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 font-bold">!</span>
                    <div>
                        <p class="font-bold">Terjadi kesalahan</p>
                        <p class="mt-1 text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            {{-- Kartu statistik --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">
                    <div class="absolute left-0 top-0 h-full w-1 bg-[#FFB629]"></div>
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">Total Pengguna</p>
                            <p class="mt-3 text-4xl font-extrabold tracking-tight text-[#0B2345]">
                                {{ $users->total() }}
                            </p>
                            <p class="mt-2 text-xs text-slate-500">Seluruh akun terdaftar</p>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#0B2345] text-[#FFB629] transition group-hover:bg-[#1769AA]">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H2v-2a4 4 0 014-4h6a4 4 0 014 4v2H9zm0-10a4 4 0 100-8 4 4 0 000 8zm8-1a4 4 0 100-8"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-5 h-1 w-full overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full w-2/3 rounded-full bg-[#FFB629]"></div>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">
                    <div class="absolute left-0 top-0 h-full w-1 bg-[#1769AA]"></div>
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">Akun pada Halaman Ini</p>
                            <p class="mt-3 text-4xl font-extrabold tracking-tight text-[#0B2345]">
                                {{ $users->count() }}
                            </p>
                            <p class="mt-2 text-xs text-slate-500">Data pada halaman aktif</p>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-[#1769AA] transition group-hover:bg-blue-100">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-5 h-1 w-full overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full w-1/3 rounded-full bg-[#1769AA]"></div>
                    </div>
                </div>
            </div>

            {{-- Tabel pengguna --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="h-6 w-1 rounded-full bg-[#FFB629]"></span>
                            <h3 class="text-lg font-extrabold text-[#0B2345]">Daftar Akun</h3>
                        </div>
                        <p class="mt-2 text-sm text-slate-500">
                            Informasi akun dan tindakan pengelolaan pengguna.
                        </p>
                    </div>

                    <div class="relative w-full sm:max-w-sm">
                        <label for="cariPengguna" class="sr-only">Cari pengguna</label>
                        <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7" stroke-width="1.8"/>
                            <path stroke-linecap="round" stroke-width="1.8" d="m16 16 4 4"/>
                        </svg>
                        <input
                            id="cariPengguna"
                            type="search"
                            autocomplete="off"
                            placeholder="Cari nama, email, atau role..."
                            class="w-full rounded-xl border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700 transition placeholder:text-slate-400 focus:border-[#1769AA] focus:bg-white focus:ring-2 focus:ring-blue-100"
                        >
                    </div>
                </div>

                @if ($users->isEmpty())
                    <div class="px-6 py-16 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-[#1769AA]">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m16-13a4 4 0 010 8m4 5v-2a4 4 0 00-3-3.87M9 11a4 4 0 100-8 4 4 0 000 8z"/>
                            </svg>
                        </div>
                        <h4 class="mt-4 font-bold text-[#0B2345]">Belum ada pengguna</h4>
                        <p class="mt-1 text-sm text-slate-500">Data pengguna akan muncul di sini.</p>

                        @if (Route::has('admin.users.create'))
                            <a href="{{ route('admin.users.create') }}"
                               class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[#0B2345] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#1769AA]">
                                + Tambah Pengguna
                            </a>
                        @endif
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[850px] text-left text-sm">
                            <thead class="bg-[#0B2345] text-xs uppercase tracking-wider text-blue-100">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-bold">No.</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Pengguna</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Email</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Role</th>
                                    <th scope="col" class="px-6 py-4 text-center font-bold">Aksi</th>
                                </tr>
                            </thead>

                            <tbody id="daftarPengguna" class="divide-y divide-slate-100">
                                @foreach ($users as $user)
                                    @php
                                        $role = $user->getRoleNames()->first() ?? 'Belum ada role';

                                        $roleClass = match (strtolower($role)) {
                                            'admin' => 'bg-purple-50 text-purple-700 ring-purple-200',
                                            'petugas' => 'bg-blue-50 text-blue-700 ring-blue-200',
                                            'siswa' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                                            default => 'bg-slate-100 text-slate-600 ring-slate-200',
                                        };
                                    @endphp

                                    <tr class="user-row transition-colors duration-150 hover:bg-blue-50/50">
                                        <td class="whitespace-nowrap px-6 py-4 text-slate-400">
                                            {{ ($users->firstItem() ?? 1) + $loop->index }}
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#0B2345] font-extrabold uppercase text-[#FFB629] shadow-sm">
                                                    {{ mb_substr($user->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="user-name font-bold text-slate-800">
                                                        {{ $user->name }}
                                                    </p>
                                                    <p class="mt-1 text-xs text-slate-400">
                                                        ID Pengguna: {{ $user->id }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="user-email whitespace-nowrap px-6 py-4 text-slate-600">
                                            {{ $user->email }}
                                        </td>

                                        <td class="user-role whitespace-nowrap px-6 py-4">
                                            <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-bold ring-1 ring-inset {{ $roleClass }}">
                                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                                {{ ucfirst($role) }}
                                            </span>
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                   class="inline-flex items-center gap-1.5 rounded-lg border border-blue-200 bg-blue-50 px-3 py-2 text-xs font-bold text-[#1769AA] transition hover:border-[#1769AA] hover:bg-[#1769AA] hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-200"
                                                   title="Edit pengguna">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="m16.862 4.487 1.687-1.688a2.121 2.121 0 013 3L9.75 17.598 5 19l1.402-4.75L16.862 4.487zM19 15v5H4V5h5"/>
                                                    </svg>
                                                    Edit
                                                </a>

                                                @if (auth()->id() !== $user->id)
                                                    <form
                                                        action="{{ route('admin.users.destroy', $user->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus akun {{ addslashes($user->name) }}? Tindakan ini tidak dapat dibatalkan.');"
                                                    >
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-bold text-red-700 transition hover:border-red-600 hover:bg-red-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-200"
                                                            title="Hapus pengguna"
                                                        >
                                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16"/>
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-400"
                                                          title="Akun yang sedang digunakan tidak dapat dihapus dari halaman ini">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <rect x="5" y="10" width="14" height="11" rx="2" stroke-width="1.8"/>
                                                            <path stroke-linecap="round" stroke-width="1.8" d="M8 10V6a4 4 0 118 0v4"/>
                                                        </svg>
                                                        Akun Anda
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="hasilKosong" class="hidden border-t border-slate-100 px-6 py-10 text-center">
                        <div class="text-sm font-semibold text-slate-700">Pengguna tidak ditemukan</div>
                        <p class="mt-1 text-xs text-slate-500">Coba gunakan nama, email, atau role yang berbeda.</p>
                    </div>

                    @if (method_exists($users, 'links'))
                        <div id="paginationPengguna" class="border-t border-slate-100 px-5 py-4 sm:px-6">
                            {{ $users->links() }}
                        </div>
                    @endif
                @endif

                <div class="flex flex-col gap-1 border-t border-slate-100 bg-slate-50 px-5 py-4 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <span>Administrasi akun perpustakaan</span>
                    <span class="font-medium text-slate-400">Sistem Informasi Perpustakaan</span>
                </div>
            </section>
        </div>
    </div>

    {{-- Pencarian pada data halaman aktif --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('cariPengguna');
            const rows = document.querySelectorAll('.user-row');
            const emptyMessage = document.getElementById('hasilKosong');
            const pagination = document.getElementById('paginationPengguna');

            if (!input) return;

            input.addEventListener('input', function () {
                const keyword = this.value.toLowerCase().trim();
                let visibleCount = 0;

                rows.forEach(function (row) {
                    const name = row.querySelector('.user-name')?.textContent.toLowerCase() || '';
                    const email = row.querySelector('.user-email')?.textContent.toLowerCase() || '';
                    const role = row.querySelector('.user-role')?.textContent.toLowerCase() || '';

                    const match = (name + ' ' + email + ' ' + role).includes(keyword);

                    row.style.display = match ? '' : 'none';

                    if (match) visibleCount++;
                });

                if (emptyMessage) {
                    emptyMessage.classList.toggle('hidden', visibleCount > 0);
                }

                // Pagination disembunyikan saat filter lokal aktif agar tidak membingungkan.
                if (pagination) {
                    pagination.classList.toggle('hidden', keyword.length > 0);
                }
            });
        });
    </script>
</x-app-layout>