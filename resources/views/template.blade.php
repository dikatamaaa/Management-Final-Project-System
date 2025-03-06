<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template Dokumen | Capstone Design</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <span>Kelola User</span>
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

            <a href="/template" class="block py-2 px-3 bg-red-800 rounded">Template Dokumen</a>
            <a href="/login" class="block py-2 px-3 mt-5 bg-red-800 rounded hover:bg-red-900 transition">Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow p-6">
        <header class="bg-white p-4 rounded shadow flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Template Dokumen</h1>
        </header>

        <!-- Form Upload -->
        <section class="mt-6 bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Upload Template Dokumen</h2>
            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
                <input type="file" accept=".docx" required class="block w-full p-2 border rounded" id="fileInput">
                <button type="button" onclick="uploadFile()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Upload</button>
            </form>
            <p id="uploadMessage" class="mt-2 text-green-600 hidden">File berhasil diunggah!</p>
        </section>

        <!-- List Template -->
        <section class="mt-6 bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Daftar Template</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-red-600 text-white">
                        <th class="p-2 border border-gray-300">No</th>
                        <th class="p-2 border border-gray-300">Nama File</th>
                        <th class="p-2 border border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody id="fileTable">
                    <tr class="bg-gray-50">
                        <td class="p-2 border border-gray-300 text-center">1</td>
                        <td class="p-2 border border-gray-300">Template_TA.docx</td>
                        <td class="p-2 border border-gray-300 text-center">
                            <a href="#" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Update</a>
                            <button onclick="deleteFile(this)" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition ml-2">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <script>
        function uploadFile() {
            const fileInput = document.getElementById("fileInput");
            if (fileInput.files.length > 0) {
                document.getElementById("uploadMessage").classList.remove("hidden");

                let table = document.getElementById("fileTable");
                let row = table.insertRow();
                row.innerHTML = `
                    <td class="p-2 border border-gray-300 text-center">${table.rows.length}</td>
                    <td class="p-2 border border-gray-300">${fileInput.files[0].name}</td>
                    <td class="p-2 border border-gray-300 text-center">
                        <a href="#" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Download</a>
                        <button onclick="deleteFile(this)" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition ml-2">Hapus</button>
                    </td>
                `;
                fileInput.value = "";
            }
        }

        function deleteFile(btn) {
            btn.closest("tr").remove();
        }
    </script>

</body>
</html>
