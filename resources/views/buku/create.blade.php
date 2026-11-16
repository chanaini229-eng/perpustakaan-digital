
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-2xl mx-auto py-10 px-4">

        <div class="bg-white rounded-xl shadow p-8">

            <h1 class="text-2xl font-bold text-gray-800 mb-2">
                Tambah Buku
            </h1>

            <p class="text-gray-500 mb-6">
                Masukkan informasi buku baru.
            </p>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('buku.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Judul Buku
                    </label>
                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul') }}"
                        required
                        class="w-full border rounded-lg p-3"
                        placeholder="Masukkan judul buku"
                    >
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Penulis
                    </label>
                    <input
                        type="text"
                        name="penulis"
                        value="{{ old('penulis') }}"
                        required
                        class="w-full border rounded-lg p-3"
                        placeholder="Masukkan nama penulis"
                    >
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Kategori
                    </label>
                    <select
                        name="kategori_id"
                        required
                        class="w-full border rounded-lg p-3"
                    >
                        <option value="">Pilih kategori</option>

                        @foreach ($kategoris as $kategori)
                            <option
                                value="{{ $kategori->id }}"
                                {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}
                            >
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-2">
                        Tahun Terbit
                    </label>
                    <input
                        type="number"
                        name="tahun_terbit"
                        value="{{ old('tahun_terbit') }}"
                        min="1900"
                        required
                        class="w-full border rounded-lg p-3"
                        placeholder="Contoh: 2024"
                    >
                </div>

                <div class="mb-6">
                    <label class="block font-semibold mb-2">
                        Stok
                    </label>
                    <input
                        type="number"
                        name="stok"
                        value="{{ old('stok', 0) }}"
                        min="0"
                        required
                        class="w-full border rounded-lg p-3"
                        placeholder="Masukkan jumlah stok"
                    >
                </div>

                <div class="flex gap-3">
                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg"
                    >
                        Simpan Buku
                    </button>

                    <a
                        href="{{ route('buku.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-lg"
                    >
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
