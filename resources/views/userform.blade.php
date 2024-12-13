<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Styles -->
    <style>
        :root {
            --primary: #548CA8;
            --secondary: #334257;
            --bg-light: #F3F4F6;
            --text-light: #ffffff;
            --text-dark: #334257;
            --border: #d1d5db;
            --bg-sidebar: #1E40AF;
        }

        table {
            width: 100%;
            table-layout: auto;
        }

        th, td {
            padding: 12px 20px;
            text-align: left;
            border: 1px solid #ccc;
        }

        th {
            background-color: #1E40AF;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #F9FAFB;
        }

        .table-scroll {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-scroll td {
            word-wrap: break-word;
        }
    </style>
</head>

<body class="bg-[var(--bg-light)] font-poppins">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="sidebar fixed top-0 left-0 bottom-0 w-[116px] h-screen p-6 bg-blue-900 text-white transition-all duration-500 ease-in-out lg:w-[240px] hover:w-[240px]">
            <!-- Logo -->
            <div class="logo mb-6">
                <img src="img/suarakita.jpg" alt="Logo" class="w-[60%] mx-auto" />
            </div>

            <!-- Menu -->
            <ul class="menu flex flex-col space-y-4">
                <!-- Profil -->
                <li class="group hover:bg-blue-700 rounded-lg">
                    <a href="/pengguna" class="flex items-center space-x-3 text-sm px-4 py-2 group-hover:text-white transition-colors">
                        <i class="bx bx-user text-xl"></i>
                        <span class="hidden lg:block">Profil</span>
                    </a>
                </li>
                <!-- Form Pengaduan -->
                <li class="group hover:bg-blue-700 rounded-lg">
                    <a href="{{ route('userform') }}" class="flex items-center space-x-3 text-sm px-4 py-2 group-hover:text-white transition-colors">
                        <i class="bx bx-calendar-check text-xl"></i>
                        <span class="hidden lg:block">Form Pengaduan</span>
                    </a>
                </li>

                <!-- Logout -->
                <li class="mt-auto group hover:bg-red-600 rounded-lg">
                    <a href="/login" class="flex items-center space-x-3 text-sm px-4 py-2 group-hover:text-white transition-colors">
                        <i class="bx bx-log-out text-xl"></i>
                        <span class="hidden lg:block">Logout</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="ml-[116px] lg:ml-[240px] flex-1 bg-gray-100 py-10 px-5">
            <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg p-8 overflow-hidden">
                <h1 class="text-3xl font-semibold text-gray-800 mb-6">Daftar Pengaduan</h1>
                <button id="btnTambahPengaduan" class="bg-blue-600 text-white py-3 px-6 rounded-lg mb-6 hover:bg-blue-700">Tambah Pengaduan</button>

                <!-- Form Pengaduan -->
                <div id="formPengaduanModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                    <div class="bg-white p-6 rounded-lg w-96">
                        <h2 class="text-xl font-semibold mb-4">Tambah Pengaduan</h2>
                        <form action="{{ route('pengaduan.store') }}" method="POST">
                            @csrf
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama:</label>
                                <input type="text" name="nama" id="nama" class="w-full border-gray-300 rounded-lg px-4 py-3" placeholder="Masukkan Nama Anda" required>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="tanggal_pengaduan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengaduan:</label>
                                    <input type="date" id="tanggal_pengaduan" name="tanggal_pengaduan" class="w-full border-gray-300 rounded-lg px-4 py-3" required>
                                </div>
                                <div>
                                    <label for="kategori_pengaduan" class="block text-sm font-medium text-gray-700 mb-1">Kategori Pengaduan</label>
                                    <select id="kategori_pengaduan" name="kategori_pengaduan" class="w-full border-gray-300 rounded-lg px-4 py-3" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Infrastruktur">Infrastruktur</option>
                                        <option value="Kesehatan">Kesehatan</option>
                                        <option value="Lingkungan">Lingkungan</option>
                                        <option value="Keamanan">Keamanan</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Pengaduan:</label>
                                <textarea id="deskripsi" name="deskripsi" class="w-full border-gray-300 rounded-lg px-4 py-3 resize-none" rows="5" placeholder="Jelaskan pengaduan Anda dengan rinci..." required></textarea>
                            </div>
                            <div class="flex justify-end space-x-4 mt-4">
                                <button type="button" onclick="closeModal()" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">Tutup</button>
                                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel Daftar Pengaduan -->
                <div class="table-scroll">
                    <table class="min-w-full mt-6 border border-gray-300">
                        <thead>
                            <tr>
                                <th class="bg-blue-900 text-white py-2 px-4">Nama</th>
                                <th class="bg-blue-900 text-white py-2 px-4">Tanggal Pengaduan</th>
                                <th class="bg-blue-900 text-white py-2 px-4">Kategori Pengaduan</th>
                                <th class="bg-blue-900 text-white py-2 px-4">Deskripsi Pengaduan</th>
                                <th class="bg-blue-900 text-white py-2 px-4">Nama Petugas</th>
                                <th class="bg-blue-900 text-white py-2 px-4">Tanggal Dikerjakan</th>
                                <th class="bg-blue-900 text-white py-2 px-4">Status</th>
                                <th class="bg-blue-900 text-white py-2 px-4">Umur (hari)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengaduan as $item)
                                <tr>
                                    <td class="border-t border-gray-400 py-2 px-4">{{ $item->nama }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ \Carbon\Carbon::parse($item->tanggal_pengaduan)->format('Y-m-d') }}</td>
                                    <td class="border-t border-gray-400 py-2 px-4">{{ $item->kategori_pengaduan }}</td>
                                    <td class="border-t border-gray-400 py-2 px-4">{{ $item->deskripsi }}</td>
                                    <td class="border-t border-gray-400 py-2 px-4">{{ $item->nama_petugas ?? 'Belum ditugaskan' }}</td>
                                    <td class="border-t border-gray-400 py-2 px-4">
                                        <!-- Menampilkan tanggal dikerjakan, tidak bisa diedit -->
                                        {{ $item->tanggal_dikerjakan ? \Carbon\Carbon::parse($item->tanggal_dikerjakan)->format('Y-m-d') : 'Belum dikerjakan' }}
                                    </td>

                                    <td class="border-t border-gray-400 py-2 px-4">{{ ucfirst($item->status) }}</td>
                                    <td class="border-t border-gray-400 py-2 px-4">{{ round(\Carbon\Carbon::parse($item->tanggal_pengaduan)->diffInDays(now())) }} hari</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination mt-4">
                    {{ $pengaduan->links() }}
                </div>
            </div>
        </main>
    </div>

    <!-- Script untuk kontrol pop-up -->
    <script>
        const btnTambahPengaduan = document.getElementById('btnTambahPengaduan');
        const formPengaduanModal = document.getElementById('formPengaduanModal');

        // Buka modal
        btnTambahPengaduan.addEventListener('click', () => {
            formPengaduanModal.classList.remove('hidden');
        });

        // Fungsi untuk menutup modal
        function closeModal() {
            formPengaduanModal.classList.add('hidden');
        }
    </script>
</body>

</html>
