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
            <header class="bg-white p-4 rounded shadow">
                <h1 class="text-2xl font-semibold">Tambah Dosen</h1>
            </header>
            
            <section class="mt-6 bg-white p-6 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Form Tambah Dosen</h2>
                <form action="#" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-gray-700">Nama Dosen</label>
                        <input type="text" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700">Kode Dosen (3 Huruf)</label>
                        <input type="text" class="w-full p-2 border rounded" required maxlength="3">
                    </div>
                    <div>
                        <label class="block text-gray-700">NIP</label>
                        <input type="text" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700">Username</label>
                        <input type="text" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700">Password</label>
                        <input type="password" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700">Email</label>
                        <input type="email" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700">Departemen</label>
                        <select class="w-full p-2 border rounded" required>
                            <option value="">Pilih Departemen</option>
                            <option value="Informatika">Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Teknik Komputer">Teknik Komputer</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Simpan</button>
                </form>
            </section>
        </main>
    </body>
</html>
