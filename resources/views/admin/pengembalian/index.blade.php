<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Pengembalian Buku
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Notifikasi sukses --}}
                @if (session('success'))
                    <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Notifikasi error --}}
                @if (session('error'))
                    <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                <h3 class="text-lg font-semibold mb-4">
                    Daftar Peminjaman
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-3">No</th>
                                <th class="border p-3">Nama Anggota</th>
                                <th class="border p-3">Judul Buku</th>
                                <th class="border p-3">Tanggal Pinjam</th>
                                <th class="border p-3">Tanggal Kembali</th>
                                <th class="border p-3">Status</th>
                                <th class="border p-3">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($peminjamans as $peminjaman)
                                <tr class="text-center">
                                    <td class="border p-3">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $peminjaman->anggota->nama ?? '-' }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $peminjaman->buku->judul ?? '-' }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $peminjaman->tanggal_pinjam?->format('d-m-Y') ?? '-' }}
                                    </td>

                                    <td class="border p-3">
                                        {{ $peminjaman->tanggal_kembali?->format('d-m-Y') ?? 'Belum dikembalikan' }}
                                    </td>

                                    <td class="border p-3">
                                        @if ($peminjaman->status === 'dikembalikan')
                                            <span class="rounded bg-green-100 px-3 py-1 text-green-700">
                                                Dikembalikan
                                            </span>
                                        @elseif ($peminjaman->status === 'disetujui')
                                            <span class="rounded bg-yellow-100 px-3 py-1 text-yellow-700">
                                                Disetujui
                                            </span>
                                        @else
                                            <span class="rounded bg-gray-100 px-3 py-1 text-gray-700">
                                                {{ ucfirst($peminjaman->status) }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="border p-3">
                                        @if ($peminjaman->status === 'disetujui')
                                            <form
                                                action="{{ route('admin.pengembalian.update', $peminjaman->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin buku ini sudah dikembalikan?')"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="rounded bg-green-600 px-3 py-2 text-white hover:bg-green-700"
                                                >
                                                    Proses Pengembalian
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">
                                                -
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="border p-5 text-center text-gray-500">
                                        Belum ada data peminjaman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
