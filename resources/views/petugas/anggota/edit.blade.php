
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Anggota
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="rounded-xl border border-green-100 bg-white p-6 shadow-sm">
                <form action="{{ route('petugas.anggota.update', $anggota) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nama" class="mb-2 block font-medium text-gray-700">
                            Nama Anggota
                        </label>
                        <input type="text" id="nama" name="nama"
                               value="{{ old('nama', $anggota->nama) }}" required
                               class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="mb-2 block font-medium text-gray-700">
                            Email
                        </label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email', $anggota->email) }}" required
                               class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="no_telepon" class="mb-2 block font-medium text-gray-700">
                            Nomor Telepon
                        </label>
                        <input type="text" id="no_telepon" name="no_telepon"
                               value="{{ old('no_telepon', $anggota->no_telepon) }}"
                               class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        @error('no_telepon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('petugas.anggota.index') }}"
                           class="rounded-lg border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">
                            Batal
                        </a>
                        <button type="submit"
                                class="rounded-lg bg-green-600 px-4 py-2 font-semibold text-white hover:bg-green-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
