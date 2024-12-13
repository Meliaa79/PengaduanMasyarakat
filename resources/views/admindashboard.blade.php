<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Desa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-1/4 bg-blue-900 text-white p-6">
            <div class="flex flex-col items-center">
                <div class="logo mb-6">
                    <img src="img/suarakita.jpg" alt="Logo" class="w-[60%] mx-auto" />
                </div>
                <nav class="w-full">
                    <a href="#" class="flex items-center px-6 py-3 text-white bg-blue-800 rounded-lg mb-2">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="/verifikasi" class="flex items-center px-6 py-3 text-white hover:bg-blue-800 rounded-lg mb-2">
                        <i class="fas fa-check-circle mr-3"></i>
                        Verifikasi Pengaduan
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
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-3 p-6">
            <h1 class="text-2xl font-bold mb-6">Dashboard Pihak Desa</h1>

            <!-- Grafik Status Pengaduan (Pie Chart) -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-semibold mb-4">Status Pengaduan</h2>
                <div class="flex justify-center">
                <canvas id="grafikStatusPengaduan" width="300" height="300" style="max-width: 100%; height: auto;"></canvas>
                </div>
            </div>

            <!-- Grafik Jumlah Pengaduan Per Bulan -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-semibold mb-4">Grafik Jumlah Pengaduan Per Bulan</h2>
                <div class="flex justify-center">
                    <canvas id="grafikJumlahPengaduan" style="max-width: 100%; height: 400px;"></canvas>
                </div>
            </div>
        </main>
    </div>

    <script>

        // Fungsi untuk toggle dropdown
function toggleDropdown(menuId) {
    const menu = document.getElementById(menuId);
    // Menyembunyikan atau menampilkan menu dengan menambahkan/removing kelas 'hidden'
    menu.classList.toggle('hidden');
}

    console.log("Status Data: ", @json($statusDataArray));  // Menampilkan statusDataArray
    console.log("Bulan Data: ", @json($bulanFormatted));  // Menampilkan bulanFormatted

    const statusData = @json($statusDataArray);  // Menggunakan statusDataArray yang sudah ada
    const bulanData = @json($bulanFormatted);  // Menggunakan bulanFormatted yang sudah ada

    // Menyiapkan label dan data untuk chart
    const labels = Object.keys(statusData);  // Ambil status (label)
    const data = Object.values(statusData);  // Ambil jumlah pengaduan

        // Membulatkan data bulanData menjadi bilangan bulat
        const bulanDataBulat = bulanData.map(value => Math.round(value));

        // Grafik Status Pengaduan (Pie Chart)
        const ctxStatus = document.getElementById('grafikStatusPengaduan').getContext('2d');
        const grafikStatusPengaduan = new Chart(ctxStatus, {
            type: 'pie',
            data: {
                labels: ['Belum Dikerjakan', 'Sedang Dikerjakan', 'Selesai'],
                datasets: [{
                    data: [
                        statusData['Belum Dikerjakan'] || 0,
                        statusData['Sedang Dikerjakan'] || 0,
                        statusData['Selesai'] || 0
                    ],  // Data status pengaduan
                    backgroundColor: ['#FF5733', '#FFCA28', '#4CAF50'], // Warna untuk setiap status
                }]
            },
            options: {
                responsive: true,
                aspectRatio: 1.5, // Atur rasio aspek (lebih besar = lebih kecil)
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });

        // Grafik Jumlah Pengaduan Per Bulan (Bar Chart)
        const ctxJumlah = document.getElementById('grafikJumlahPengaduan').getContext('2d');
        const grafikJumlahPengaduan = new Chart(ctxJumlah, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    data: bulanDataBulat,  // Gunakan data yang sudah dibulatkan
                    backgroundColor: '#4CAF50'
                }]
            },
            options: {
                responsive: true,
                scales: { 
                    y: { 
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }

            
        });


    </script>
</body>

</html>
