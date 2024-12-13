<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pengaduan</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @media print {
            aside, footer {
                display: none;
            }

            table {
                width: 100%;
                table-layout: fixed;
            }

            th {
                background-color: #2d3748;
                color: white;
                text-align: center;
                padding: 8px;
            }

            td, th {
                word-wrap: break-word;
            }

            th, td {
                padding: 10px;
            }

            td:nth-child(6), td:nth-child(9), th:nth-child(6), th:nth-child(9) {
                width: 20%;
            }

            .text-sm {
                font-size: 10px;
            }

            body {
                margin: 2cm;
            }

            .overflow-x-auto {
                overflow-x: visible;
            }
        }

        body {
            margin: 0;
            padding: 0;
        }

        table {
            page-break-inside: avoid;
            table-layout: auto;
        }

        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        aside {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 20%;
            background-color: #2c3e50;
            color: white;
            overflow-y: auto;
        }

        main {
            margin-left: 20%;
            padding: 2rem;
            overflow-y: auto;
            height: 100vh;
        }

        .logo img {
            width: 60%;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <aside class="w-1/5 bg-blue-900 text-white h-screen p-6 fixed top-0 left-0">
            <div class="logo mb-6">
            <img src="{{ asset('img/suarakita.jpg') }}" alt="Logo">
            </div>
            <nav>
                <ul>
                    <li class="mb-6">
                        <a href="/admindashboard" class="flex items-center px-6 py-3 text-white bg-blue-800 rounded-lg mb-2">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                        <a href="/verifikasi" class="flex items-center px-6 py-3 text-white hover:bg-blue-800 rounded-lg mb-2">
                            <i class="fas fa-check-circle mr-3"></i>
                            Verifikasi Pengaduan
                        </a>
                        <div class="relative">
                            <button onclick="toggleDropdown('data-menu')" class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-blue-700">
                                <span><i class="fa-solid fa-database mr-2"></i> Data</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>
                            <div id="data-menu" class="hidden flex-col mt-2 bg-blue-800 rounded shadow-lg">
                                <a href="/petugas" class="block px-8 py-2 hover:bg-blue-700">Data Petugas</a>
                                <a href="/datawarga" class="block px-8 py-2 hover:bg-blue-700">Data Warga</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="w-4/5 p-8 ml-1/5">
            <h1 class="text-2xl font-bold mb-6">Verifikasi Pengaduan</h1>

            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
            @endif

            <button onclick="window.print()" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 mb-4">
                <i class="fas fa-print"></i> Print Halaman
            </button>

            <form method="GET" action="{{ route('verifikasi.index') }}">
            <select name="kategori" class="border rounded px-3 py-2">
    <option value="">-- Pilih Kategori Pengaduan --</option>
    <option value="Lingkungan" {{ old('kategori', request('kategori')) == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
    <option value="Keamanan" {{ old('kategori', request('kategori')) == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
    <option value="Infrastruktur" {{ old('kategori', request('kategori')) == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
    <option value="Kesehatan" {{ old('kategori', request('kategori')) == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
</select>

<select name="waktu" class="border rounded px-3 py-2 ml-2">
    <option value="">-- Pilih Waktu --</option>
    <option value="minggu_ini" {{ old('waktu', request('waktu')) == 'minggu_ini' ? 'selected' : '' }}>This Week</option>
    <option value="january" {{ old('waktu', request('waktu')) == 'january' ? 'selected' : '' }}>January</option>
    <option value="february" {{ old('waktu', request('waktu')) == 'february' ? 'selected' : '' }}>February</option>
    <option value="march" {{ old('waktu', request('waktu')) == 'march' ? 'selected' : '' }}>March</option>
    <option value="april" {{ old('waktu', request('waktu')) == 'april' ? 'selected' : '' }}>April</option>
    <option value="may" {{ old('waktu', request('waktu')) == 'may' ? 'selected' : '' }}>May</option>
    <option value="june" {{ old('waktu', request('waktu')) == 'june' ? 'selected' : '' }}>June</option>
    <option value="july" {{ old('waktu', request('waktu')) == 'july' ? 'selected' : '' }}>July</option>
    <option value="august" {{ old('waktu', request('waktu')) == 'august' ? 'selected' : '' }}>August</option>
    <option value="september" {{ old('waktu', request('waktu')) == 'september' ? 'selected' : '' }}>September</option>
    <option value="october" {{ old('waktu', request('waktu')) == 'october' ? 'selected' : '' }}>October</option>
    <option value="november" {{ old('waktu', request('waktu')) == 'november' ? 'selected' : '' }}>November</option>
    <option value="december" {{ old('waktu', request('waktu')) == 'december' ? 'selected' : '' }}>December</option>
</select>



    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Terapkan</button>
</form>


            <div class="overflow-x-auto bg-white rounded shadow mt-4">
                <table class="w-full border border-gray-300 text-sm text-left">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-center">No</th>
                            <th class="border border-gray-300 px-4 py-2">Nama Pengadu</th>
                            <th class="border border-gray-300 px-4 py-2">Kategori Pengaduan</th>
                            <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Tanggal Pengaduan</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Nama Petugas</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Tanggal Dikerjakan</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Umur (Hari)</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Status</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengaduan as $key => $item)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $key + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->nama }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->kategori_pengaduan }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->deskripsi }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ \Carbon\Carbon::parse($item->tanggal_pengaduan)->format('Y-m-d') }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <form action="{{ route('update-status', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="nama_petugas" class="bg-white border rounded px-2 py-1 w-full">
                                            <option value="" {{ !$item->nama_petugas ? 'selected' : '' }}>Pilih Petugas</option>
                                            @foreach ($petugas as $petugasItem)
                                                <option value="{{ $petugasItem->nama }}" {{ $item->nama_petugas == $petugasItem->nama ? 'selected' : '' }}>{{ $petugasItem->nama }}</option>
                                            @endforeach
                                        </select>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <input type="date" name="tanggal_dikerjakan" value="{{ $item->tanggal_dikerjakan ? \Carbon\Carbon::parse($item->tanggal_dikerjakan)->format('Y-m-d') : '' }}" class="bg-white border rounded px-2 py-1 w-full">
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    {{ round(\Carbon\Carbon::parse($item->tanggal_pengaduan)->diffInDays(now())) }} Hari
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <select name="status" class="bg-white border border-gray-300 rounded px-2 py-1 w-full">
                                        <option value="belum_dikerjakan" {{ $item->status == 'belum_dikerjakan' ? 'selected' : '' }}>Belum Dikerjakan</option>
                                        <option value="sedang_dikerjakan" {{ $item->status == 'sedang_dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                                        <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center p-4">Tidak ada pengaduan yang dapat diverifikasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $pengaduan->links() }}
            </div>

        </main>
    </div>

    <script>
        function toggleDropdown(menuId) {
            const menu = document.getElementById(menuId);
            menu.classList.toggle('hidden');
        }
    </script>
</body>

</html>
