<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Warga</title>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- FontAwesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-gray-100">

    <div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg max-w-lg">
        <h2 class="text-2xl font-bold text-center mb-6">Edit Data Warga</h2>

        <!-- Form Edit Warga -->
        <form action="{{ route('warga.update', $warga->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Warga -->
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Warga</label>
                <input type="text" name="nama" id="nama" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $warga->nama }}" required>
            </div>

            <!-- NIK -->
            <div class="mb-4">
                <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="text" name="nik" id="nik" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $warga->nik }}" required>
            </div>

            <!-- No Telepon -->
            <div class="mb-4">
                <label for="telepon" class="block text-sm font-medium text-gray-700">No Telepon</label>
                <input type="text" name="telepon" id="telepon" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $warga->telepon }}" required>
            </div>

            <!-- Password -->
            <div class="mb-4 relative">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" class="mt-1 block w-full px-4 py-2 pr-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $warga->password }}" required>
                    <!-- Eye Icon for Toggle Visibility -->
                    <span class="absolute inset-y-0 right-3 top-1/2 transform -translate-y-1/2 cursor-pointer" id="toggle-password">
                        <i class="fa-solid fa-eye-slash" id="eye-icon"></i>
                    </span>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300">Update Data</button>
            </div>
        </form>
    </div>

    <script>
        // Toggle Password Visibility
        const togglePassword = document.getElementById('toggle-password');
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        togglePassword.addEventListener('click', function () {
            // Toggle password visibility
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });

        // SweetAlert for success message
        @if(session('success'))
            Swal.fire({
                title: "Berhasil Diperbarui!",
                text: "Data warga berhasil diperbarui.",
                icon: "success",
                confirmButtonColor: "#3085d6",
            });
        @endif
    </script>

</body>

</html>
