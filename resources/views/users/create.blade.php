
<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-start gap-4">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#0B2345] text-[#FFB629] shadow-lg">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 7v14m0-14C10.5 5.5 8.5 5 6 5S2 5.5 2 7v12c0-1.5 2-2 4-2s4 .5 6 2m0-12c1.5-1.5 3.5-2 6-2s4 .5 4 2v12c0-1.5-2-2-4-2s-4 .5-6 2"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-700">
                            Layanan Sirkulasi
                        </p>
                        <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-[#0B2345] sm:text-3xl">
                            Ajukan Peminjaman Buku
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">
                            Pilih buku yang tersedia dan kirim pengajuan peminjaman.
                        </p>
                    </div>
                </div>

                <a href="{{ route('peminjaman.saya.status') }}"
                   class="inline-flex w-fit items-center gap-2 rounded-xl border border-blue-100 bg-white px-4 py-3 text-sm font-bold text-[#0B2345] shadow-sm transition hover:bg-blue-50">
                    <svg class="h-5 w-5 text-[#1769AA]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                    </svg>
                    Status Pengajuan
                </a>
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-800">
                    <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 12 4 4L19 6"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                    <p class="font-bold">Pengajuan belum berhasil.</p>
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
                <div class="pointer-events-none absolute -bottom-20 right-32 h-44 w-44 rounded-full border-[20px] border-white/5"></div>

                <div class="relative z-10 max-w-2xl">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-blue-100">
                        <span class="h-2 w-2 rounded-full bg-[#FFB629]"></span>
                        PEMINJAMAN MANDIRI
                    </span>

                    <h2 class="mt-4 text-2xl font-extrabold tracking-tight sm:text-3xl">
                        Temukan Buku Pilihanmu
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-blue-100 sm:text-base">
                        Kirim permintaan peminjaman melalui formulir berikut.
                        Pengajuan akan diperiksa sebelum peminjaman disetujui.
                    </p>
                </div>
            </section>

            {{-- Informasi anggota --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5 sm:px-8">
                    <div class="flex items-center gap-2">
                        <span class="h-6 w-1 rounded-full bg-[#FFB629]"></span>
                        <h2 class="text-lg font-extrabold text-[#0B2345]">
                            Informasi Peminjam
                        </h2>
                    </div>
                    <p class="mt-2 text-sm text-slate-500">
                        Data anggota yang digunakan untuk pengajuan ini.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 sm:grid-cols-2 sm:p-8">
                    <div class="flex items-start gap-4 rounded-xl bg-slate-50 p-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#0B2345] text-[#FFB629]">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m12-14a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Nama Anggota
                            </p>
                            <p class="mt-1 break-words font-bold text-[#0B2345]">
                                {{ $anggota->nama }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 rounded-xl bg-slate-50 p-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#1769AA] text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M3 7l9 6 9-6M5 5h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Email Anggota
                            </p>
                            <p class="mt-1 break-words font-bold text-[#0B2345]">
                                {{ $anggota->email }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Form pengajuan --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5 sm:px-8">
                    <div class="flex items-center gap-2">
                        <span class="h-6 w-1 rounded-full bg-[#FFB629]"></span>
                        <h2 class="text-lg font-extrabold text-[#0B2345]">
                            Formulir Peminjaman
                        </h2>
                    </div>
                    <p class="mt-2 text-sm text-slate-500">
                        Pilih buku yang ingin kamu pinjam.
                    </p>
                </div>

                <form method="POST" action="{{ route('peminjaman.saya.store') }}" class="p-6 sm:p-8">
                    @csrf

                    <div>
                        <label for="buku_id" class="mb-2 block text-sm font-bold text-slate-700">
                            Pilih Buku
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="buku_id"
                            name="buku_id"
                            required
                            @disabled($bukus->isEmpty())
                            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm transition focus:border-[#1769AA] focus:ring-[#1769AA] disabled:cursor-not-allowed disabled:bg-slate-100"
                        >
                            <option value="">-- Pilih buku yang tersedia --</option>

                            @foreach ($bukus as $buku)
                                <option
                                    value="{{ $buku->id }}"
                                    @selected(old('buku_id') == $buku->id)
                                >
                                    {{ $buku->judul }} — {{ $buku->penulis }}
                                    (Stok tersedia: {{ $buku->stok }})
                                </option>
                            @endforeach
                        </select>

                        @if ($bukus->isEmpty())
                            <div class="mt-3 flex items-start gap-2 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">
                                <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M12 9v4m0 4h.01M10.3 3.9 1.8 18.5A1.7 1.7 0 0 0 3.3 21h17.4a1.7 1.7 0 0 0 1.5-2.5L13.7 3.9a2 2 0 0 0-3.4 0Z"/>
                                </svg>
                                <p>
                                    Belum ada buku dengan stok tersedia. Silakan coba lagi nanti.
                                </p>
                            </div>
                        @endif
                    </div>

                    {{-- Informasi alur --}}
                    <div class="mt-6 rounded-xl border border-blue-100 bg-blue-50 p-5">
                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#0B2345] text-[#FFB629]">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M12 8v4l3 2m6-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-[#0B2345]">
                                    Bagaimana proses peminjaman?
                                </p>
                                <p class="mt-1 text-sm leading-6 text-slate-600">
                                    Setelah dikirim, pengajuan berstatus
                                    <strong>Menunggu</strong>. Petugas yang berwenang akan
                                    menyetujui atau menolak pengajuan. Stok buku berkurang
                                    setelah pengajuan disetujui.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-7 flex flex-col gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:items-center">
                        <button
                            type="submit"
                            @disabled($bukus->isEmpty())
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0B2345] px-6 py-3 font-bold text-white shadow-sm transition hover:bg-[#103B6B] disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            <svg class="h-5 w-5 text-[#FFB629]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M5 12h14m-7-7 7 7-7 7"/>
                            </svg>
                            Kirim Pengajuan
                        </button>

                        <a
                            href="{{ route('peminjaman.saya.riwayat') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3 font-bold text-[#0B2345] transition hover:bg-slate-50"
                        >
                            Lihat Riwayat
                        </a>
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
