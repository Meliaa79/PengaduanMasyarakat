<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Petugas</title>

    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-blue-900 text-white flex flex-col">
            <div class="p-4 flex flex-col items-center border-b border-blue-700">
                <img src="img/suarakita.jpg" alt="Foto Profil" class="w-24 h-24 rounded-full border-4 border-blue-800 mb-2">
                <h2 class="text-lg font-bold">Admin Panel</h2>
                <p class="text-sm text-gray-300">Administrator</p>
            </div>
            <nav class="flex-grow p-4 space-y-2">
                <a href="/admindashboard" class="block px-4 py-2 rounded hover:bg-blue-700">
                    <i class="fa-solid fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="/verifikasi" class="block px-4 py-2 rounded hover:bg-blue-700">
                    <i class="fa-solid fa-check-circle mr-2"></i> Verifikasi Pengaduan
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
            </nav>
            <footer class="p-4 text-center text-sm border-t border-blue-700">
                &copy; 2024 Dashboard Admin
            </footer>
        </aside>

        <main class="flex-grow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Daftar Petugas</h2>

                <!-- Filter Status & Tambah Petugas Button -->
                <div class="flex space-x-4">
                    <form action="{{ route('petugas.index') }}" method="GET" class="flex space-x-4">
                        <!-- Dropdown filter status -->
                        <select name="status" class="bg-blue-600 text-white px-4 py-2 border rounded-md" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="aktif" class="bg-blue-400" {{ request()->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="non-aktif" class="bg-blue-400" {{ request()->status == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </form>

                    <a href="/tambahdatapetugas" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Tambah Data</a>
                </div>
            </div>

            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="table-auto w-full text-left border-collapse">
                    <thead class="bg-blue-800">
                        <tr>
                            <th class="border px-4 py-2 text-sm font-medium text-white">No</th>
                            <th class="border px-4 py-2 text-sm font-medium text-white">Nama Petugas</th>
                            <th class="border px-4 py-2 text-sm font-medium text-white">No Telepon</th>
                            <th class="border px-4 py-2 text-sm font-medium text-white">Alamat</th>
                            <th class="border px-4 py-2 text-sm font-medium text-white">Status</th>
                            <th class="border px-4 py-2 text-sm font-medium text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($petugas as $index => $p)
                    <tr class="odd:bg-gray-50">
                        <td class="border px-4 py-2 text-sm">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2 text-sm">{{ $p->nama }}</td>
                        <td class="border px-4 py-2 text-sm">{{ $p->telepon }}</td>
                        <td class="border px-4 py-2 text-sm">{{ $p->alamat }}</td>
                        <td class="border px-4 py-2 text-sm">
                            <span class="px-2 py-1 rounded {{ $p->status == 'aktif' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td class="border px-4 py-2 text-sm flex space-x-4">
                            <a href="/editdatapetugas/{{ $p->id }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fa-solid fa-pen-to-square text-lg"></i>
                            </a>

                            <form action="{{ route('petugas.updateStatus', $p->id) }}" method="POST" class="inline-block" id="delete-form-{{ $p->id }}">
                                @csrf
                                @method('PATCH')
                                <button type="button" class="delete-button text-red-500 hover:text-red-700">
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
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Status petugas akan di non-aktif kan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Ubah Status!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        function toggleDropdown(id) {
            const menu = document.getElementById(id);
            menu.classList.toggle('hidden');
        }
    </script>
</body>

</html>
