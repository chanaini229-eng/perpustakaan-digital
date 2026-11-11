<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-[#0B2345]">
            Status Peminjaman Saya
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 rounded-2xl bg-gradient-to-r from-[#0B2345] to-[#1769AA] p-6 text-white shadow-sm">
                <h3 class="text-xl font-bold">Pantau Pengajuanmu</h3>
                <p class="mt-2 text-sm text-blue-100">
                    Pantau pengajuan peminjaman dan keputusan petugas.
                </p>
            </div>

            {{-- Ringkasan jumlah peminjaman --}}
            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">
                    <p class="text-sm font-medium text-amber-700">Menunggu</p>
                    <p class="mt-2 text-2xl font-bold text-amber-800">
                        {{ $peminjamans->getCollection()->where('status', 'menunggu')->count() }}
                    </p>
                </div>

                <div class="rounded-2xl border border-blue-200 bg-blue-50 p-5">
                    <p class="text-sm font-medium text-blue-700">Disetujui</p>
                    <p class="mt-2 text-2xl font-bold text-blue-800">
                        {{ $peminjamans->getCollection()->where('status', 'disetujui')->count() }}
                    </p>
                </div>

                <div class="rounded-2xl border border-red-200 bg-red-50 p-5">
                    <p class="text-sm font-medium text-red-700">Ditolak</p>
                    <p class="mt-2 text-2xl font-bold text-red-800">
                        {{ $peminjamans->getCollection()->where('status', 'ditolak')->count() }}
                    </p>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="border-b border-slate-200 p-5">
                    <h3 class="font-bold text-[#0B2345]">
                        Daftar Pengajuan dan Peminjaman
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Data yang ditampilkan hanya milik akunmu.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase text-slate-600">No.</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase text-slate-600">Judul Buku</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase text-slate-600">Tanggal Pinjam</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase text-slate-600">Tanggal Kembali</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase text-slate-600">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($peminjamans as $peminjaman)
                                @php
                                    $status = strtolower($peminjaman->status ?? 'menunggu');

                                    $warna = match ($status) {
                                        'menunggu' => 'bg-amber-100 text-amber-800',
                                        'disetujui' => 'bg-blue-100 text-blue-800',
                                        'ditolak' => 'bg-red-100 text-red-800',
                                        'dikembalikan' => 'bg-emerald-100 text-emerald-800',
                                        default => 'bg-slate-100 text-slate-700',
                                    };

                                    $labelStatus = match ($status) {
                                        'menunggu' => 'Menunggu Persetujuan',
                                        'disetujui' => 'Disetujui',
                                        'ditolak' => 'Ditolak',
                                        'dikembalikan' => 'Sudah Dikembalikan',
                                        default => ucfirst($status),
                                    };

                                    $tanggalPinjam = $peminjaman->tanggal_pinjam;
                                    $tanggalKembali = $peminjaman->tanggal_kembali;
                                @endphp

                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                        {{ $peminjamans->firstItem() + $loop->index }}
                                    </td>

                                    <td class="px-5 py-4">
                                        <p class="text-sm font-semibold text-slate-800">
                                            {{ $peminjaman->buku->judul ?? 'Buku tidak tersedia' }}
                                        </p>
                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ $peminjaman->buku->penulis ?? 'Penulis tidak tersedia' }}
                                        </p>
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                        @if ($tanggalPinjam)
                                            {{ \Illuminate\Support\Carbon::parse($tanggalPinjam)->format('d-m-Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                        @if ($tanggalKembali)
                                            {{ \Illuminate\Support\Carbon::parse($tanggalKembali)->format('d-m-Y') }}
                                        @else
                                            <span class="text-slate-400">Belum ditentukan</span>
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $warna }}">
                                            {{ $labelStatus }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-12 text-center">
                                        <p class="font-semibold text-slate-700">
                                            Belum ada pengajuan peminjaman.
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            Silakan ajukan buku untuk melihat statusnya di sini.
                                        </p>
                                        <a href="{{ route('peminjaman.saya.create') }}"
                                           class="mt-4 inline-flex rounded-xl bg-[#1769AA] px-4 py-2 text-sm font-bold text-white transition hover:bg-[#0B2345]">
                                            Ajukan Buku
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($peminjamans->hasPages())
                    <div class="border-t border-slate-200 p-4">
                        {{ $peminjamans->links() }}
                    </div>
                @endif
            </div>

            <div class="mt-5">
                <a href="{{ route('siswa.dashboard') }}"
                   class="text-sm font-semibold text-[#1769AA] hover:underline">
                    &larr; Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
