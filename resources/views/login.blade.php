<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | infoTA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-red-700 to-red-900 text-white min-h-screen flex flex-col items-center justify-center">

    <div class="text-center mb-6">
        <h1 class="text-5xl font-bold"><span class="text-gray-100">info</span><span class="text-red-300">TA</span></h1>
        <div class="mt-2">
            <a href="/" class="text-gray-300 hover:text-white transition-all">Back to Homepage</a> |
            <a href="/dashboard" class="text-gray-300 hover:text-white transition-all">Test Dashboard</a>
        </div>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-4">Login</h2>
        <form action="/login" method="POST" class="space-y-4">
            <div>
                <label for="username" class="block text-gray-700 font-medium">Username</label>
                <input type="text" id="username" name="username" required 
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 text-gray-900">
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required 
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 text-gray-900">
                    <button type="button" onclick="togglePassword()" 
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-red-500 transition">
                        👁️
                    </button>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="showPassword" onclick="togglePassword()">
                    <label for="showPassword" class="text-gray-700 text-sm">Tampilkan Password</label>
                </div>
            </div>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-md transition-all">
                Login
            </button>
        </form>
    </div>

    <script>
        function togglePassword() {
            let passwordInput = document.getElementById("password");
            let checkbox = document.getElementById("showPassword");
            
            if (checkbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>

</body>
</html>
