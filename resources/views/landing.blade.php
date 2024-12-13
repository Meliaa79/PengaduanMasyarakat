<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            overflow: hidden; /* Pastikan tidak bisa scroll */
        }

        header {
            height: 10vh; /* Header menempati 10% tinggi layar */
        }

        section {
            height: 90vh; /* Section menempati 90% tinggi layar */
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
    <!-- <header class="flex items-center justify-start px-4 md:px-6 bg-white shadow-sm">
        <img src="{{ asset('img/suarakita.jpg') }}" alt="Logo SuaraKita" class="h-12 w-auto md:h-16">
    </header> -->

    <!-- Hero Section -->
    <section class="flex flex-col-reverse md:flex-row justify-between items-center max-w-7xl mx-auto px-6 md:px-12 bg-gray-50">
        <!-- Text -->
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-gray-800 mb-4">Layanan Pengaduan Masyarakat!</h1>
            <p class="text-md md:text-lg text-gray-600 mb-6">Suarakan pendapatmu di website SuaraKita</p>
            <a href="/login" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">Login</a>
        </div>

        <!-- Image -->
        <div class="w-full md:w-1/2 flex justify-center">
            <img src="{{ asset('img/ilustrasi.jpg') }}" alt="Ilustrasi" class="w-3/4 md:w-full">
        </div>
    </section>

</body>

</html>
