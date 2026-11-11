<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-[#0B2345]">
            Ajukan Peminjaman Buku
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="bg-gradient-to-r from-[#0B2345] to-[#1769AA] p-6 text-white">
                    <h3 class="text-lg font-bold">Form Pengajuan Buku</h3>
                    <p class="mt-1 text-sm text-blue-100">
                        Pilih buku yang ingin kamu pinjam.
                    </p>
                </div>

                <form action="{{ route('peminjaman.saya.store') }}"
                      method="POST"
                      class="space-y-6 p-6">
                    @csrf

                    <div>
                        <label for="buku_id" class="mb-2 block text-sm font-semibold text-slate-700">
                            Pilih Buku
                        </label>

                        <select
                            id="buku_id"
                            name="buku_id"
                            required
                            class="w-full rounded-xl border-slate-300 focus:border-[#1769AA] focus:ring-[#1769AA]"
                        >
                            <option value="">-- Pilih buku --</option>

                            @forelse ($bukus as $buku)
                                <option value="{{ $buku->id }}"
                                    {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                                    {{ $buku->judul }} — {{ $buku->penulis }}
                                    (Stok: {{ $buku->stok }})
                                </option>
                            @empty
                                <option value="" disabled>Tidak ada buku yang tersedia</option>
                            @endforelse
                        </select>

                        @if ($bukus->isEmpty())
                            <p class="mt-2 text-sm text-amber-700">
                                Saat ini belum ada buku dengan stok tersedia.
                            </p>
                        @endif
                    </div>

                    <div class="flex flex-wrap justify-end gap-3">
                        <a href="{{ route('siswa.dashboard') }}"
                           class="rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Kembali
                        </a>

                        <button
                            type="submit"
                            @disabled($bukus->isEmpty())
                            class="rounded-xl bg-[#1769AA] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#0B2345] disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            Ajukan Peminjaman
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>