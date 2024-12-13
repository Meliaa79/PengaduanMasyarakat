<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Warga</title>

    <!-- Link ke file CSS Tailwind yang sudah di-compile -->
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col justify-center items-center">

        <!-- Card Form -->
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-center mb-4">Tambah Data Warga</h2>

            <!-- Form untuk tambah data warga -->
            <form action="{{ route('tambahdatawarga.store') }}" method="POST" class="space-y-4">
            @csrf

                <!-- Input Nama Warga -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Warga</label>
                    <input type="text" name="nama" id="nama" required 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Input NIK -->
                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                    <input type="text" name="nik" id="nik" required 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Input No Telepon -->
                <div>
                    <label for="telepon" class="block text-sm font-medium text-gray-700">No Telepon</label>
                    <input type="text" name="telepon" id="telepon" required 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Input Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required 
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        
                        <!-- Icon Mata untuk toggle password -->
                        <span id="toggle-password" class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer">
                            <i id="password-icon" class="fas fa-eye"></i> <!-- Ikon mata -->
                        </span>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-between">
                    <a href="/datawarga" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Kembali</a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SweetAlert2 -->
    @if(session('success'))
    <script>
        Swal.fire({
            title: "Good job!",
            text: "{{ session('success') }}",
            icon: "success"
        });
    </script>
    @endif

    <!-- JavaScript untuk Toggle Password -->
    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            var passwordField = document.getElementById('password');
            var passwordIcon = document.getElementById('password-icon');

            // Toggle type input (password / text)
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');  // Ganti ke ikon mata tertutup
            } else {
                passwordField.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');  // Ganti ke ikon mata terbuka
            }
        });
    </script>

</body>

</html>
