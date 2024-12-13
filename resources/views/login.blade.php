<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-to-br from-blue-200 to-blue-500 font-sans overflow-hidden h-screen">


    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

    <section class="flex justify-center items-center h-full relative">
        <!-- Background Decoration -->
        <div class="absolute inset-0 bg-white opacity-10 bg-[url('/path/to/pattern.png')] bg-cover"></div>

        <!-- Form Container -->
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full z-10">
            <h2 class="text-2xl font-bold text-center mb-6 text-blue-600">Selamat Datang!</h2>
            <p class="text-center text-gray-600 mb-4">Silakan login untuk melanjutkan ke layanan kami.</p>

            <!-- Form -->
            <form action="{{ url('login') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Username -->
                <div class="relative">
                    <input type="text" name="username" id="username" placeholder="Username"
                        class="w-full px-4 py-3 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <i class="fas fa-user"></i>
                    </span>
                </div>

                <!-- Password -->
                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="w-full px-4 py-3 pl-10 pr-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <span class="absolute inset-y-0 right-3 flex items-center text-gray-400 cursor-pointer"
                          onclick="togglePassword()">
                        <i id="togglePasswordIcon" class="fas fa-eye"></i>
                    </span>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-3 rounded-lg font-semibold hover:bg-blue-600">
                    Login
                </button>
            </form>

            <!-- Close Button -->
            <button
                onclick="window.location.href='{{ url('/landing') }}'"
                class="w-full mt-4 text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:underline">
                Close
            </button>
        </div>
    </section>

    <!-- JavaScript for Toggle Password -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>
