<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            <div class="mb-8 rounded-2xl bg-[#0B2345] p-6 text-white shadow-lg sm:p-8">
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-amber-400">
                    Perpustakaan
                </p>

                <h1 class="mt-3 text-2xl font-extrabold sm:text-3xl">
                    Ajukan Peminjaman Buku
                </h1>

                <p class="mt-2 text-sm text-slate-200 sm:text-base">
                    Pilih buku yang ingin kamu pinjam dan kirim pengajuan kepada petugas.
                </p>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm font-medium text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800">
                    <p class="font-bold">Pengajuan belum berhasil.</p>
                    <ul class="mt-2 list-inside list-disc text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-lg font-extrabold text-[#0B2345]">
                        Formulir Peminjaman
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Periksa pilihan buku sebelum mengirim pengajuan.
                    </p>
                </div>

                <form action="{{ route('peminjaman.saya.store') }}" method="POST" class="space-y-6 p-6 sm:p-8">
                    @csrf

                    <div>
                        <label for="buku_id" class="mb-2 block text-sm font-bold text-slate-700">
                            Pilih Buku <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="buku_id"
                            name="buku_id"
                            required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-700 focus:border-[#1769AA] focus:outline-none focus:ring-2 focus:ring-blue-100"
                        >
                            <option value="">-- Pilih buku yang ingin dipinjam --</option>

                            @forelse ($bukus as $buku)
                                <option
                                    value="{{ $buku->id }}"
                                    {{ old('buku_id') == $buku->id ? 'selected' : '' }}
                                >
                                    {{ $buku->judul }}
                                    — Stok: {{ $buku->stok }}
                                </option>
                            @empty
                                <option value="" disabled>Tidak ada buku tersedia</option>
                            @endforelse
                        </select>

                        @error('buku_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <p class="mt-2 text-xs text-slate-500">
                            Pilihan buku bergantung pada data dan stok yang disediakan sistem.
                        </p>
                    </div>

                    <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">
                        <p class="font-bold text-[#0B2345]">Informasi pengajuan</p>
                        <p class="mt-1 text-sm leading-6 text-slate-700">
                            Setelah dikirim, pengajuan akan menunggu pemeriksaan petugas.
                            Kamu dapat memantau perkembangannya melalui halaman Status Peminjaman.
                        </p>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-between">
                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-5 py-3 font-bold text-slate-700 transition hover:bg-slate-100"
                        >
                            Kembali ke Dashboard
                        </a>

                        <button
                            type="submit"
                            @if (!isset($bukus) || $bukus->isEmpty()) disabled @endif
                            class="inline-flex items-center justify-center rounded-xl bg-[#1769AA] px-6 py-3 font-bold text-white transition hover:bg-blue-800 disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('peminjaman.saya.status') }}"
                   class="rounded-lg bg-white px-5 py-3 font-bold text-[#1769AA] shadow-sm ring-1 ring-slate-200 transition hover:bg-blue-50">
                    Lihat Status Peminjaman
                </a>

                <a href="{{ route('peminjaman.saya.riwayat') }}"
                   class="rounded-lg bg-white px-5 py-3 font-bold text-[#1769AA] shadow-sm ring-1 ring-slate-200 transition hover:bg-blue-50">
                    Lihat Riwayat
                </a>
            </div>

        </div>
    </div>
</x-app-layout>