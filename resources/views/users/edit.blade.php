<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-4xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex items-start gap-4">
                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#0B2345] text-[#FFB629] shadow-lg">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m16 0v-2a4 4 0 0 0-3-3.87M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7-7.87a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>

                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-700">
                        Administrasi Pengguna
                    </p>
                    <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-[#0B2345] sm:text-3xl">
                        Edit Pengguna
                    </h1>
                    <p class="mt-1 text-sm text-slate-500">
                        Perbarui informasi akun dan hak akses pengguna.
                    </p>
                </div>
            </div>

            {{-- Notifikasi error --}}
            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                    <p class="font-bold">Periksa kembali data berikut:</p>
                    <ul class="mt-2 list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Banner --}}
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#0B2345] via-[#103B6B] to-[#1769AA] p-6 text-white shadow-lg sm:p-8">
                <div class="absolute right-0 top-0 h-full w-2 bg-[#FFB629]"></div>
                <div class="pointer-events-none absolute -right-10 -top-16 h-48 w-48 rounded-full border-[24px] border-white/5"></div>

                <div class="relative z-10">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-blue-100">
                        <span class="h-2 w-2 rounded-full bg-[#FFB629]"></span>
                        PENGATURAN AKUN
                    </span>

                    <h2 class="mt-4 text-2xl font-extrabold tracking-tight">
                        Perbarui Data Pengguna
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-blue-100">
                        Pastikan informasi akun dan role sudah sesuai sebelum menyimpan perubahan.
                    </p>
                </div>
            </section>

            {{-- Form edit --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5 sm:px-8">
                    <div class="flex items-center gap-2">
                        <span class="h-6 w-1 rounded-full bg-[#FFB629]"></span>
                        <h2 class="text-lg font-extrabold text-[#0B2345]">
                            Informasi Akun
                        </h2>
                    </div>
                    <p class="mt-2 text-sm text-slate-500">
                        Ubah kolom yang diperlukan. Password boleh dikosongkan jika tidak ingin diubah.
                    </p>
                </div>

                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6 p-6 sm:p-8">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div>
                        <label for="name" class="mb-2 block text-sm font-bold text-slate-700">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            required
                            autocomplete="name"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm transition focus:border-[#1769AA] focus:ring-[#1769AA]"
                            placeholder="Masukkan nama lengkap"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="mb-2 block text-sm font-bold text-slate-700">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            autocomplete="email"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm transition focus:border-[#1769AA] focus:ring-[#1769AA]"
                            placeholder="contoh@email.com"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div>
                        <label for="role" class="mb-2 block text-sm font-bold text-slate-700">
                            Role Pengguna <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="role"
                            name="role"
                            required
                            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-[#1769AA] focus:ring-[#1769AA]"
                        >
                            <option value="">-- Pilih role pengguna --</option>
                            @foreach ($roles as $role)
                                <option
                                    value="{{ $role->name }}"
                                    @selected(old('role', $user->roles->first()?->name) === $role->name)
                                >
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-2 text-xs leading-5 text-slate-500">
                            Role menentukan hak akses pengguna di dalam sistem perpustakaan.
                        </p>
                        @error('role')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="rounded-xl border border-blue-100 bg-blue-50/60 p-5">
                        <div class="mb-5">
                            <h3 class="font-bold text-[#0B2345]">
                                Ubah Password
                            </h3>
                            <p class="mt-1 text-sm text-slate-500">
                                Bagian ini opsional. Kosongkan kedua kolom password jika tidak ingin mengubahnya.
                            </p>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label for="password" class="mb-2 block text-sm font-bold text-slate-700">
                                    Password Baru
                                </label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    minlength="8"
                                    autocomplete="new-password"
                                    class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-[#1769AA] focus:ring-[#1769AA]"
                                    placeholder="Minimal 8 karakter"
                                >
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="mb-2 block text-sm font-bold text-slate-700">
                                    Konfirmasi Password Baru
                                </label>
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    minlength="8"
                                    autocomplete="new-password"
                                    class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-[#1769AA] focus:ring-[#1769AA]"
                                    placeholder="Ulangi password baru"
                                >
                            </div>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">
                        <a
                            href="{{ route('admin.users.index') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0B2345] px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#103B6B]"
                        >
                            <svg class="h-5 w-5 text-[#FFB629]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M5 12h14m-7-7 7 7-7 7"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </section>

            {{-- Footer --}}
            <div class="flex items-center justify-center gap-2 pb-2 text-xs text-slate-400">
                <span class="h-1.5 w-1.5 rounded-full bg-[#FFB629]"></span>
                Sistem Informasi Perpustakaan
            </div>
        </div>
    </div>
</x-app-layout>
