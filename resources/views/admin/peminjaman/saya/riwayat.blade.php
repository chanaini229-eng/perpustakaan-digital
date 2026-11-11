<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8 overflow-hidden rounded-2xl bg-[#0B2345] p-6 text-white shadow-lg sm:p-8">
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-amber-400">
                    Perpustakaan
                </p>

                <h1 class="mt-3 text-2xl font-extrabold sm:text-3xl">
                    Riwayat Peminjaman Saya
                </h1>

                <p class="mt-2 text-sm text-slate-200 sm:text-base">
                    Lihat daftar buku yang pernah kamu pinjam dan sudah dikembalikan.
                </p>
            </div>

            {{-- Filter riwayat --}}
            @php
                $riwayat = $peminjamans->getCollection()->filter(function ($item) {
                    return $item->tanggal_kembali !== null
                        || $item->status === 'dikembalikan';
                });
            @endphp

            {{-- Ringkasan --}}
            <div class="mb-6 grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-xl">
                            📚
                        </div>

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Riwayat di Halaman Ini
                            </p>

                            <p class="mt-1 text-3xl font-extrabold text-[#0B2345]">
                                {{ $riwayat->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100 text-xl">
                            ✓
                        </div>

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Keterangan
                            </p>

                            <p class="mt-1 font-bold text-[#0B2345]">
                                Buku yang sudah dikembalikan
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel riwayat --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex flex-col gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-lg font-extrabold text-[#0B2345]">
                            Daftar Riwayat Buku
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Data peminjaman milik akun kamu.
                        </p>
                    </div>

                    <a href="{{ route('peminjaman.saya.status') }}"
                       class="inline-flex items-center justify-center rounded-lg bg-[#1769AA] px-4 py-2.5 text-sm font-bold text-white transition hover:bg-blue-800">
                        Lihat Status Peminjaman
                    </a>
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

                                <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-white">
                                    Tanggal Pinjam
                                </th>

                                <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-white">
                                    Tanggal Kembali
                                </th>

                                <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-white">
                                    Status
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($riwayat as $item)
                                <tr class="transition hover:bg-blue-50">
                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                        {{ $loop->iteration + (($peminjamans->currentPage() - 1) * $peminjamans->perPage()) }}
                                    </td>

                                    <td class="px-5 py-4">
                                        <p class="font-bold text-slate-800">
                                            {{ $item->buku->judul ?? 'Buku tidak tersedia' }}
                                        </p>

                                        @if (!empty($item->buku->penulis))
                                            <p class="mt-1 text-xs text-slate-500">
                                                Penulis: {{ $item->buku->penulis }}
                                            </p>
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                        {{ $item->tanggal_pinjam
                                            ? \Illuminate\Support\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y')
                                            : '-' }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                        {{ $item->tanggal_kembali
                                            ? \Illuminate\Support\Carbon::parse($item->tanggal_kembali)->format('d-m-Y')
                                            : '-' }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4">
                                        <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                            Dikembalikan
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-14 text-center">
                                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-50 text-3xl">
                                            📖
                                        </div>

                                        <h3 class="mt-4 text-lg font-bold text-slate-800">
                                            Belum Ada Riwayat Peminjaman
                                        </h3>

                                        <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                                            Buku yang sudah dikembalikan akan muncul di halaman ini.
                                        </p>

                                        <a href="{{ route('peminjaman.saya.create') }}"
                                           class="mt-5 inline-flex items-center justify-center rounded-lg bg-amber-400 px-5 py-3 font-bold text-[#0B2345] transition hover:bg-amber-500">
                                            Ajukan Peminjaman Buku
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($peminjamans->hasPages())
                    <div class="border-t border-slate-200 px-6 py-4">
                        {{ $peminjamans->links() }}
                    </div>
                @endif
            </div>

            {{-- Navigasi bawah --}}
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('peminjaman.saya.create') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-amber-400 px-5 py-3 font-bold text-[#0B2345] transition hover:bg-amber-500">
                    + Ajukan Peminjaman
                </a>

                <a href="{{ route('peminjaman.saya.status') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-[#1769AA] px-5 py-3 font-bold text-white transition hover:bg-blue-800">
                    Status Peminjaman
                </a>

                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-3 font-bold text-slate-700 transition hover:bg-slate-100">
                    Kembali ke Dashboard
                </a>
            </div>

        </div>
    </div>
</x-app-layout>