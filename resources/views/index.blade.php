<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>TAku</title>
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
        .main-box {
            background: rgba(255,255,255,0.92);
            border-radius: 28px;
            box-shadow: 0 4px 32px 0 rgba(60,72,88,.13);
            padding: 3.5rem 2.5rem 2.5rem 2.5rem;
            max-width: 540px;
            margin: 0 auto;
        }
        .main-logo {
            display: block;
            margin: 0 auto 2.2rem auto;
            width: 220px;
            max-width: 70vw;
            height: auto;
        }
        .main-heading {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #1e293b;
            font-size: 2.7rem;
            margin-bottom: 1.2rem;
            letter-spacing: 0.01em;
        }
        .inline-logo {
            display: inline-block;
            height: 2.2em;
            vertical-align: middle;
            margin-left: 0.2em;
        }
        .brand-text {
            color: #881d1d;
            font-weight: 800;
            letter-spacing: 0.02em;
        }
        .main-desc {
            color: #444;
            font-size: 1.18rem;
            font-family: 'Roboto', 'Poppins', Arial, sans-serif;
            margin-bottom: 2.2rem;
            line-height: 1.6;
        }
        .btn-main {
            background: #881d1d;
            color: #fff;
            font-weight: 600;
            font-size: 1.18em;
            border-radius: 18px;
            padding: 0.85em 0;
            width: 100%;
            max-width: 220px;
            margin: 0 auto;
            box-shadow: 0 2px 12px 0 rgba(136,29,29,0.09);
            transition: background 0.18s, box-shadow 0.18s;
        }
        .btn-main:hover {
            background: #a83232;
            color: #fff;
            box-shadow: 0 4px 24px 0 rgba(136,29,29,0.13);
        }
        @media (max-width: 600px) {
            .main-box { padding: 1.2rem 0.7rem; max-width: 98vw; }
            .main-heading { font-size: 1.5rem; }
            .main-logo { width: 120px; }
            .main-desc { font-size: 1.01rem; }
        }
    </style>
</head>
<body>
    <div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="main-box text-center">
            <img class="main-logo" src="{{ asset('storage/assets/img/Logo/TAKU_black.PNG') }}" alt="Logo TAKU">
            <div class="main-heading">Welcome to <img src="{{ asset('storage/assets/img/Logo/TAKU_black.PNG') }}" alt="Logo TAKU" class="inline-logo"></div>
            <div class="main-desc">
                Platform untuk mahasiswa Telkom University, khususnya program studi S1 Teknik Komputer, yang mempermudah proses manajemen tugas akhir.
            </div>
            <a class="btn btn-main mt-2" role="button" href="/login">Masuk</a>
        </div>
    </div>
    <script src="{{ asset('/storage/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/storage/assets/js/theme.js') }}"></script>
</body>
</html>