<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga</title>

    <!-- Link ke file CSS Tailwind yang sudah di-compile -->
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white flex flex-col">
            <!-- Foto Profil -->
            <div class="p-4 flex flex-col items-center border-b border-blue-700">
                <img src="img/suarakita.jpg" alt="Foto Profil" class="w-24 h-24 rounded-full border-4 border-blue-800 mb-2">
                <h2 class="text-lg font-bold">Admin Panel</h2>
                <p class="text-sm text-gray-300">Administrator</p>
            </div>

            <!-- Menu -->
            <nav class="flex-grow p-4 space-y-2">
                <a href="/admindashboard" class="block px-4 py-2 rounded hover:bg-blue-700">
                    <i class="fa-solid fa-tachometer-alt mr-2"></i> Dashboard
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
                        <!-- <a href="/datalaporan" class="block px-8 py-2 hover:bg-blue-700">Data Laporan</a> -->
                    </div>
                </div>

                <!-- <a href="/login" class="block px-4 py-2 rounded hover:bg-red-700">
                    <i class="fa-solid fa-sign-out-alt mr-2"></i> Logout
                </a> -->
            </nav>

            <!-- Footer Sidebar -->
            <footer class="p-4 text-center text-sm border-t border-blue-700">
                &copy; 2024 Dashboard Admin
            </footer>
        </aside>

        <!-- Konten Utama -->
        <main class="flex-grow p-6">

            <!-- Header -->
            <header class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Data Warga</h2>
                <a href="/tambahdatawarga" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Tambah Data
                </a>
            </header>

            <!-- Tabel -->
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="table-auto w-full text-left border-collapse">
                <thead class="bg-blue-800">
                    <tr>
                        <th class="border px-4 py-2 text-sm font-medium text-white">No</th>
                        <th class="border px-4 py-2 text-sm font-medium text-white">Nama Warga</th>
                        <th class="border px-4 py-2 text-sm font-medium text-white">NIK</th>
                        <th class="border px-4 py-2 text-sm font-medium text-white">No Telepon</th>
                        <th class="border px-4 py-2 text-sm font-medium text-white">Password</th>
                        <th class="border px-4 py-2 text-sm font-medium text-white">Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($wargas as $warga)
                        <tr class="odd:bg-gray-50">
                            <td class="border px-4 py-2 text-sm">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2 text-sm">{{ $warga->nama }}</td>
                            <td class="border px-4 py-2 text-sm">{{ $warga->nik }}</td>
                            <td class="border px-4 py-2 text-sm">{{ $warga->telepon }}</td>
                            <td class="border px-4 py-2 text-sm">*******</td>
                            <td class="border px-4 py-2 text-sm flex space-x-4">
                                <!-- Tombol Edit -->
                                <a href="{{ route('warga.edit', $warga->id) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                                </a>


                                <!-- Form Hapus -->
                                <form action="{{ route('datawarga.destroy', $warga->id) }}" method="POST" class="delete-form" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-red-500 hover:text-red-700 delete-button">
                                        <i class="fa-solid fa-trash-can text-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
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
        // Menambahkan event listener untuk tombol hapus
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah form untuk langsung submit

                const form = this.closest('form'); // Menemukan form yang berisi tombol ini

                // Menampilkan SweetAlert2
                Swal.fire({
                    title: "Are you sure?",
                    text: "Data ini akan terhapus dari sistem",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika dikonfirmasi, kirimkan form untuk menghapus data
                        form.submit();

                        // Menampilkan pesan sukses setelah penghapusan
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>
