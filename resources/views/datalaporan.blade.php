<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan</title>

    <!-- Link ke file CSS Tailwind yang sudah di-compile -->
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white flex flex-col">
            <!-- Logo -->
            <div class="p-4 flex flex-col items-center border-b border-blue-700">
                <img src="img/suarakita.jpg" alt="Logo" class="w-24 h-24 rounded-full mb-2">
                <h2 class="text-lg font-bold">SuaraKita</h2>
            </div>

            <!-- Menu -->
            <nav class="flex-grow p-4 space-y-2">
                <a href="/admindashboard" class="block px-4 py-2 rounded hover:bg-blue-700">
                    <i class="fa-solid fa-home mr-2"></i> Dashboard
                </a>
                <a href="/verifikasi" class="block px-4 py-2 rounded hover:bg-blue-700">
                    <i class="fa-solid fa-check-circle mr-2"></i> Verifikasi Pengaduan
                </a>

                <!-- Dropdown Data -->
                <div class="relative">
                    <button onclick="toggleDropdown('data-menu')" class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-blue-700">
                        <span><i class="fa-solid fa-database mr-2"></i> Data</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div id="data-menu" class="hidden flex-col mt-2 bg-blue-800 rounded shadow-lg">
                        <a href="/petugas" class="block px-8 py-2 hover:bg-blue-700">Data Petugas</a>
                        <a href="/datawarga" class="block px-8 py-2 hover:bg-blue-700">Data Warga</a>
                        <a href="/datalaporan" class="block px-8 py-2 hover:bg-blue-700">Data Laporan</a>
                    </div>
                </div>

                <!-- Dropdown Laporan -->
                <div class="relative">
                    <button onclick="toggleDropdown('laporan-menu')" class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-blue-700">
                        <span><i class="fa-solid fa-chart-bar mr-2"></i> Laporan</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div id="laporan-menu" class="hidden flex-col mt-2 bg-blue-800 rounded shadow-lg">
                        <a href="/laporanakhir" class="block px-8 py-2 hover:bg-blue-700">Laporan Akhir</a>
                    </div>
                </div>
                
                <!-- <a href="/login" class="block px-4 py-2 rounded hover:bg-red-700">
                    <i class="fa-solid fa-sign-out-alt mr-2"></i> Logout
                </a> -->
            </nav>

            <!-- Footer Sidebar -->
            <footer class="p-4 text-center text-sm border-t border-blue-700">
                &copy; 2024 SuaraKita
            </footer>
        </aside>

        <!-- Konten Utama -->
        <main class="flex-grow p-6">

            <!-- Header -->
            <header class="mb-6">
                <h2 class="text-3xl font-semibold text-gray-800">Daftar Laporan</h2>
            </header>

            <!-- Tabel -->
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="table-auto w-full text-left border-collapse">
                    <thead class="bg-blue-800 text-white">
                        <tr>
                            <th class="border px-4 py-2 text-sm font-medium">No</th>
                            <th class="border px-4 py-2 text-sm font-medium">Nama Pengadu</th>
                            <th class="border px-4 py-2 text-sm font-medium">Kategori Pengaduan</th>
                            <th class="border px-4 py-2 text-sm font-medium">Deskripsi</th>
                            <th class="border px-4 py-2 text-sm font-medium">Tanggal Pengaduan</th>
                            <th class="border px-4 py-2 text-sm font-medium">Status Pengaduan</th>
                            <th class="border px-4 py-2 text-sm font-medium">Nama Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-gray-50">
                            <td class="border px-4 py-2 text-sm">1</td>
                            <td class="border px-4 py-2 text-sm">Adi</td>
                            <td class="border px-4 py-2 text-sm">Banjir di Gang</td>
                            <td class="border px-4 py-2 text-sm">Gang kecil sering banjir saat hujan</td>
                            <td class="border px-4 py-2 text-sm">2024-10-22</td>
                            <td class="border px-4 py-2 text-sm">
                                <select class="w-full p-1 rounded bg-gray-100 border-gray-300">
                                    <option value="Belum Ditangani">Belum Ditangani</option>
                                    <option value="Sedang Ditangani">Sedang Ditangani</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </td>
                            <td class="border px-4 py-2 text-sm"></td>
                        </tr>
                        <!-- Tambahkan lebih banyak data -->
                    </tbody>
                </table>
            </div>

        </main>

    </div>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
        }
    </script>

</body>

</html>

