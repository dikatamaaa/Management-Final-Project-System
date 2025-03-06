<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard | Capstone Design</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        function toggleDropdown(id) {
            document.getElementById(id).classList.toggle("hidden");
        }
    </script>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-red-700 text-white min-h-screen p-5">
        <h2 class="text-2xl font-bold">Admin</h2>
        <p class="text-sm mt-1">Koordinator TA</p>

        <nav class="mt-5">
            <a href="/dashboard" class="block py-2 px-3 bg-red-800 rounded"><i class="fas fa-home"></i> Dashboard</a>

            <!-- Kelola User -->
            <div class="relative">
                <button onclick="toggleDropdown('userDropdown')" class="w-full flex justify-between items-center py-2 px-3 hover:bg-red-600 rounded transition">
                    <span><i class="fas fa-users"></i> Kelola User</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div id="userDropdown" class="hidden bg-red-600 mt-1 rounded shadow">
                    <div class="px-3 py-2 font-semibold">Dosen</div>
                    <a href="/add-dosen" class="block px-3 py-2 hover:bg-red-500 transition">Tambah Dosen</a>
                    <a href="/update-dosen" class="block px-3 py-2 hover:bg-red-500 transition">Update Dosen</a>
                    <div class="px-3 py-2 font-semibold">Mahasiswa</div>
                    <a href="/add-student" class="block px-3 py-2 hover:bg-red-500 transition">Tambah Mahasiswa</a>
                    <a href="/update-student" class="block px-3 py-2 hover:bg-red-500 transition">Update Mahasiswa</a>
                </div>
            </div>

            <a href="/template" class="block py-2 px-3 hover:bg-red-600 rounded transition"><i class="fas fa-file-alt"></i> Template Dokumen</a>
            <a href="/login" class="block py-2 px-3 mt-5 bg-red-800 rounded hover:bg-red-900 transition"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow p-6">
        <!-- Header -->
        <header class="bg-white p-4 rounded shadow flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Dashboard</h1>
            <div class="flex space-x-4">
                <i class="fas fa-bell text-gray-600 cursor-pointer"></i>
                <i class="fas fa-user-circle text-gray-600 text-2xl cursor-pointer"></i>
            </div>
        </header>

        <!-- Dashboard Stats -->
        <section class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold">Total Mahasiswa TA</h3>
                <p class="text-gray-600">598 Mahasiswa</p>
            </div>
        </section>

        <!-- List Topik Capstone Design -->
        <section class="mt-6 bg-white p-6 rounded shadow">
            <h3 class="text-xl font-semibold">Topik Capstone Design</h3>
            <table class="w-full mt-3 border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-red-600 text-white">
                        <th class="p-2 border border-gray-300">No</th>
                        <th class="p-2 border border-gray-300">Judul Topik</th>
                        <th class="p-2 border border-gray-300">Dosen Pengaju</th>
                        <th class="p-2 border border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-gray-50">
                        <td class="p-2 border border-gray-300 text-center">1</td>
                        <td class="p-2 border border-gray-300">Sistem Monitoring TA</td>
                        <td class="p-2 border border-gray-300">Dr. Andi Setiawan</td>
                        <td class="p-2 border border-gray-300 text-center">
                            <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Lihat</button>
                        </td>
                    </tr>
                    <tr class="bg-white">
                        <td class="p-2 border border-gray-300 text-center">2</td>
                        <td class="p-2 border border-gray-300">AI untuk Evaluasi Proposal</td>
                        <td class="p-2 border border-gray-300">Dr. Siti Rahmawati</td>
                        <td class="p-2 border border-gray-300 text-center">
                            <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Lihat</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

</body>
</html>
