<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Header halaman --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-start gap-4">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#0B2345] text-[#FFB629] shadow-lg">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-2M8 5a2 2 0 002 2h4a2 2 0 002-2M8 5a2 2 0 012-2h4a2 2 0 012 2m-8 8h8m-8 4h8"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-700">
                            Administrasi Perpustakaan
                        </p>
                        <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-[#0B2345] sm:text-3xl">
                            Laporan Peminjaman
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">
                            Rekap jumlah peminjaman untuk setiap buku.
                        </p>
                    </div>
                </div>

                <button
                    id="tombolMuatUlang"
                    type="button"
                    onclick="muatLaporan()"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0B2345] px-5 py-3 text-sm font-bold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-[#1769AA] focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-60"
                >
                    <svg id="ikonMuatUlang" class="h-4 w-4 text-[#FFB629]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h5M20 20v-5h-5M5.6 9A7 7 0 0118 6l2 3M4 15l2 3a7 7 0 0012.4-3"/>
                    </svg>
                    <span id="teksMuatUlang">Muat Ulang</span>
                </button>
            </div>

            {{-- Banner --}}
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#0B2345] via-[#103B6B] to-[#1769AA] p-6 text-white shadow-lg sm:p-8">
                <div class="absolute right-0 top-0 h-full w-2 bg-[#FFB629]"></div>
                <div class="pointer-events-none absolute -right-10 -top-16 h-48 w-48 rounded-full border-[24px] border-white/5"></div>
                <div class="pointer-events-none absolute -bottom-20 right-32 h-44 w-44 rounded-full border-[20px] border-white/5"></div>

                <div class="relative z-10 max-w-2xl">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-blue-100">
                        <span class="h-2 w-2 rounded-full bg-[#FFB629]"></span>
                        RINGKASAN DATA
                    </span>

                    <h2 class="mt-4 text-2xl font-extrabold tracking-tight sm:text-3xl">
                        Pantau Aktivitas Peminjaman Buku
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-blue-100 sm:text-base">
                        Lihat jumlah judul buku dan total transaksi peminjaman
                        berdasarkan data yang tersedia di sistem.
                    </p>
                </div>
            </section>

            {{-- Statistik --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">
                    <div class="absolute left-0 top-0 h-full w-1 bg-[#FFB629]"></div>

                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Jumlah Judul Buku
                            </p>
                            <p id="totalJudul" aria-live="polite"
                               class="mt-3 text-4xl font-extrabold tracking-tight text-[#0B2345]">
                                —
                            </p>
                            <p class="mt-2 text-xs text-slate-500">
                                Judul yang tercatat dalam laporan
                            </p>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#0B2345] text-[#FFB629]">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M4 5.5A2.5 2.5 0 016.5 3H20v16H6.5A2.5 2.5 0 014 16.5v-11zM4 16.5A2.5 2.5 0 016.5 14H20M8 7h8m-8 3h5"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">
                    <div class="absolute left-0 top-0 h-full w-1 bg-[#1769AA]"></div>

                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Total Peminjaman
                            </p>
                            <p id="totalPeminjaman" aria-live="polite"
                               class="mt-3 text-4xl font-extrabold tracking-tight text-[#0B2345]">
                                —
                            </p>
                            <p class="mt-2 text-xs text-slate-500">
                                Akumulasi transaksi pada laporan
                            </p>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-[#1769AA]">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel laporan --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex flex-col gap-3 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="h-6 w-1 rounded-full bg-[#FFB629]"></span>
                            <h2 class="text-lg font-extrabold text-[#0B2345]">
                                Rekap Peminjaman per Buku
                            </h2>
                        </div>
                        <p class="mt-2 text-sm text-slate-500">
                            Daftar buku beserta jumlah transaksi peminjamannya.
                        </p>
                    </div>

                    <span id="statusLaporan"
                          class="inline-flex w-fit items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                        <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                        Menyiapkan laporan
                    </span>
                </div>

                <div id="pesan" class="hidden px-5 pt-4 text-sm" role="status" aria-live="polite"></div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[760px] text-left text-sm">
                        <thead class="bg-[#0B2345] text-xs uppercase tracking-wider text-blue-100">
                            <tr>
                                <th scope="col" class="px-5 py-4 font-bold">No.</th>
                                <th scope="col" class="px-5 py-4 font-bold">Judul Buku</th>
                                <th scope="col" class="px-5 py-4 font-bold">Kategori</th>
                                <th scope="col" class="px-5 py-4 font-bold">Penulis</th>
                                <th scope="col" class="px-5 py-4 text-center font-bold">
                                    Jumlah Peminjaman
                                </th>
                            </tr>
                        </thead>

                        <tbody id="isiLaporan" class="divide-y divide-slate-100">
                            <tr>
                                <td colspan="5" class="px-5 py-12 text-center text-slate-500">
                                    <span class="inline-flex items-center gap-3">
                                        <svg class="h-5 w-5 animate-spin text-[#1769AA]" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                                        </svg>
                                        Memuat data laporan...
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col gap-1 border-t border-slate-100 bg-slate-50 px-5 py-4 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <span>Rekap peminjaman koleksi perpustakaan</span>
                    <span class="font-medium text-slate-400">Sistem Informasi Perpustakaan</span>
                </div>
            </section>
        </div>
    </div>

    <script>
        let permintaanLaporan = null;

        async function muatLaporan() {
            const isiLaporan = document.getElementById('isiLaporan');
            const pesan = document.getElementById('pesan');
            const tombol = document.getElementById('tombolMuatUlang');
            const teksTombol = document.getElementById('teksMuatUlang');
            const status = document.getElementById('statusLaporan');
            const totalJudul = document.getElementById('totalJudul');
            const totalPeminjaman = document.getElementById('totalPeminjaman');

            if (permintaanLaporan) {
                permintaanLaporan.abort();
            }

            permintaanLaporan = new AbortController();

            tombol.disabled = true;
            teksTombol.textContent = 'Memuat...';
            pesan.className = 'hidden px-5 pt-4 text-sm';
            pesan.textContent = '';

            status.className = 'inline-flex w-fit items-center gap-2 rounded-full bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700';
            status.textContent = 'Memuat data';

            isiLaporan.innerHTML = `
                <tr>
                    <td colspan="5" class="px-5 py-12 text-center text-slate-500">
                        Memuat data laporan...
                    </td>
                </tr>
            `;

            try {
                const response = await fetch('/api/rekap/peminjaman-per-buku', {
                    headers: {
                        'Accept': 'application/json'
                    },
                    signal: permintaanLaporan.signal
                });

                if (!response.ok) {
                    throw new Error(
                        response.status === 401 || response.status === 403
                            ? 'Akses ke data laporan ditolak. Periksa autentikasi dan izin API.'
                            : 'Gagal mengambil data laporan (HTTP ' + response.status + ').'
                    );
                }

                const data = await response.json();

                if (!Array.isArray(data)) {
                    throw new Error('Format data laporan tidak sesuai.');
                }

                let total = 0;

                data.forEach(function (buku) {
                    const jumlah = Number(buku.peminjamans_count ?? 0);

                    if (Number.isFinite(jumlah) && jumlah > 0) {
                        total += jumlah;
                    }
                });

                totalJudul.textContent = data.length.toLocaleString('id-ID');
                totalPeminjaman.textContent = total.toLocaleString('id-ID');

                if (data.length === 0) {
                    isiLaporan.innerHTML = `
                        <tr>
                            <td colspan="5" class="px-5 py-14 text-center">
                                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-[#1769AA]">
                                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M4 5.5A2.5 2.5 0 016.5 3H20v16H6.5A2.5 2.5 0 014 16.5v-11z"/>
                                    </svg>
                                </div>
                                <p class="mt-4 font-bold text-slate-700">Belum ada data buku</p>
                                <p class="mt-1 text-sm text-slate-500">Data akan tampil setelah tersedia di sistem.</p>
                            </td>
                        </tr>
                    `;
                } else {
                    isiLaporan.innerHTML = data.map(function (buku, index) {
                        const jumlahRaw = Number(buku.peminjamans_count ?? 0);
                        const jumlah = Number.isFinite(jumlahRaw) && jumlahRaw > 0
                            ? jumlahRaw
                            : 0;

                        const judul = buku.judul ?? buku.judul_buku ?? '-';
                        const kategori = buku.kategori?.nama ?? '-';
                        const penulis = buku.penulis ?? '-';

                        return `
                            <tr class="transition-colors duration-150 hover:bg-blue-50/50">
                                <td class="whitespace-nowrap px-5 py-4 text-slate-400">
                                    ${index + 1}
                                </td>
                                <td class="px-5 py-4 font-bold text-slate-800">
                                    ${aman(judul)}
                                </td>
                                <td class="px-5 py-4 text-slate-600">
                                    ${aman(kategori)}
                                </td>
                                <td class="px-5 py-4 text-slate-600">
                                    ${aman(penulis)}
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-center">
                                    <span class="inline-flex min-w-10 items-center justify-center rounded-full bg-blue-50 px-3 py-1.5 font-bold text-[#1769AA] ring-1 ring-inset ring-blue-100">
                                        ${jumlah.toLocaleString('id-ID')}
                                    </span>
                                </td>
                            </tr>
                        `;
                    }).join('');
                }

                status.className = 'inline-flex w-fit items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700';
                status.innerHTML = '<span class="h-2 w-2 rounded-full bg-emerald-500"></span> Laporan diperbarui';

            } catch (error) {
                if (error.name === 'AbortError') {
                    return;
                }

                totalJudul.textContent = '—';
                totalPeminjaman.textContent = '—';

                isiLaporan.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center">
                            <div class="font-bold text-red-700">Laporan gagal dimuat</div>
                            <p class="mt-2 text-sm text-slate-500">
                                Periksa koneksi dan endpoint API laporan peminjaman.
                            </p>
                        </td>
                    </tr>
                `;

                pesan.className = 'mx-5 mb-4 mt-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700';
                pesan.textContent = error.message;

                status.className = 'inline-flex w-fit items-center gap-2 rounded-full bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700';
                status.innerHTML = '<span class="h-2 w-2 rounded-full bg-red-500"></span> Gagal memuat';
            } finally {
                if (permintaanLaporan && !permintaanLaporan.signal.aborted) {
                    tombol.disabled = false;
                    teksTombol.textContent = 'Muat Ulang';
                    permintaanLaporan = null;
                }
            }
        }

        function aman(nilai) {
            const elemen = document.createElement('span');
            elemen.textContent = String(nilai ?? '-');
            return elemen.innerHTML;
        }

        document.addEventListener('DOMContentLoaded', muatLaporan);
    </script>
</x-app-layout>