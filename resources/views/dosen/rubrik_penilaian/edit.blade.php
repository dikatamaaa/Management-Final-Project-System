<!DOCTYPE html>
<html data-bs-theme="light" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Edit Aspek Rubrik Penilaian - TAKU</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/css/style.css') }}">
</head>
<body id="page-top">
<div id="wrapper">
    <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark" style="background: #881d1d;">
        <div class="container-fluid d-flex flex-column p-0">
            <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                <div class="sidebar-brand-icon"><img class="img-fluid" src="{{ asset('/storage/assets/img/Logo/Logo%20White%20(1000%20x%201000%20piksel).png') }}" width="100px"></div>
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item"><a class="nav-link" href="/dosen/beranda"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li class="nav-item"><a class="nav-link" href="/dosen/daftar_topik"><i class="far fa-file-alt"></i><span>Daftar Topik</span></a></li>
                <li class="nav-item"><a class="nav-link" href="/dosen/template_laporan"><i class="fas fa-file-word"></i><span>Template Laporan</span></a></li>
                <li class="nav-item"><a class="nav-link" href="/dosen/pembimbing-dua"><i class="fas fa-user-friends"></i><span>Pembimbing Dua</span></a></li>
                <li class="nav-item"><a class="nav-link" href="/dosen/bimbingan"><i class="fas fa-file-word"></i><span>Bimbingan</span></a></li>
                <li class="nav-item"><a class="nav-link" href="/dosen/progres_ta"><i class="fas fa-chart-line"></i><span>Progres Tugas Akhir</span></a></li>
                <li class="nav-item"><a class="nav-link active" href="/dosen/rubrik-penilaian"><i class="fas fa-pencil-alt"></i><span>Rubrik Penilaian</span></a></li>
                <li class="nav-item"><a class="nav-link" href="/dosen/penilaian-kelompok"><i class="fas fa-pencil-alt"></i><span>Penilaian Kelompok</span></a></li>
                <li class="nav-item">
                    <hr><a class="nav-link" href="/dosen/profil"><i class="fas fa-user"></i><span>Profil</span></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i><span>Keluar</span></a></li>
            </ul>
            <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
        </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                <div class="container-fluid">
                    <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                    <ul class="navbar-nav flex-nowrap ms-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">0</span><i class="fas fa-bell fa-fw"></i></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                    <h6 class="dropdown-header">alerts center</h6>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Tidak ada notifikasi</a>
                                </div>
                            </div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::guard('dosen')->user()->nama_pengguna ?? '' }}</span><span class="badge rounded-pill me-2" style="background: #881d1d;">Dosen</span><img class="border rounded-circle img-profile" src="{{ asset('/storage/assets/img/avatars/' . (Auth::guard('dosen')->user()->foto ?? 'default.jpg')) }}"></a>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="/dosen/profil"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profil</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Keluar</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
                <h4>Edit Aspek Rubrik Penilaian</h4>
                <form action="{{ route('dosen.rubrik-penilaian.update', $aspek->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-2">
                        <label>Tipe Aspek</label>
                        <select name="tipe" class="form-select" required>
                            <option value="individu" @if($aspek->tipe=='individu') selected @endif>Individu (per anggota)</option>
                            <option value="kelompok" @if($aspek->tipe=='kelompok') selected @endif>Kelompok (satu nilai untuk kelompok)</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>CD</label>
                        <input type="number" name="cd" class="form-control" min="1" value="{{ $aspek->cd }}" required>
                    </div>
                    <div class="mb-2">
                        <label>Aspek</label>
                        <input type="text" name="aspek" class="form-control" value="{{ $aspek->aspek }}" required>
                    </div>
                    <div class="mb-2">
                        <label>Indikator Penilaian (0-4)</label>
                        @for($i=0;$i<=4;$i++)
                            <input type="text" name="indikator[{{ $i }}]" class="form-control mb-1" placeholder="Indikator skor {{ $i }}" value="{{ $aspek->indikator[$i] ?? '' }}" required>
                        @endfor
                    </div>
                    <div class="mb-2">
                        <label>Bobot (opsional)</label>
                        <input type="number" step="0.01" name="bobot" class="form-control" value="{{ $aspek->bobot }}">
                    </div>
                    <div class="mb-2">
                        <label>Urutan (opsional)</label>
                        <input type="number" name="urutan" class="form-control" value="{{ $aspek->urutan }}">
                    </div>
                    <button class="btn btn-success" type="submit">Update</button>
                    <a href="{{ route('dosen.rubrik-penilaian.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © TAKU 2025</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="{{ asset('/storage/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/storage/assets/js/theme.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
</body>
</html> 