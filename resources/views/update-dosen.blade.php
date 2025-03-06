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
            <a href="/dashboard" class="block py-2 px-3 hover:bg-red-600 rounded transition">Dashboard</a>

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
                <h1 class="text-2xl font-semibold">Update Dosen</h1>
            </header>
    
            <!-- Search Dosen -->
            <section class="mt-6 bg-white p-6 rounded shadow">
                <h3 class="text-xl font-semibold">Cari Dosen</h3>
                <input type="text" id="search" placeholder="Cari berdasarkan Nama atau Kode Dosen..." 
                    class="mt-2 w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-red-500">
            </section>
    
            <!-- List Dosen -->
            <section class="mt-6 bg-white p-6 rounded shadow">
                <h3 class="text-xl font-semibold">Daftar Dosen</h3>
                <table class="w-full mt-3 border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-red-600 text-white">
                            <th class="p-2 border border-gray-300">No</th>
                            <th class="p-2 border border-gray-300">Nama Dosen</th>
                            <th class="p-2 border border-gray-300">Kode</th>
                            <th class="p-2 border border-gray-300">NIP</th>
                            <th class="p-2 border border-gray-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-gray-50">
                            <td class="p-2 border border-gray-300 text-center">1</td>
                            <td class="p-2 border border-gray-300">Dr. Andi Setiawan</td>
                            <td class="p-2 border border-gray-300 text-center">ANS</td>
                            <td class="p-2 border border-gray-300 text-center">1987654321</td>
                            <td class="p-2 border border-gray-300 text-center">
                                <button onclick="editDosen()" 
                                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Edit</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
    
            <!-- Form Update Dosen -->
            <section id="editForm" class="mt-6 bg-white p-6 rounded shadow hidden">
                <h3 class="text-xl font-semibold">Update Data Dosen</h3>
                <form>
                    <label class="block mt-4">Nama Dosen</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded">
    
                    <label class="block mt-4">Kode Dosen</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded" maxlength="3">
    
                    <label class="block mt-4">NIP</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded">
    
                    <label class="block mt-4">Username</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded">
    
                    <label class="block mt-4">Email</label>
                    <input type="email" class="w-full p-2 border border-gray-300 rounded">
    
                    <label class="block mt-4">Departemen</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded">
    
                    <button type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Simpan Perubahan</button>
                </form>
            </section>
        </main>
    
        <script>
            function editDosen() {
                document.getElementById('editForm').classList.remove('hidden');
            }
        </script>
    </body>
</html>
    