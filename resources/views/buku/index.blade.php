
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-500">
                    Perpustakaan · Katalog
                </p>
                <h2 class="mt-1 text-xl font-extrabold text-[#0B2345]">
                    Daftar Buku
                </h2>
            </div>

            <div class="grid h-12 w-12 place-items-center rounded-xl border border-blue-100 bg-blue-50 text-2xl">
                📚
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Banner --}}
            <div class="mb-7 overflow-hidden rounded-2xl bg-gradient-to-r from-[#0B2345] via-[#123B68] to-[#1769AA] p-6 text-white shadow-lg sm:p-8">
                <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-amber-300">
                    Jelajahi Koleksi
                </p>

                <h1 class="mt-3 text-2xl font-extrabold sm:text-3xl">
                    Temukan Buku Favoritmu
                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-6 text-blue-100 sm:text-base">
                    Jelajahi koleksi buku perpustakaan, cari berdasarkan judul,
                    penulis, atau kategori, lalu ajukan peminjaman jika buku tersedia.
                </p>
            </div>

            {{-- Ringkasan --}}
            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Jumlah Judul Buku</p>
                    <p class="mt-2 text-3xl font-extrabold text-[#0B2345]">
                        {{ $bukus->count() }}
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Kategori Buku</p>
                    <p class="mt-2 text-3xl font-extrabold text-[#1769AA]">
                        {{ $bukus->pluck('kategori_id')->filter()->unique()->count() }}
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Total Stok Buku</p>
                    <p class="mt-2 text-3xl font-extrabold text-amber-600">
                        {{ $bukus->sum('stok') }}
                    </p>
                </div>
            </div>

            {{-- Katalog --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-5 sm:px-6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-lg font-extrabold text-[#0B2345]">
                                Katalog Buku
                            </h2>
                            <p class="mt-1 text-sm text-slate-500">
                                Informasi koleksi buku yang tersedia di perpustakaan.
                            </p>
                        </div>

                        <a href="{{ route('peminjaman.saya.create') }}"
                           class="inline-flex items-center justify-center rounded-xl bg-amber-400 px-5 py-3 text-sm font-extrabold text-[#0B2345] transition hover:bg-amber-500">
                            + Ajukan Peminjaman
                        </a>
                    </div>

                    {{-- Pencarian --}}
                    <div class="mt-5">
                        <label for="cari-buku" class="mb-2 block text-sm font-bold text-slate-700">
                            Cari buku
                        </label>

                        <input
                            type="search"
                            id="cari-buku"
                            placeholder="Ketik judul, penulis, atau kategori..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-[#1769AA] focus:ring-2 focus:ring-blue-100"
                        >
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-[#0B2345]">
                            <tr>
                                <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-white">
                                    No.
                                </th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-white">
                                    Judul Buku
                                </th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-white">
                                    Penulis
                                </th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-white">
                                    Kategori
                                </th>
                                <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-white">
                                    Tahun Terbit
                                </th>
                                <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-white">
                                    Stok
                                </th>
                            </tr>
                        </thead>

                        <tbody id="tabel-buku" class="divide-y divide-slate-100">
                            @forelse ($bukus as $buku)
                                <tr class="baris-buku transition hover:bg-blue-50">
                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-5 py-4">
                                        <p class="font-bold text-[#0B2345]">
                                            {{ $buku->judul }}
                                        </p>
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                        {{ $buku->penulis ?: '-' }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-sm">
                                        <span class="inline-flex rounded-lg border border-blue-100 bg-blue-50 px-3 py-1.5 font-semibold text-[#1769AA]">
                                            {{ $buku->kategori->nama ?? 'Tanpa kategori' }}
                                        </span>
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                        {{ $buku->tahun_terbit ?: '-' }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4">
                                        @if ($buku->stok > 0)
                                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                                Tersedia: {{ $buku->stok }}
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                                                Stok habis
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr id="baris-kosong">
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="text-4xl">📖</div>
                                        <p class="mt-3 font-bold text-slate-700">
                                            Belum ada buku di katalog
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            Koleksi buku akan tampil di sini setelah ditambahkan oleh petugas.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse

                            <tr id="hasil-tidak-ada" class="hidden">
                                <td colspan="6" class="px-5 py-10 text-center text-sm text-slate-500">
                                    Tidak ada buku yang cocok dengan pencarian.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                @if (method_exists($bukus, 'links') && $bukus->hasPages())
                    <div class="border-t border-slate-200 px-5 py-4 sm:px-6">
                        {{ $bukus->links() }}
                    </div>
                @endif

                <div class="border-t border-slate-100 bg-slate-50 px-5 py-4 text-xs text-slate-500 sm:px-6">
                    Katalog hanya untuk melihat informasi buku. Pengelolaan koleksi dilakukan oleh admin atau petugas.
                </div>
            </div>

            {{-- Navigasi --}}
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('peminjaman.saya.status') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-[#1769AA] transition hover:bg-blue-50">
                    Status Peminjaman
                </a>

                <a href="{{ route('peminjaman.saya.riwayat') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-[#1769AA] transition hover:bg-blue-50">
                    Riwayat Peminjaman
                </a>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pencarian = document.getElementById('cari-buku');
            const baris = Array.from(document.querySelectorAll('.baris-buku'));
            const pesanKosong = document.getElementById('hasil-tidak-ada');

            if (!pencarian) return;

            pencarian.addEventListener('input', function () {
                const kata = this.value.trim().toLocaleLowerCase('id');
                let jumlahTampil = 0;

                baris.forEach(function (tr) {
                    const cocok = tr.textContent.toLocaleLowerCase('id').includes(kata);
                    tr.classList.toggle('hidden', !cocok);

                    if (cocok) jumlahTampil++;
                });

                if (pesanKosong) {
                    pesanKosong.classList.toggle('hidden', jumlahTampil > 0);
                }
            });
        });
    </script>
</x-app-layout>
