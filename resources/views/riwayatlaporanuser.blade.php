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

    <!-- Custom Styles -->
    <style>
        :root {
            --primary: #548CA8; /* Primary color */
            --secondary: #334257; /* Adjusted secondary color */
            --bg-light: #F3F4F6; /* Background color */
            --text-light: #ffffff; /* Light text color */
            --text-dark: #334257; /* Dark text color */
            --border: #d1d5db; /* Border color */
            --bg-sidebar: #96B6C5;
        }
    </style>
</head>
<body class="bg-[var(--bg-light)] font-poppins">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="sidebar fixed top-0 left-0 bottom-0 w-[116px] h-screen p-6 bg-[var(--bg-sidebar)] text-gray-800 transition-all duration-500 ease-in-out lg:w-[240px] hover:w-[240px]">
            <!-- Logo -->
            <div class="logo mb-6">
                <img src="img/suarakita.jpg" alt="Foto Profil" class="w-24 h-24 rounded-full border-4 border-blue-800 mb-2">
            </div>

            <!-- Menu -->
            <ul class="menu relative flex flex-col h-[88%] space-y-4">
                <!-- Profil -->
                <li class="group hover:bg-[var(--primary)] rounded-lg">
                    <a href="/pengguna" class="flex items-center space-x-3 text-sm px-4 py-2 group-hover:text-white transition-colors">
                        <i class="bx bx-user text-xl"></i>
                        <span class="hidden lg:block">Profil</span>
                    </a>
                </li>
                <!-- Form Pengaduan -->
                <li class="group hover:bg-[var(--primary)] rounded-lg">
                    <a href="/userform" class="flex items-center space-x-3 text-sm px-4 py-2 group-hover:text-white transition-colors">
                        <i class="bx bx-calendar-check text-xl"></i>
                        <span class="hidden lg:block">Form Pengaduan</span>
                    </a>
                </li>
                <!-- Riwayat Pengaduan -->
                <li class="group hover:bg-[var(--primary)] rounded-lg">
                    <a href="#" class="flex items-center space-x-3 text-sm px-4 py-2 group-hover:text-white transition-colors">
                        <i class="bx bx-history text-xl"></i>
                        <span class="hidden lg:block">Riwayat Pengaduan</span>
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

        <main class="ml-[30px] flex-1 bg-gray-100">
            <div class="main--content transition-all duration-500 ease-in-out ml-[116px] lg:ml-[240px] p-8">
                <!-- Kotak Putih untuk Header dan Tabel -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <!-- Header -->
                    <div class="header--wrapper mb-6">
                        <div class="header--title">
                            <h2 class="text-3xl font-semibold text-gray-800">Riwayat Laporan Pengaduan</h2> 
                        </div>
                    </div>

                    <!-- Tabel Laporan -->
                    <table>
    <thead>
        <tr>
            <th class="bg-blue-900 text-white py-2 px-4">Nama</th>
            <th class="bg-blue-900 text-white py-2 px-4">Tanggal Pengaduan</th>
            <th class="bg-blue-900 text-white py-2 px-4">Judul Pengaduan</th>
            <th class="bg-blue-900 text-white py-2 px-4">Deskripsi Pengaduan</th>
            <th class="bg-blue-900 text-white py-2 px-4">Nama Petugas</th>
            <th class="bg-blue-900 text-white py-2 px-4">Tanggal Dikerjakan</th>
            <th class="bg-blue-900 text-white py-2 px-4">Status</th>
            <th class="bg-blue-900 text-white py-2 px-4">Umur Pengaduan (hari)</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pengaduan as $item)
    <tr>
        <td class="border-t border-gray-400 py-2 px-4">{{ $item->nama }}</td>
        <td class="border-t border-gray-400 py-2 px-4">{{ \Carbon\Carbon::parse($item->tanggal_pengaduan)->format('Y-m-d') }}</td>
        <td class="border-t border-gray-400 py-2 px-4">{{ $item->judul_pengaduan }}</td>
        <td class="border-t border-gray-400 py-2 px-4">{{ $item->deskripsi }}</td>
        <td class="border-t border-gray-400 py-2 px-4">{{ $item->nama_petugas ?? 'Belum ditugaskan' }}</td>
        <td class="border-t border-gray-400 px-2 py-4 text-center">{{ \Carbon\Carbon::parse($item->tanggal_dikerjakan)->format('Y-m-d') }}</td>
        <td class="border-t border-gray-400 py-2 px-4">{{ ucfirst($item->status) }}</td>
        <td class="border-t border-gray-400 py-2 px-4">{{ $item->umur }} hari</td>
    </tr>
@endforeach

    </tbody>
</table>



                </div>
            </div>
        </main>
    </div>
</body>
</html>
