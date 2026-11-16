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

            {{-- Pesan berhasil --}}
            @if (session('success'))
                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-semibold text-green-700">
                    {{ session('success') }}
                </div>
            @endif

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

                        <div class="flex flex-wrap gap-2">

                            {{-- Tombol tambah khusus admin dan petugas --}}
                            @can('kelola-buku')
                                <a href="{{ route('buku.create') }}"
                                   class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-extrabold text-white transition hover:bg-blue-700">
                                    + Tambah Buku
                                </a>
                            @endcan

                            {{-- Tombol peminjaman --}}
                            @if (auth()->user()->can('mengajukan peminjaman buku'))
                                <a href="{{ route('peminjaman.saya.create') }}"
                                   class="inline-flex items-center justify-center rounded-xl bg-amber-400 px-5 py-3 text-sm font-extrabold text-[#0B2345] transition hover:bg-amber-500">
                                    + Ajukan Peminjaman
                                </a>
                            @endif

                        </div>
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

                {{-- Tabel buku --}}
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

                                @can('kelola-buku')
                                    <th class="whitespace-nowrap px-5 py-4 text-center text-xs font-bold uppercase tracking-wider text-white">
                                        Aksi
                                    </th>
                                @endcan
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
                                            {!! $buku->judul !!}
                                            <!-- <script>alert('XSS')</script> -->
                                            <!-- {{ $buku->judul }} -->
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

                                    {{-- Aksi khusus admin dan petugas --}}
                                    @can('kelola-buku')
                                        <td class="whitespace-nowrap px-5 py-4">
                                            <div class="flex justify-center gap-2">

                                                <a href="{{ route('buku.edit', $buku->id) }}"
                                                   class="rounded-lg bg-amber-100 px-3 py-2 text-xs font-bold text-amber-700 hover:bg-amber-200">
                                                    Edit
                                                </a>

                                                <form action="{{ route('buku.destroy', $buku->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="rounded-lg bg-red-100 px-3 py-2 text-xs font-bold text-red-700 hover:bg-red-200">
                                                        Hapus
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    @endcan

                                </tr>

                            @empty
                                <tr id="baris-kosong">
                                    <td colspan="{{ auth()->user()->can('kelola-buku') ? 7 : 6 }}"
                                        class="px-6 py-12 text-center">

                                        <div class="text-4xl">📖</div>

                                        <p class="mt-3 font-bold text-slate-700">
                                            Belum ada buku di katalog
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Koleksi buku akan tampil di sini setelah ditambahkan.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse

                            <tr id="hasil-tidak-ada" class="hidden">
                                <td colspan="{{ auth()->user()->can('kelola-buku') ? 7 : 6 }}"
                                    class="px-5 py-10 text-center text-sm text-slate-500">
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
                    @can('kelola-buku')
                        Pengelolaan koleksi buku dapat dilakukan oleh admin dan petugas.
                    @else
                        Katalog hanya untuk melihat informasi buku dan mengajukan peminjaman.
                    @endcan
                </div>

            </div>

            {{-- Navigasi --}}
            <div class="mt-6 flex flex-wrap gap-3">

                @if (auth()->user()->can('melihat status peminjaman sendiri'))
                    <a href="{{ route('peminjaman.saya.status') }}"
                       class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-[#1769AA] transition hover:bg-blue-50">
                        Status Peminjaman
                    </a>
                @endif

                @if (auth()->user()->can('melihat riwayat peminjaman sendiri'))
                    <a href="{{ route('peminjaman.saya.riwayat') }}"
                       class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-[#1769AA] transition hover:bg-blue-50">
                        Riwayat Peminjaman
                    </a>
                @endif

            </div>

        </div>
    </div>

    {{-- JavaScript pencarian --}}
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
