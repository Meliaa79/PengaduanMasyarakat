<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengaduan</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.5.4/dist/flowbite.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

</head>

<body class="bg-gray-100 font-sans">
    <!-- Wrapper -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar fixed top-0 left-0 bottom-0 w-[116px] h-screen p-6 bg-blue-900 text-white transition-all duration-500 ease-in-out lg:w-[240px] hover:w-[240px]">
            <!-- Logo -->
            <div class="logo mb-6">
                <img src="img/suarakita.jpg" alt="Logo" class="w-[60%] mx-auto" />
            </div>

            <!-- Menu -->
            <ul class="menu flex flex-col space-y-4">
                <!-- Profil -->
                <li class="group hover:bg-blue-800 rounded-lg">
                    <a href="/pengguna" class="flex items-center space-x-3 text-sm px-4 py-2 group-hover:text-white transition-colors">
                        <i class="bx bx-user text-xl"></i>
                        <span class="hidden lg:block">Profil</span>
                    </a>
                </li>
                <!-- Form Pengaduan -->
                <li class="group hover:bg-blue-800 rounded-lg">
                    <a href="/userform" class="flex items-center space-x-3 text-sm px-4 py-2 group-hover:text-white transition-colors">
                        <i class="bx bx-calendar-check text-xl"></i>
                        <span class="hidden lg:block">Pengaduan</span>
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
        <main class="flex-1 p-6 ml-[116px] lg:ml-[240px]">
            <!-- Informasi Pengaduan -->
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Pengaduan</h2>

                <!-- Card untuk Profil Pengguna -->
                <div class="card shadow-md border p-4 rounded-lg mb-6">
                    <h3 class="text-lg font-semibold mb-4">Profil Pengguna</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="nama" class="font-medium text-gray-700">Nama</label>
                            <input type="text" id="nama" class="bg-gray-200 text-gray-700 p-2 rounded" value="{{ session('user')->nama }}" disabled />
                        </div>
                        <div class="flex flex-col">
                            <label for="nik" class="font-medium text-gray-700">NIK</label>
                            <input type="text" id="nik" class="bg-gray-200 text-gray-700 p-2 rounded" value="{{ session('user')->nik }}" disabled />
                        </div>
                        <div class="flex flex-col">
                            <label for="no_telp" class="font-medium text-gray-700">No. Telepon</label>
                            <input type="text" id="no_telp" class="bg-gray-200 text-gray-700 p-2 rounded" value="{{ session('user')->telepon ?? 'Tidak ada no telepon' }}" disabled />
                        </div>
                    </div>
                </div>

                
               
                </div>
            </div>
        </main>
    </div>

    <!-- Flowbite JS -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.5.4/dist/flowbite.bundle.js"></script>
</body>

</html>
