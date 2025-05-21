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
</head>

<body style="background: #881d1d;">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center" style="width: 100%;height: 100vh;">
            <div class="col-xxl-4">
                <div class="card">
                    <div class="card-body p-5">
                        <p class="text-center">
                            <img class="img-fluid" src="{{ asset('/storage/assets/img/Logo/Logo%20(250%20x%20250%20piksel).png') }}" style="width: 210px;">
                        </p>
                        <h2 class="text-dark card-title mb-2 mt-5" style="font-family: Poppins, sans-serif;font-weight: bold;">Login</h2>
                            @if ($errors->has('login'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $errors->first('login') }}</strong> {{ $errors->first('login2') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        <form class="pt-4" method="post" action="{{ route('login.submit') }}" enctype="multipart/form-data">
                            @csrf
                            <label class="form-label fs-5 text-dark" style="font-family: Poppins, sans-serif;">Nama Pengguna</label>
                            <input class="bg-light-subtle border rounded-pill border-dark-subtle shadow focus-ring form-control form-control-lg" type="text" name="nama_pengguna" placeholder="Nama Pengguna" data-bs-theme="light" style="font-size: 18px;">
                            @error('nama_pengguna')
                                <div class="form-tex fw-bold ms-3 mt-1" style="color:#881d1d">{{ $message }}</div>
                            @enderror
                            <label class="form-label fs-5 text-dark pt-4" style="font-family: Poppins, sans-serif;">Kata Sandi</label>
                            <input class="bg-light-subtle bg-gradient border rounded-pill border-dark-subtle shadow form-control form-control-lg" type="password" placeholder="Kata Sandi" name="kata_sandi" style="font-size: 18px;" data-bs-theme="light">
                            @error('kata_sandi')
                                <div class="form-tex fw-bold ms-3 mt-1" style="color:#881d1d">{{ $message }}</div>
                            @enderror
                            <p class="text-center d-grid gap-2 pt-4">
                                <button class="btn btn-primary btn-lg border rounded-pill" type="submit" style="background: rgb(136,29,29);">Masuk</button>
                                <a class="text-center pt-3" href="/" style="color: rgb(136,29,29);font-family: Roboto, sans-serif; text-decoration:none;">Kembali ke Halaman Utama</a>
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