<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>infoTA - Login</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <style>
        body {
            background: linear-gradient(120deg, #f7f8fa 60%, #e7eaf6 100%);
            min-height: 100vh;
            font-family: 'Poppins', 'Roboto', Arial, sans-serif;
        }
        .card {
            border-radius: 22px;
            box-shadow: 0 4px 32px 0 rgba(60,72,88,.13);
            border: none;
        }
        .card-body {
            padding: 2.5rem 2.2rem 2.2rem 2.2rem;
        }
        .login-logo {
            display: block;
            margin: 0 auto 1.5rem auto;
            width: 220px;
            max-width: 80vw;
            height: auto;
        }
        .card-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            letter-spacing: 0.01em;
            margin-bottom: 1.2rem;
        }
        .form-label {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #881d1d;
            font-size: 1.08em;
        }
        .form-control-lg, .form-control {
            border-radius: 14px;
            font-size: 1.08em;
            padding: 0.9em 1.2em;
            background: #f8fafc;
            border: 1.5px solid #e5e7eb;
            box-shadow: 0 2px 8px 0 rgba(60,72,88,.06);
            transition: border 0.18s, box-shadow 0.18s;
        }
        .form-control:focus {
            border-color: #881d1d;
            box-shadow: 0 0 0 0.18rem rgba(136,29,29,0.13);
        }
        .btn-primary.btn-lg {
            background: #881d1d;
            border: none;
            border-radius: 14px;
            font-size: 1.13em;
            font-weight: 600;
            padding: 0.7em 0;
            box-shadow: 0 2px 12px 0 rgba(136,29,29,0.09);
            transition: background 0.18s, box-shadow 0.18s;
        }
        .btn-primary.btn-lg:hover {
            background: #a83232;
            box-shadow: 0 4px 24px 0 rgba(136,29,29,0.13);
        }
        .alert-danger {
            border-radius: 10px;
            font-size: 1em;
        }
        .back-link {
            color: #881d1d;
            font-family: 'Roboto', sans-serif;
            text-decoration: none;
            font-size: 1.08em;
            font-weight: 500;
            transition: color 0.18s;
        }
        .back-link:hover {
            color: #a83232;
            text-decoration: underline;
        }
        @media (max-width: 600px) {
            .card-body { padding: 1.2rem 0.7rem; }
            .card-title { font-size: 1.3rem; }
            .login-logo { width: 140px; max-width: 80vw; }
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
                            <img class="img-fluid login-logo" src="{{ asset('storage/assets/img/Logo/TAKU_black.PNG') }}" alt="Logo TAKU">
                        </p>
                        <h2 class="text-dark card-title mb-2 mt-3">Login</h2>
                        @if ($errors->has('login'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $errors->first('login') }}</strong> {{ $errors->first('login2') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form class="pt-4" method="post" action="{{ route('login.submit') }}" enctype="multipart/form-data">
                            @csrf
                            <label class="form-label fs-5">Nama Pengguna</label>
                            <input class="form-control form-control-lg" type="text" name="nama_pengguna" placeholder="Nama Pengguna" data-bs-theme="light">
                            @error('nama_pengguna')
                                <div class="form-tex fw-bold ms-3 mt-1" style="color:#881d1d">{{ $message }}</div>
                            @enderror
                            <label class="form-label fs-5 pt-4">Kata Sandi</label>
                            <input class="form-control form-control-lg" type="password" placeholder="Kata Sandi" name="kata_sandi" data-bs-theme="light">
                            @error('kata_sandi')
                                <div class="form-tex fw-bold ms-3 mt-1" style="color:#881d1d">{{ $message }}</div>
                            @enderror
                            <p class="text-center d-grid gap-2 pt-4">
                                <button class="btn btn-primary btn-lg" type="submit">Masuk</button>
                                <a class="text-center pt-3 back-link" href="/">Kembali ke Halaman Utama</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/storage/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/storage/assets/js/theme.js') }}"></script>
</body>

</html>