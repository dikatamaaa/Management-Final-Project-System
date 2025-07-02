<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>TAKU - Login</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500&amp;display=swap">
    <style>
        body {
            background: linear-gradient(120deg, #f7f8fa 60%, #e7eaf6 100%);
            min-height: 100vh;
            font-family: 'Poppins', 'Roboto', Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 22px;
            box-shadow: 0 8px 40px rgba(60, 72, 88, 0.15);
            border: none;
            transition: all 0.3s ease;
            width: 100%;
        }
        .card-body {
            padding: 2.5rem;
        }
        .login-logo {
            display: block;
            margin: 0 auto 1.5rem auto;
            width: 150px;
            height: auto;
        }
        .card-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: 0.01em;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        .form-label {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #881d1d;
            font-size: 1.05em;
            margin-bottom: 0.5rem;
        }
        .form-control {
            border-radius: 14px;
            font-size: 1.05em;
            padding: 0.9em 1.2em;
            background: #f8fafc;
            border: 1.5px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(60, 72, 88, 0.06);
            transition: border-color 0.18s, box-shadow 0.18s;
        }
        .form-control:focus {
            border-color: #881d1d;
            box-shadow: 0 0 0 0.2rem rgba(136, 29, 29, 0.15);
        }
        .btn-primary {
            background: #881d1d;
            border: none;
            border-radius: 14px;
            font-size: 1.1em;
            font-weight: 600;
            padding: 0.8em 0;
            box-shadow: 0 4px 15px rgba(136, 29, 29, 0.2);
            transition: background-color 0.18s, box-shadow 0.18s, transform 0.18s;
        }
        .btn-primary:hover {
            background: #a83232;
            box-shadow: 0 6px 20px rgba(136, 29, 29, 0.25);
            transform: translateY(-2px);
        }
        .alert-danger {
            border-radius: 10px;
        }
        .back-link {
            color: #881d1d;
            text-decoration: none;
            font-size: 1.05em;
            font-weight: 500;
            transition: color 0.18s;
        }
        .back-link:hover {
            color: #a83232;
            text-decoration: underline;
        }
        
        /* === BAGIAN BARU UNTUK ROLE SELECTOR === */
        .role-selector {
            display: flex;
            border-radius: 16px;
            background-color: #f0f2f5;
            padding: 6px;
            margin-bottom: 2rem;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.04);
        }
        .role-btn {
            flex: 1;
            padding: 0.75rem 0.5rem;
            border: none;
            background-color: transparent;
            border-radius: 12px;
            font-size: 1em;
            font-weight: 600;
            color: #555;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }
        .role-btn.active {
            background-color: #881d1d;
            color: #fff;
            box-shadow: 0 3px 12px rgba(136, 29, 29, 0.25);
        }
        /* === END BAGIAN BARU === */

        @media (max-width: 576px) {
            .card-body { padding: 2rem 1.5rem; }
            .card-title { font-size: 1.5rem; }
            .login-logo { width: 120px; }
            .role-btn { font-size: 0.9em; }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center" style="width: 100%;height: 100vh;">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 col-12">
                <div class="card">
                    <div class="card-body p-5">
                        <p class="text-center">
                            <img class="img-fluid login-logo" src="{{ asset('storage/assets/img/Logo/TAku(600).svg') }}" alt="Logo TAKU">
                        </p>

                        <!-- ROLE SELECTOR BARU -->
                        <div class="role-selector">
                            <button class="role-btn active" data-role="Mahasiswa">Mahasiswa</button>
                            <button class="role-btn" data-role="Dosen">Dosen</button>
                            <button class="role-btn" data-role="Admin">Admin</button>
                        </div>
                        
                        <h2 class="text-dark card-title text-center" id="login-title">Login Mahasiswa</h2>

                        @if ($errors->has('login'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $errors->first('login') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form class="pt-2" method="post" action="{{ route('login.submit') }}">
                            @csrf
                            <!-- Input hidden untuk mengirim peran ke backend -->
                            <input type="hidden" name="role" id="role-input" value="Mahasiswa">
                            
                            <div class="mb-3">
                                <label class="form-label" for="nama_pengguna">Nama Pengguna</label>
                                <input class="form-control" type="text" id="nama_pengguna" name="nama_pengguna" placeholder="Masukkan Nama Pengguna" required>
                                @error('nama_pengguna')
                                    <div class="form-text text-danger fw-bold ms-1 mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="kata_sandi">Kata Sandi</label>
                                <input class="form-control" type="password" id="kata_sandi" placeholder="Masukkan Kata Sandi" name="kata_sandi" required>
                                @error('kata_sandi')
                                    <div class="form-text text-danger fw-bold ms-1 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-grid pt-3">
                                <button class="btn btn-primary" type="submit">Masuk</button>
                            </div>

                            <p class="text-center pt-4">
                               <a class="back-link" href="/">Kembali ke Halaman Utama</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/storage/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/storage/assets/js/theme.js') }}"></script>

    <!-- SCRIPT UNTUK INTERAKSI TOMBOL -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleButtons = document.querySelectorAll('.role-btn');
            const loginTitle = document.getElementById('login-title');
            const roleInput = document.getElementById('role-input');
            roleButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault(); // Mencegah form submit saat tombol diklik

                    // Hapus kelas 'active' dari semua tombol
                    roleButtons.forEach(btn => btn.classList.remove('active'));
                    
                    // Tambahkan kelas 'active' ke tombol yang diklik
                    this.classList.add('active');
                    
                    // Dapatkan peran dari atribut data-role
                    const selectedRole = this.dataset.role;
                    
                    // Ubah judul login
                    loginTitle.textContent = 'Login ' + selectedRole;

                    // Set value pada input hidden
                    roleInput.value = selectedRole;
                });
            });


        });
    </script>
</body>
</html>