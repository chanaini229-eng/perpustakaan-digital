<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-[#0B2345]">
            Status Peminjaman Saya
        </h2>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <section class="rounded-2xl bg-gradient-to-r from-[#0B2345] to-[#1769AA] p-6 text-white shadow-lg sm:p-8">
                <p class="text-xs font-bold uppercase tracking-widest text-[#FFB629]">
                    Layanan Sirkulasi
                </p>
                <h1 class="mt-2 text-2xl font-extrabold sm:text-3xl">
                    Pantau Pengajuanmu
                </h1>
                <p class="mt-2 text-sm text-blue-100">
                    Lihat pengajuan, keputusan petugas, dan status peminjaman buku.
                </p>
                <a href="{{ route('peminjaman.saya.create') }}"
                   class="mt-5 inline-flex rounded-xl bg-[#FFB629] px-5 py-3 text-sm font-bold text-[#0B2345] hover:bg-amber-300">
                    + Ajukan Buku
                </a>
            </section>

            <section class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                @php
                    $semuaData = $peminjamans->getCollection();
                    $jumlahMenunggu = $semuaData->where('status', 'menunggu')->count();
                    $jumlahDisetujui = $semuaData->where('status', 'disetujui')->count();
                    $jumlahDitolak = $semuaData->where('status', 'ditolak')->count();
                @endphp

                <div class="rounded-2xl border border-amber-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-semibold text-amber-700">Menunggu</p>
                    <p class="mt-2 text-3xl font-extrabold text-amber-800">
                        {{ $jumlahMenunggu }}
                    </p>
                </div>

                <div class="rounded-2xl border border-blue-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-semibold text-blue-700">Disetujui</p>
                    <p class="mt-2 text-3xl font-extrabold text-blue-800">
                        {{ $jumlahDisetujui }}
                    </p>
                </div>

                <div class="rounded-2xl border border-red-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-semibold text-red-700">Ditolak</p>
                    <p class="mt-2 text-3xl font-extrabold text-red-800">
                        {{ $jumlahDitolak }}
                    </p>
                </div>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-lg font-extrabold text-[#0B2345]">
                        Daftar Pengajuan dan Peminjaman
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Data yang ditampilkan hanya milik akunmu.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-[#0B2345] text-white">
                            <tr>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase">No.</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase">Informasi Buku</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase">Tanggal Pinjam</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase">Tanggal Kembali</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($peminjamans as $peminjaman)
                                @php
                                    $status = strtolower($peminjaman->status ?? 'menunggu');

                                    [$labelStatus, $warnaStatus] = match ($status) {
                                        'menunggu' => ['Menunggu Persetujuan', 'bg-amber-100 text-amber-800'],
                                        'disetujui' => ['Disetujui', 'bg-blue-100 text-blue-800'],
                                        'ditolak' => ['Ditolak', 'bg-red-100 text-red-800'],
                                        'dikembalikan' => ['Sudah Dikembalikan', 'bg-emerald-100 text-emerald-800'],
                                        default => [ucfirst($status), 'bg-slate-100 text-slate-700'],
                                    };
                                @endphp

                                <tr class="transition hover:bg-blue-50/50">
                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                        {{ $peminjamans->firstItem() + $loop->index }}
                                    </td>

                                    <td class="px-5 py-4">
                                        <p class="font-bold text-[#0B2345]">
                                            {{ $peminjaman->buku->judul ?? 'Buku tidak ditemukan' }}
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            Penulis: {{ $peminjaman->buku->penulis ?? '-' }}
                                        </p>
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                        {{ $peminjaman->tanggal_pinjam ? \Illuminate\Support\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y') : '-' }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                        {{ $peminjaman->tanggal_kembali ? \Illuminate\Support\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y') : 'Belum ditentukan' }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4">
                                        <span class="inline-flex rounded-full px-3 py-1.5 text-xs font-bold {{ $warnaStatus }}">
                                            {{ $labelStatus }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-14 text-center">
                                        <div class="text-lg font-bold text-[#0B2345]">
                                            Belum Ada Pengajuan
                                        </div>
                                        <p class="mt-2 text-sm text-slate-500">
                                            Buku yang kamu ajukan akan muncul di halaman ini.
                                        </p>
                                        <a href="{{ route('peminjaman.saya.create') }}"
                                           class="mt-5 inline-flex rounded-xl bg-[#1769AA] px-5 py-3 text-sm font-bold text-white hover:bg-[#0B2345]">
                                            Ajukan Buku
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($peminjamans->hasPages())
                    <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">
                        {{ $peminjamans->links() }}
                    </div>
                @endif
            </section>

            <div>
                <a href="{{ route('siswa.dashboard') }}"
                   class="text-sm font-semibold text-[#1769AA] hover:underline">
                    &larr; Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>