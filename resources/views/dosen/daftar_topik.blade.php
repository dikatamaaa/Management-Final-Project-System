<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Daftar Topik - Dosen</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        :root {
            --primary-color: #881d1d;
            --primary-darker: #6e1717;
            --primary-lighter: #a83232;
            --sidebar-text: rgba(255, 255, 255, 0.8);
            --sidebar-text-active: #ffffff;
            --secondary-color: #f8f9fa;
            --font-family: 'Poppins', sans-serif;
        }
        body {
            font-family: var(--font-family);
            background-color: var(--secondary-color);
        }
        #wrapper {
            display: flex;
        }
        .sidebar {
            background: var(--primary-color) !important;
            transition: width 0.3s ease;
        }
        .sidebar .sidebar-brand {
            height: 60px;
            transition: background-color 0.2s ease;
        }
        .sidebar .sidebar-brand:hover {
            background-color: var(--primary-darker);
        }
        .sidebar .sidebar-brand-icon img {
            transition: transform 0.3s ease;
        }
        .sidebar .sidebar-brand:hover .sidebar-brand-icon img {
            transform: scale(1.1) rotate(3deg);
        }
        hr.sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }
        .sidebar .nav-item {
            position: relative;
        }
        .sidebar .nav-item .nav-link {
            color: var(--sidebar-text);
            font-weight: 500;
            padding: 0.9rem 1.25rem;
            transition: all 0.2s ease-in-out;
            border-left: 4px solid transparent;
        }
        .sidebar .nav-item .nav-link:hover {
            color: var(--sidebar-text-active);
            background-color: var(--primary-darker);
            border-left-color: var(--primary-lighter);
        }
        .sidebar .nav-item.active .nav-link,
        .sidebar .nav-link.active {
            color: var(--sidebar-text-active);
            font-weight: 600;
            background-color: var(--primary-darker);
            border-left-color: #ffffff;
        }
        .sidebar .nav-item .nav-link i {
            font-size: 1em;
            width: 24px;
            text-align: center;
            margin-right: 0.75rem;
        }
        .sidebar .dropdown-menu {
            background-color: var(--primary-lighter);
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .sidebar .dropdown-item {
            color: var(--sidebar-text);
            padding: 0.6rem 1.5rem;
            transition: background-color 0.2s ease;
        }
        .sidebar .dropdown-item:hover, .sidebar .dropdown-item:focus {
            background-color: var(--primary-darker);
            color: var(--sidebar-text-active);
        }
        .sidebar .dropdown-item i {
            margin-right: 0.5rem;
        }
        .card {
            border-radius: 16px;
            box-shadow: 0 2px 16px 0 rgba(0,0,0,0.07);
            border: none;
            margin-bottom: 2rem;
        }
        .card-header {
            background: #f8fafc;
            border-radius: 16px 16px 0 0;
            font-weight: 700;
            font-size: 1.15rem;
            color: #1e293b;
            border-bottom: 1.5px solid #e5e7eb;
        }
        .table th, .table td {
            padding: 0.55rem 0.7rem;
            vertical-align: middle;
            border-top: none;
            border-bottom: 1.5px solid #e5e7eb;
            background: transparent;
        }
        .table thead th {
            background: #f1f5f9;
            font-weight: 600;
            border-bottom: 2px solid #d1d5db;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            --bs-table-accent-bg: #f8fafc;
        }
        .badge {
            border-radius: 8px;
            font-size: 0.85em;
            padding: 0.35em 0.7em;
            font-weight: 500;
            letter-spacing: 0.01em;
        }
        .badge.bg-success {
            background: #4ade80 !important;
            color: #065f46 !important;
        }
        .badge.bg-danger {
            background: #f87171 !important;
            color: #7f1d1d !important;
        }
        .badge.bg-warning {
            background: #facc15 !important;
            color: #92400e !important;
        }
        .badge.bg-dark {
            background: #334155 !important;
            color: #fff !important;
        }
        .badge.bg-primary {
            background: #60a5fa !important;
            color: #1e3a8a !important;
        }
        .badge.bg-info {
            background: #38bdf8 !important;
            color: #0369a1 !important;
        }
        .btn {
            border-radius: 7px !important;
            font-size: 0.97em;
            font-weight: 500;
            transition: background 0.18s, box-shadow 0.18s;
            box-shadow: 0 2px 8px 0 rgba(37,99,235,0.07);
        }
        .btn-primary, .btn-success, .btn-danger, .btn-warning, .btn-info {
            border: none;
        }
        .btn-primary {
            background: #2563eb;
        }
        .btn-primary:hover {
            background: #1d4ed8;
        }
        .btn-success {
            background: #22c55e;
        }
        .btn-success:hover {
            background: #16a34a;
        }
        .btn-danger {
            background: #ef4444;
        }
        .btn-danger:hover {
            background: #b91c1c;
        }
        .btn-warning {
            background: #facc15;
            color: #92400e;
        }
        .btn-warning:hover {
            background: #eab308;
            color: #78350f;
        }
        .btn-info {
            background: #38bdf8;
            color: #0369a1;
        }
        .btn-info:hover {
            background: #0ea5e9;
            color: #075985;
        }
        .btn-sm {
            padding: 0.32em 1.1em;
            font-size: 0.93em;
        }
        .clickable-row {
            cursor: pointer;
            transition: background 0.18s;
        }
        .clickable-row:hover {
            background: #f1f5f9 !important;
        }
        .table-responsive {
            margin-bottom: 0.5rem;
        }
        @media (max-width: 768px) {
            .table th, .table td {
                padding: 0.45rem 0.3rem;
                font-size: 0.98em;
            }
            .btn-sm {
                font-size: 0.91em;
                padding: 0.28em 0.7em;
            }
            .card-header {
                font-size: 1.01rem;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion p-0 navbar-dark" style="min-height: 100vh; position: fixed; left: 0; top: 0; width: 225px; z-index: 1030;">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon">
                        <img class="img-fluid" src="{{ asset('storage/assets/img/Logo/TAKU_White.png') }}" width="100px" alt="Logo TAKU">
                    </div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item">
                        <a class="nav-link" href="/dosen/beranda"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link active" href="/dosen/daftar_topik"><i class="far fa-file-alt"></i><span>Daftar Topik</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dosen/template_laporan"><i class="fas fa-file-word"></i><span>Template Laporan</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dosen/pembimbing-dua"><i class="fas fa-user-friends"></i><span>Pembimbing Dua</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dosen/bimbingan"><i class="fas fa-file-word"></i><span>Bimbingan</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dosen/penilaian-kelompok"><i class="fas fa-pencil-alt"></i><span>Penilaian Kelompok</span></a>
                    </li>
                    <li class="nav-item mt-auto">
                        <hr class="sidebar-divider my-0">
                        <a class="nav-link" href="/dosen/profil"><i class="fas fa-user"></i><span>Profil</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i><span>Keluar</span></a>
                    </li>
                </ul>
                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
                </div>
            </div>
        </nav>

        <div class="d-flex flex-column" id="content-wrapper" style="margin-left: 225px;">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 12, 2019</span>
                                                <p>A new monthly report is ready to download!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 7, 2019</span>
                                                <p>$290.29 has been deposited into your account!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 2, 2019</span>
                                                <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                                            </div>
                                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </div>
                            </li>

                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::guard('dosen')->user()->nama_pengguna }}</span><span class="badge rounded-pill me-2" style="background: #881d1d;">Dosen</span><img class="border rounded-circle img-profile" src="{{ asset('/storage/assets/img/avatars/'.(Auth::guard('dosen')->user()->foto ?? 'default.jpg')) }}"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="/dosen/profil"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profil</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Keluar</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Daftar Topik</h3>
                    </div>
                    <!-- CARD: Topik yang Saya Buat -->
                    <div class="container-fluid mt-4">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h5 class="text-dark m-0 fw-bold">Topik yang Saya Buat</h5>
                                <button class="btn btn-sm link-light" type="button" style="background: #881d1d;" data-bs-toggle="modal" data-bs-target="#ModalTambahDaftarTopik">
                                    <i class="fas fa-plus"></i>&nbsp;Tambah Topik
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                    <table class="table table-striped table-hover" id="tableData">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Judul</th>
                                                <th class="text-center">Kode Dosen</th>
                                                <th class="text-center">Kuota</th>
                                                <th class="text-center">Bidang</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Modal Tambah Topik dipindahkan ke atas sebelum loop -->
                                            <div class="modal fade" role="dialog" tabindex="-1" id="ModalTambahDaftarTopik">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('daftar_topik.tambah') }}" method="post" enctype="multipart/form-data" id="formTambahTopik">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-dark" style="color: var(--bs-emphasis-color);font-weight: bold;">Tambah Topik</h5>
                                                                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label class="form-label text-dark" style="font-weight: bold;">Judul :</label>
                                                                <input class="form-control form-control-sm @error('judul') is-invalid @enderror" type="text" name="judul" placeholder="Judul Topik" required>
                                                                @error('judul')
                                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                    <br>
                                                                @enderror
                                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Fakultas :</label>
                                                                <select class="form-select form-select-sm @error('fakultas') is-invalid @enderror" name="fakultas" id="fakultasP" onchange="updateProgramStudiP()" required>
                                                                    <option value="" selected>-- Pilih Fakultas --</option>
                                                                    <option value="Fakultas Teknik Elektro (FTE)">Fakultas Teknik Elektro (FTE)</option>
                                                                    <option value="Fakultas Rekayasa Industri (FRI)">Fakultas Rekayasa Industri (FRI)</option>
                                                                    <option value="Fakultas Informatika (FIF)">Fakultas Informatika (FIF)</option>
                                                                    <option value="Fakultas Ekonomi dan Bisnis (FEB)">Fakultas Ekonomi dan Bisnis (FEB)</option>
                                                                    <option value="Fakultas Komunikasi dan Ilmu Sosial (FKI)">Fakultas Komunikasi dan Ilmu Sosial (FKI)</option>
                                                                    <option value="Fakultas Industri Kreatif (FIK)">Fakultas Industri Kreatif (FIK)</option>
                                                                    <option value="Fakultas Ilmu Terapan (FIT)">Fakultas Ilmu Terapan (FIT)</option>
                                                                </select>
                                                                @error('fakultas')
                                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                    <br>
                                                                @enderror
                                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Program Studi :</label>
                                                                <select class="form-select form-select-sm @error('program_studi') is-invalid @enderror" name="program_studi" id="program_studiP" required>
                                                                    <option value="" selected>-- Pilih Program Studi --</option>
                                                                </select>
                                                                @error('program_studi')
                                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                    <br>
                                                                @enderror
                                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Bidang :</label>
                                                                <select class="form-control bidang-edit-select" name="bidang[]" multiple required>
                                                                    @foreach($bidangList as $bidang)
                                                                        <option value="{{ $bidang }}" {{ (collect(old('bidang'))->contains($bidang)) ? 'selected' : '' }}>{{ $bidang }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('bidang')<div class="text-danger">{{ $message }}</div>@enderror
                                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Kuota (ditentukan admin):</label>
                                                                <input class="form-control form-control-sm @error('kuota') is-invalid @enderror" type="number" name="kuota" value="{{ $kuotaMax }}" readonly>
                                                                @error('kuota')
                                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                    <br>
                                                                @enderror
                                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Deskripsi :</label>
                                                                <textarea class="form-control form-control-sm @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="5" placeholder="Deskripsi Tentang Topik..." required></textarea>
                                                                @error('deskripsi')
                                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                    <br>
                                                                @enderror
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary btn-sm" type="reset">
                                                                    <i class="fa fa-refresh"></i>&nbsp;Bersihkan
                                                                </button>
                                                                <button class="btn btn-sm link-light" type="submit" style="background: #881d1d;">
                                                                    <i class="fa fa-save"></i>&nbsp;Simpan
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @foreach ($menampilkanDataDaftarTopik as $data)
                                            <tr class="clickable-row" data-bs-toggle="modal" data-bs-target="#ModalLihatDaftarTopik{{$data->id}}" data-id="{{ $data->id }}">
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{$data->judul}}</td>
                                                <td class="text-center">{{$data->kode_dosen}}</td>
                                                <td class="text-center">{{$data->kuota." Orang"}}</td>
                                                <td class="text-center">
                                                    @php $bidangItemList = $data->bidang; @endphp
                                                    @if ($bidangItemList)
                                                        @foreach ($bidangItemList as $bidang)
                                                            <span class="badge bg-dark me-1">{{$bidang}}</span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $jumlah_anggota = isset($data->anggota_kelompok) ? count($data->anggota_kelompok) : \App\Models\Kelompok::where('judul', $data->judul)->count();
                                                    @endphp
                                                    @if($data->status == 'Proposal')
                                                        <span class="badge rounded-pill bg-primary">Proposal</span>
                                                    @elseif($data->status == 'TA')
                                                        <span class="badge rounded-pill bg-info text-dark">Tugas Akhir</span>
                                                    @elseif($jumlah_anggota >= $kuotaMin)
                                                        <span class="badge rounded-pill {{ $jumlah_anggota >= $data->kuota ? 'bg-danger' : 'bg-warning text-dark' }}">
                                                            {{ $jumlah_anggota >= $data->kuota ? 'Full' : 'Siap Diterima' }}
                                                        </span>
                                                        @if(Auth::guard('dosen')->user()->kode_dosen == $data->kode_dosen)
                                                        <div class="mt-2">
                                                            <form action="{{ route('kelompok.terima') }}" method="POST" style="display:inline;" onclick="event.stopPropagation();" onmousedown="event.stopPropagation();">
                                                                @csrf
                                                                <input type="hidden" name="judul" value="{{ $data->judul }}">
                                                                <button type="submit" class="btn btn-success btn-sm ms-1" onclick="event.stopPropagation();" onmousedown="event.stopPropagation();">Diterima</button>
                                                            </form>
                                                            <button type="button" class="btn btn-danger btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#modalTolak{{ $data->id }}" onclick="event.stopPropagation();" onmousedown="event.stopPropagation();">Ditolak</button>
                                                            
                                                            
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @elseif($data->status == 'Available')
                                                        <span class="badge rounded-pill bg-success">Available</span>
                                                    @elseif($data->status == 'Booked')
                                                        <span class="badge rounded-pill bg-warning text-dark">Booked</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-warning text-dark">{{ $data->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <p class="text-center">
                                                        <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#ModalEditDaftarTopik{{$data->id}}" onclick="event.stopPropagation();" onmousedown="event.stopPropagation();">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm ms-1 me-1" type="button" data-bs-toggle="modal" data-bs-target="#ModalHapusDaftarTopik{{$data->id}}" onclick="event.stopPropagation();" onmousedown="event.stopPropagation();">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                        <button class="btn btn-success btn-sm ms-1" type="button" data-bs-toggle="modal" data-bs-target="#ModalTambahMahasiswa{{$data->id}}" onclick="event.stopPropagation();" onmousedown="event.stopPropagation();">
                                                            <i class="fas fa-user-plus"></i> Tambah Mahasiswa
                                                        </button>
                                                    </p>
                                                </td>
                                            </tr>
                                            @if($jumlah_anggota >= $kuotaMin && Auth::guard('dosen')->user()->kode_dosen == $data->kode_dosen)
                                            <!-- Modal Tolak -->
                                            <div class="modal fade" id="modalTolak{{ $data->id }}" tabindex="-1" aria-labelledby="modalTolakLabel{{ $data->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('kelompok.tolak_full') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="judul" value="{{ $data->judul }}">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalTolakLabel{{ $data->id }}">Alasan Penolakan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea name="alasan" class="form-control" required placeholder="Tulis alasan penolakan..."></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger">Tolak</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <!-- Modal Edit Topik -->
                                            <div class="modal fade bidang-modal" role="dialog" tabindex="-1" id="ModalEditDaftarTopik{{$data->id}}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('daftar_topik.edit', $data->id) }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="font-weight: bold;">Edit Daftar Topik</h5><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label class="form-label text-dark" style="font-weight: bold;">Judul :</label>
                                                                <input class="form-control form-control-sm @error('judul_'. $data->id) is-invalid @enderror" type="text" name="judul_{{$data->id}}" value="{{ old('judul', $data->judul) }}" placeholder="Judul Topik">
                                                                @error('judul_'.$data->id)
                                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                    <br>
                                                                @enderror
                                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Program Studi :</label>
                                                                <select class="form-select form-select-sm @error('program_studi_'.$data->id) is-invalid @enderror" name="program_studi_{{$data->id}}" id="program_studi{{ $data->id }}" data-default="{{ old('program_studi_' . $data->id, $data->program_studi) }}">
                                                                    <option value="">-- Pilih Program Studi --</option>
                                                                </select>
                                                                @error('program_studi_'.$data->id)
                                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                    <br>
                                                                @enderror
                                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Fakultas :</label>
                                                                <select class="form-select form-select-sm @error('fakultas_'.$data->id) is-invalid @enderror" name="fakultas_{{$data->id}}" id="fakultas{{ $data->id }}" onchange="updateProgramStudi({{ $data->id }})">
                                                                    <option selected>-- Pilih Fakultas --</option>
                                                                    <option value="Fakultas Teknik Elektro (FTE)" {{ old('fakultas', $data->fakultas) == 'Fakultas Teknik Elektro (FTE)' ? 'selected' : '' }}>Fakultas Teknik Elektro (FTE)</option>
                                                                    <option value="Fakultas Rekayasa Industri (FRI)" {{ old('fakultas', $data->fakultas) == 'Fakultas Rekayasa Industri (FRI)' ? 'selected' : '' }}>Fakultas Rekayasa Industri (FRI)</option>
                                                                    <option value="Fakultas Informatika (FIF)" {{ old('fakultas', $data->fakultas) == 'Fakultas Informatika (FIF)' ? 'selected' : '' }}>Fakultas Informatika (FIF)</option>
                                                                    <option value="Fakultas Ekonomi dan Bisnis (FEB)" {{ old('fakultas', $data->fakultas) == 'Fakultas Ekonomi dan Bisnis (FEB)' ? 'selected' : '' }}>Fakultas Ekonomi dan Bisnis (FEB)</option>
                                                                    <option value="Fakultas Komunikasi dan Ilmu Sosial (FKI)" {{ old('fakultas', $data->fakultas) == 'Fakultas Komunikasi dan Ilmu Sosial (FKI)' ? 'selected' : '' }}>Fakultas Komunikasi dan Ilmu Sosial (FKI)</option>
                                                                    <option value="Fakultas Industri Kreatif (FIK)" {{ old('fakultas', $data->fakultas) == 'Fakultas Industri Kreatif (FIK)' ? 'selected' : '' }}>Fakultas Industri Kreatif (FIK)</option>
                                                                    <option value="Fakultas Ilmu Terapan (FIT)" {{ old('fakultas', $data->fakultas) == 'Fakultas Ilmu Terapan (FIT)' ? 'selected' : '' }}>Fakultas Ilmu Terapan (FIT)</option>
                                                                </select>
                                                                @error('fakultas_'.$data->id)
                                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                    <br>
                                                                @enderror
                                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Bidang :</label>
                                                                <select class="form-control bidang-edit-select" name="bidang_{{$data->id}}[]" multiple required>
                                                                    @foreach($bidangList as $bidang)
                                                                        <option value="{{ $bidang }}" {{ (collect(old('bidang_'.$data->id, $data->bidang ?? []))->contains($bidang)) ? 'selected' : '' }}>{{ $bidang }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('bidang_'.$data->id)
                                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                    <br>
                                                                @enderror
                                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Kuota (ditentukan admin):</label>
                                                                <input class="form-control form-control-sm @error('kuota_'.$data->id) is-invalid @enderror" type="number" name="kuota_{{$data->id}}" value="{{ $kuotaMax }}" readonly disabled>
                                                                @error('kuota_'.$data->id)
                                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                    <br>
                                                                @enderror
                                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Deskripsi :</label>
                                                                <textarea class="form-control form-control-sm @error('deskripsi_'.$data->id) is-invalid @enderror" name="deskripsi_{{$data->id}}" rows="5" placeholder="Deskripsi Tentang Topik...">{{ old('deskripsi', $data->deskripsi) }}</textarea>
                                                                @error('deskripsi_'.$data->id)
                                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                    <br>
                                                                @enderror
                                                                @if($data->status == 'Proposal')
                                                                    <label class="form-label text-dark mt-3" style="font-weight: bold;">Status</label>
                                                                    <select class="form-select form-select-sm" name="status_{{ $data->id }}">
                                                                        <option value="Proposal" {{ $data->status == 'Proposal' ? 'selected' : '' }}>Proposal</option>
                                                                        <option value="Available" {{ $data->status == 'Available' ? 'selected' : '' }}>Available</option>
                                                                        <option value="Booked" {{ $data->status == 'Booked' ? 'selected' : '' }}>Booked</option>
                                                                        <option value="Full" {{ $data->status == 'Full' ? 'selected' : '' }}>Full</option>
                                                                        <option value="TA" {{ $data->status == 'TA' ? 'selected' : '' }}>Tugas Akhir</option>
                                                                    </select>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary btn-sm" type="reset">
                                                                    <i class="fa fa-refresh"></i>&nbsp;Bersihkan
                                                                </button>
                                                                <button class="btn btn-warning btn-sm" type="submit" style="font-weight: bold;">
                                                                    <i class="fa fa-save"></i>&nbsp;Perbarui
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Hapus Topik -->
                                            <div class="modal fade" role="dialog" tabindex="-1" id="ModalHapusDaftarTopik{{$data->id}}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" style="font-weight: bold;">Hapus Daftar Topik</h5><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h1 class="display-3"><i class="fas fa-exclamation-triangle"></i></h1>
                                                            <h6>Apakah anda yakin ingin menghapusnya?</h6>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal">
                                                                <i class="fa fa-close"></i>&nbsp;Tidak
                                                            </button>
                                                            <a href="{{ route('daftar_topik.hapus', $data->id) }}" class="btn btn-danger btn-sm" type="button">
                                                                <i class="far fa-trash-alt"></i>&nbsp;Ya, Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Detail Topik -->
                                            <div class="modal fade" role="dialog" tabindex="-1" id="ModalLihatDaftarTopik{{$data->id}}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" style="font-weight: bold;">Ditel Topik {{ $data->judul }}</h5>
                                                            <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-4"><span style="font-weight: bold;">Judul</span></div>
                                                                <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->judul }}</p></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4"><span style="font-weight: bold;">Jurusan</span></div>
                                                                <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->program_studi ?? '-' }}</p></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4"><span style="font-weight: bold;">Fakultas</span></div>
                                                                <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->fakultas ?? '-' }}</p></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4"><span style="font-weight: bold;">Bidang</span></div>
                                                                <div class="col-8">
                                                                    <p><span class="fw-bold">:&nbsp;</span>
                                                                        @if(is_array($data->bidang))
                                                                            @foreach($data->bidang as $bidang)
                                                                                <span class="badge bg-dark me-1">{{ $bidang }}</span>
                                                                            @endforeach
                                                                        @else
                                                                            <span class="badge bg-dark me-1">{{ $data->bidang }}</span>
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4"><span style="font-weight: bold;">Kuota</span></div>
                                                                <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->kuota }} Orang</p></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4"><span style="font-weight: bold;">Dosen</span></div>
                                                                <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->dosen ?? '-' }}</p></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4"><span style="font-weight: bold;">Kode Dosen</span></div>
                                                                <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->kode_dosen ?? '-' }}</p></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4"><span style="font-weight: bold;">Status</span></div>
                                                                <div class="col-8">
                                                                    @if($data->status == 'Proposal' || $data->status == 'TA')
                                                                        <span class="badge rounded-pill {{ $data->status == 'Proposal' ? 'bg-primary' : 'bg-info text-dark' }}">{{ $data->status }}</span>
                                                                        <form action="{{ route('daftar_topik.ubah_status', $data->id) }}" method="POST" class="mt-2">
                                                                            @csrf
                                                                            <select name="status" class="form-select form-select-sm d-inline w-auto" style="display:inline-block;">
                                                                                <option value="Available" {{ $data->status == 'Available' ? 'selected' : '' }}>Available</option>
                                                                                <option value="Booked" {{ $data->status == 'Booked' ? 'selected' : '' }}>Booked</option>
                                                                                <option value="Full" {{ $data->status == 'Full' ? 'selected' : '' }}>Full</option>
                                                                                <option value="Proposal" {{ $data->status == 'Proposal' ? 'selected' : '' }}>Proposal</option>
                                                                                <option value="TA" {{ $data->status == 'TA' ? 'selected' : '' }}>Tugas Akhir</option>
                                                                            </select>
                                                                            <button type="submit" class="btn btn-primary btn-sm ms-1">Ubah Status</button>
                                                                        </form>
                                                                    @elseif($data->status == 'Full')
                                                                        <span class="badge rounded-pill bg-danger">Full</span>
                                                                    @elseif($data->status == 'Available')
                                                                        <span class="badge rounded-pill bg-success">Available</span>
                                                                    @elseif($data->status == 'Booked')
                                                                        <span class="badge rounded-pill bg-warning text-dark">Booked</span>
                                                                    @else
                                                                        <span class="badge rounded-pill bg-warning text-dark">{{ $data->status }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4"><span style="font-weight: bold;">Anggota</span></div>
                                                                <div class="col-8">
                                                                    <p><span class="fw-bold">:&nbsp;</span>
                                                                        <div class="kelompok-badge-list">
                                                                        @if(isset($data->anggota_kelompok) && count($data->anggota_kelompok) > 0)
                                                                            @foreach($data->anggota_kelompok as $anggota)
                                                                                <span class="badge rounded-pill bg-dark m-1">{{ $anggota->nama_anggota }} ({{ $anggota->nim }})</span>
                                                                            @endforeach
                                                                        @else
                                                                            -
                                                                        @endif
                                                                        </div>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4"><span style="font-weight: bold;">Deskripsi</span></div>
                                                                <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->deskripsi ?? '-' }}</p></div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Tambah Mahasiswa -->
                                            <div class="modal fade" id="ModalTambahMahasiswa{{$data->id}}" tabindex="-1" aria-labelledby="ModalTambahMahasiswaLabel{{$data->id}}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('daftar_topik.tambah_mahasiswa', $data->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="ModalTambahMahasiswaLabel{{$data->id}}">Tambah Mahasiswa ke Topik</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label class="form-label">Nama atau NIM</label>
                                                                <select name="nim" class="form-select select2-mahasiswa" required>
                                                                    <option value="">-- Pilih Mahasiswa --</option>
                                                                    @foreach($daftarMahasiswa as $mhs)
                                                                        <option value="{{ $mhs->nim }}">{{ $mhs->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-success">Tambah</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($data->status == 'Menunggu Pembimbing')
                                                <form action="{{ route('dosen.ambil_topik_mahasiswa', $data->id) }}" method="POST" style="display:inline;" onclick="event.stopPropagation();" onmousedown="event.stopPropagation();">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="event.stopPropagation();" onmousedown="event.stopPropagation();">Ambil Topik</button>
                                                </form>
                                            @endif
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-center"><strong>No</strong></td>
                                                <td class="text-center"><strong>Judul</strong></td>
                                                <td class="text-center"><strong>Kode Dosen</strong></td>
                                                <td class="text-center"><strong>Kuota</strong></td>
                                                <td class="text-center"><strong>Bidang</strong></td>
                                                <td class="text-center"><strong>Status</strong></td>
                                                <td class="text-center"><strong>Aksi</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CARD: Topik dari Mahasiswa -->
                    <div class="container-fluid mt-4">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h5 class="text-dark m-0 fw-bold">Topik dari Mahasiswa</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table mt-2">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Judul</th>
                                                <th class="text-center">Program Studi</th>
                                                <th class="text-center">Fakultas</th>
                                                <th class="text-center">Bidang</th>
                                                <th class="text-center">Kuota</th>
                                                <th class="text-center">Deskripsi</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topikMahasiswa as $data)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $data->judul }}</td>
                                                <td class="text-center">{{ $data->program_studi }}</td>
                                                <td class="text-center">{{ $data->fakultas }}</td>
                                                <td class="text-center">
                                                    @if(is_array($data->bidang))
                                                        @foreach($data->bidang as $bidang)
                                                            <span class="badge bg-dark me-1">{{ $bidang }}</span>
                                                        @endforeach
                                                    @else
                                                        <span class="badge bg-dark me-1">{{ $data->bidang }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $data->kuota }}</td>
                                                <td class="text-center">{{ $data->deskripsi }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDetailTopikMahasiswa{{ $data->id }}">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </button>
                                                    <form action="{{ route('dosen.ambil_topik_mahasiswa', $data->id) }}" method="POST" style="display:inline;" onclick="event.stopPropagation();">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm ms-1" onclick="event.stopPropagation();">Ambil Topik</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @foreach ($topikMahasiswa as $data)
                                        <div class="modal fade" id="ModalDetailTopikMahasiswa{{ $data->id }}" tabindex="-1" aria-labelledby="ModalDetailTopikMahasiswaLabel{{ $data->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ModalDetailTopikMahasiswaLabel{{ $data->id }}">Detail Topik Mahasiswa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-4"><span style="font-weight: bold;">Judul</span></div>
                                                            <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->judul }}</p></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4"><span style="font-weight: bold;">Program Studi</span></div>
                                                            <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->program_studi ?? '-' }}</p></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4"><span style="font-weight: bold;">Fakultas</span></div>
                                                            <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->fakultas ?? '-' }}</p></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4"><span style="font-weight: bold;">Bidang</span></div>
                                                            <div class="col-8">
                                                                <p><span class="fw-bold">:&nbsp;</span>
                                                                    @if(is_array($data->bidang))
                                                                        @foreach($data->bidang as $bidang)
                                                                            <span class="badge bg-dark me-1">{{ $bidang }}</span>
                                                                        @endforeach
                                                                    @else
                                                                        <span class="badge bg-dark me-1">{{ $data->bidang }}</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4"><span style="font-weight: bold;">Kuota</span></div>
                                                            <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->kuota }} Orang</p></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4"><span style="font-weight: bold;">Deskripsi</span></div>
                                                            <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->deskripsi }}</p></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CARD: Topik dari Dosen Lain -->
                    <div class="container-fluid mt-4">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h5 class="text-dark m-0 fw-bold">Topik dari Dosen Lain</h5>
                                <div style="min-width:220px;">
                                    <input type="text" id="searchJudulDosenLain" class="form-control form-control-sm" placeholder="Cari Judul Topik dari Dosen Lain">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table mt-2">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Judul</th>
                                                <th class="text-center">Kode Dosen</th>
                                                <th class="text-center">Kuota</th>
                                                <th class="text-center">Bidang</th>
                                                <th class="text-center">Status</th>
                                                <!-- Hapus kolom Aksi -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($semuaTopik as $data)
                                                @if($data->kode_dosen != Auth::guard('dosen')->user()->kode_dosen && $data->kode_dosen != null)
                                                <tr class="clickable-row" data-bs-toggle="modal" data-bs-target="#ModalLihatDaftarTopikLain{{ $data->id }}" data-id="{{ $data->id }}">
                                                    <td class="text-center">{{ $no++ }}</td>
                                                    <td class="text-center">{{$data->judul}}</td>
                                                    <td class="text-center">{{$data->kode_dosen}}</td>
                                                    <td class="text-center">{{$data->kuota." Orang"}}</td>
                                                    <td class="text-center">
                                                        @php $bidangItemList = $data->bidang; @endphp
                                                        @if ($bidangItemList)
                                                            @foreach ($bidangItemList as $bidang)
                                                                <span class="badge bg-dark me-1">{{$bidang}}</span>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @php
                                                            $jumlah_anggota = isset($data->anggota_kelompok) ? count($data->anggota_kelompok) : \App\Models\Kelompok::where('judul', $data->judul)->count();
                                                        @endphp
                                                        @if($data->status == 'Proposal')
                                                            <span class="badge rounded-pill bg-primary">Proposal</span>
                                                        @elseif($data->status == 'TA')
                                                            <span class="badge rounded-pill bg-info text-dark">Tugas Akhir</span>
                                                        @elseif($jumlah_anggota >= $kuotaMin)
                                                            <span class="badge rounded-pill {{ $jumlah_anggota >= $data->kuota ? 'bg-danger' : 'bg-warning text-dark' }}">
                                                                {{ $jumlah_anggota >= $data->kuota ? 'Full' : 'Siap Diterima' }}
                                                            </span>
                                                            @if(Auth::guard('dosen')->user()->kode_dosen == $data->kode_dosen)
                                                            <div class="mt-2">
                                                                <form action="{{ route('kelompok.terima') }}" method="POST" style="display:inline;" onclick="event.stopPropagation();" onmousedown="event.stopPropagation();">
                                                                    @csrf
                                                                    <input type="hidden" name="judul" value="{{ $data->judul }}">
                                                                    <button type="submit" class="btn btn-success btn-sm ms-1" onclick="event.stopPropagation();" onmousedown="event.stopPropagation();">Diterima</button>
                                                                </form>
                                                                <button type="button" class="btn btn-danger btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#modalTolak{{ $data->id }}" onclick="event.stopPropagation();" onmousedown="event.stopPropagation();">Ditolak</button>
                                                            </div>
                                                            @endif
                                                        @elseif($data->status == 'Available')
                                                            <span class="badge rounded-pill bg-success">Available</span>
                                                        @elseif($data->status == 'Booked')
                                                            <span class="badge rounded-pill bg-warning text-dark">Booked</span>
                                                        @else
                                                            <span class="badge rounded-pill bg-warning text-dark">{{ $data->status }}</span>
                                                        @endif
                                                    </td>
                                                    <!-- Hapus kolom aksi dan btn-eye di sini -->
                                                </tr>
                                                <!-- Modal Ditel Topik Dosen Lain Dinamis tetap dipertahankan di luar kolom aksi -->
                                                <div class="modal fade" role="dialog" tabindex="-1" id="ModalLihatDaftarTopikLain{{ $data->id }}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="font-weight: bold;">Ditel Topik Dosen Lain {{ $data->judul }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-4"><span style="font-weight: bold;">Judul</span></div>
                                                                    <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->judul }}</p></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4"><span style="font-weight: bold;">Jurusan</span></div>
                                                                    <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->program_studi ?? '-' }}</p></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4"><span style="font-weight: bold;">Fakultas</span></div>
                                                                    <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->fakultas ?? '-' }}</p></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4"><span style="font-weight: bold;">Bidang</span></div>
                                                                    <div class="col-8">
                                                                        <p><span class="fw-bold">:&nbsp;</span>
                                                                            @if(is_array($data->bidang))
                                                                                @foreach($data->bidang as $bidang)
                                                                                    <span class="badge bg-dark me-1">{{ $bidang }}</span>
                                                                                @endforeach
                                                                            @else
                                                                                <span class="badge bg-dark me-1">{{ $data->bidang }}</span>
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4"><span style="font-weight: bold;">Kuota</span></div>
                                                                    <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->kuota }} Orang</p></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4"><span style="font-weight: bold;">Dosen</span></div>
                                                                    <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->dosen ?? '-' }}</p></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4"><span style="font-weight: bold;">Kode Dosen</span></div>
                                                                    <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->kode_dosen ?? '-' }}</p></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4"><span style="font-weight: bold;">Status</span></div>
                                                                    <div class="col-8">
                                                                        <p><span class="fw-bold">:&nbsp;</span>
                                                                            @if($data->status == 'Available')
                                                                                <span class="badge rounded-pill bg-success">Available</span>
                                                                            @elseif($data->status == 'Booked')
                                                                                <span class="badge rounded-pill bg-warning text-dark">Booked</span>
                                                                            @elseif($data->status == 'Full')
                                                                                <span class="badge rounded-pill bg-danger">Full</span>
                                                                            @else
                                                                                <span class="badge rounded-pill bg-primary">{{ $data->status }}</span>
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4"><span style="font-weight: bold;">Anggota</span></div>
                                                                    <div class="col-8">
                                                                        <p><span class="fw-bold">:&nbsp;</span>
                                                                            <div class="kelompok-badge-list">
                                                                            @if(isset($data->anggota_kelompok) && count($data->anggota_kelompok) > 0)
                                                                                @foreach($data->anggota_kelompok as $anggota)
                                                                                    <span class="badge rounded-pill bg-dark m-1">{{ $anggota->nama_anggota }} ({{ $anggota->nim }})</span>
                                                                                @endforeach
                                                                            @else
                                                                                -
                                                                            @endif
                                                                            </div>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4"><span style="font-weight: bold;">Deskripsi</span></div>
                                                                    <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $data->deskripsi ?? '-' }}</p></div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-center"><strong>No</strong></td>
                                                <td class="text-center"><strong>Judul</strong></td>
                                                <td class="text-center"><strong>Kode Dosen</strong></td>
                                                <td class="text-center"><strong>Kuota</strong></td>
                                                <td class="text-center"><strong>Bidang</strong></td>
                                                <td class="text-center"><strong>Status</strong></td>
                                                <!-- Hapus kolom Aksi di tfoot -->
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © TAKU 2025</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('/storage/assets/js/theme.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
        // Tooltips (inisialisasi untuk semua .tooltip-btn)
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('.tooltip-btn'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Datatables
        $(document).ready( function () {
            $('#tableData').DataTable({
                language: {
                    lengthMenu: "Tampilkan _MENU_ entri per halaman",
                    search: "",
                    info: "Menampilkan _START_ Sampai _END_ Dari _TOTAL_ Entri",
                    infoEmpty: "Menampilkan 0 Sampai 0 Dari 0 Entri",
                    emptyTable: "Tidak Ada Data Tersedia",
                    zeroRecords: "Tidak Ditemukan Hasil",
                },
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
                columnDefs: [{
                    targets: 6,
                    searchable: false,
                    orderable: false,
                },{
                    targets: 0,
                    searchable: false,
                }],
                layout: {
                    topEnd: {
                        search: {
                            placeholder: 'Cari Data Anda...'
                        }
                    }
                }
            });
        });

        // Form Select Fakultas dan Program Studi
        const dataProdi = {
            "Fakultas Teknik Elektro (FTE)": ["S1 Teknik Elektro", "S1 Teknik Telekomunikasi", "S1 Teknik Fisika", "S1 Teknik Komputer", "S1 Teknik Biomedis", "S1 Teknik Sistem Energi", "S1 Teknik Telekomunikasi (Jakarta)", "S2 Teknik Elektro", "S3 Teknik Elektro"],
            "Fakultas Rekayasa Industri (FRI)": ["S1 Teknik Industri", "S1 Sistem Informasi", "S1 Teknik Logistik", "S1 Manajemen Rekayasa", "S1 Sistem Informasi (Jakarta)", "S2 Teknik Industri", "S2 Sistem Informasi"],
            "Fakultas Informatika (FIF)": ["S1 Informatika", "S1 Teknologi Informasi", "S1 Informatika PJJ", "S1 Sains Data", "S1 Rekayasa Perangkat Lunak", "S1 Teknologi Informasi (Jakarta)", "S2 Informatika", "S2 Ilmu Forensik", "S3 Informatika"],
            "Fakultas Ekonomi dan Bisnis (FEB)": ["S1 Manajemen Bisnis Telekomunikasi & Informatika (MBTI)", "S1 Akuntansi", "S1 Leisure Management", "S1 Administrasi Bisnis", "S1 Bisnis Digital", "S2 Manajemen", "S2 Manajemen PJJ", "S2 Administrasi Bisnis"],
            "Fakultas Komunikasi dan Ilmu Sosial (FKI)": ["S1 Ilmu Komunikasi", "S1 Hubungan Masyarakat", "S1 Digital Content Brodcating", "S1 Psikologi", "S2 Ilmu Komunikasi"],
            "Fakultas Industri Kreatif (FIK)": ["S1 Desain Komunikasi Visual", "S1 Desian Produk", "S1 Desain Interior", "S1 Seni Rupa", "S1 Kriya", "S1 Film dan Animasi", "S1 Desain Komunikasi Visual (Jakarta)", "S2 Desain"],
            "Fakultas Ilmu Terapan (FIT)": ["D3 Teknik Telekomunikasi", "D3 Rekayasa Perangkat Lunak Aplikasi", "D3 Sistem Informasi", "D3 Sistem Informasi Akuntansi", "D3 Teknologi Komputer", "D3 Digital Marketing", "D3 Hospitality & Culinary Art", "D3 Teknik Telekomunikasi (Jakarat)", "S1 Terapan Digital Creative Multimedia", "S1 Terapan Sistem Informasi Kota Cerdas"]
        };
    
   function updateProgramStudi(id) {
      // Ambil elemen berdasarkan id dinamis
      const fakultasEl = document.getElementById('fakultas' + id);
      const prodiEl = document.getElementById('program_studi' + id);
      // Ambil nilai default program studi dari atribut data-default
      const defaultProdi = prodiEl.getAttribute('data-default') || '';

      // Bersihkan opsi-opsi yang ada dan tambahkan opsi awal
      prodiEl.innerHTML = '<option value="">-- Pilih Program Studi --</option>';

      const fakultasVal = fakultasEl.value;
      if (dataProdi[fakultasVal]) {
        dataProdi[fakultasVal].forEach(function(prodi) {
          const option = document.createElement('option');
          option.value = prodi;
          option.text = prodi;
          // Tandai opsi jika sama dengan nilai default
          if (prodi === defaultProdi) {
            option.selected = true;
          }
          prodiEl.add(option);
        });
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      // Kita asumsikan variabel $mahasiswa merupakan koleksi data yang dikirimkan dari controller
      // Gunakan Blade untuk membentuk array id, misalnya:
      const idList = @json($menampilkanDataDaftarTopik->pluck('id'));
      
      // Loop untuk setiap data mahasiswa
      idList.forEach(function(id) {
        updateProgramStudi(id);
        document.getElementById('fakultas' + id).addEventListener('change', function() {
          updateProgramStudi(id);
        });
      });
    });

        const dataP = {
            "Fakultas Teknik Elektro (FTE)": ["S1 Teknik Elektro", "S1 Teknik Telekomunikasi", "S1 Teknik Fisika", "S1 Teknik Komputer", "S1 Teknik Biomedis", "S1 Teknik Sistem Energi", "S1 Teknik Telekomunikasi (Jakarta)", "S2 Teknik Elektro", "S3 Teknik Elektro"],
            "Fakultas Rekayasa Industri (FRI)": ["S1 Teknik Industri", "S1 Sistem Informasi", "S1 Teknik Logistik", "S1 Manajemen Rekayasa", "S1 Sistem Informasi (Jakarta)", "S2 Teknik Industri", "S2 Sistem Informasi"],
            "Fakultas Informatika (FIF)": ["S1 Informatika", "S1 Teknologi Informasi", "S1 Informatika PJJ", "S1 Sains Data", "S1 Rekayasa Perangkat Lunak", "S1 Teknologi Informasi (Jakarta)", "S2 Informatika", "S2 Ilmu Forensik", "S3 Informatika"],
            "Fakultas Ekonomi dan Bisnis (FEB)": ["S1 Manajemen Bisnis Telekomunikasi & Informatika (MBTI)", "S1 Akuntansi", "S1 Leisure Management", "S1 Administrasi Bisnis", "S1 Bisnis Digital", "S2 Manajemen", "S2 Manajemen PJJ", "S2 Administrasi Bisnis"],
            "Fakultas Komunikasi dan Ilmu Sosial (FKI)": ["S1 Ilmu Komunikasi", "S1 Hubungan Masyarakat", "S1 Digital Content Brodcating", "S1 Psikologi", "S2 Ilmu Komunikasi"],
            "Fakultas Industri Kreatif (FIK)": ["S1 Desain Komunikasi Visual", "S1 Desian Produk", "S1 Desain Interior", "S1 Seni Rupa", "S1 Kriya", "S1 Film dan Animasi", "S1 Desain Komunikasi Visual (Jakarta)", "S2 Desain"],
            "Fakultas Ilmu Terapan (FIT)": ["D3 Teknik Telekomunikasi", "D3 Rekayasa Perangkat Lunak Aplikasi", "D3 Sistem Informasi", "D3 Sistem Informasi Akuntansi", "D3 Teknologi Komputer", "D3 Digital Marketing", "D3 Hospitality & Culinary Art", "D3 Teknik Telekomunikasi (Jakarat)", "S1 Terapan Digital Creative Multimedia", "S1 Terapan Sistem Informasi Kota Cerdas"]
        };

        window.updateProgramStudiP = function() {
            const fakultasP = document.getElementById('fakultasP').value;
            const programStudiSelectP = document.getElementById('program_studiP');
            programStudiSelectP.innerHTML = '<option value="">-- Pilih Program Studi --</option>';
            if (dataP[fakultasP]) {
                dataP[fakultasP].forEach(function(prodi) {
                    const option = document.createElement('option');
                    option.value = prodi;
                    option.text = prodi;
                    programStudiSelectP.add(option);
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('fakultasP') && document.getElementById('fakultasP').value) {
                window.updateProgramStudiP();
            }
        });

    $(document).ready(function() {
        $('#bidang').select2({
            placeholder: "-- Pilih Bidang --",
            dropdownParent: $('#ModalTambahDaftarTopik'),
            width: '100%'
        });
    });

$(document).ready(function() {
    // Fungsi untuk inisialisasi Select2 pada modal tertentu
    function initSelect2ForModal(modalId) {
        $(modalId).on('shown.bs.modal', function() {
            // Cari select bidang dalam modal ini
            var select = $('.bidang-select', this);
            
            // Inisialisasi Select2
            select.select2({
                placeholder: "-- Pilih Bidang --",
                dropdownParent: $(this), // Mengarah ke modal yang sedang aktif
                width: '100%'
            });
        });

        // Hancurkan Select2 saat modal ditutup
        $(modalId).on('hidden.bs.modal', function() {
            $('.bidang-select', this).select2('destroy');
        });
    }

    // Inisialisasi untuk semua modal yang ada
    @foreach($modalTopik as $data)
        initSelect2ForModal('#ModalEditDaftarTopik{{ $data->id }}');
    @endforeach
});

$(document).ready(function() {
    // Inisialisasi select2 pada setiap kali modal tambah mahasiswa dibuka
    $('body').on('shown.bs.modal', '.modal', function () {
        var $select = $(this).find('.select2-mahasiswa');
        if ($select.length && !$select.hasClass('select2-hidden-accessible')) {
            $select.select2({
                dropdownParent: $(this),
                placeholder: '-- Pilih Mahasiswa --',
                width: '100%',
                matcher: function(params, data) {
                    if ($.trim(params.term) === '') {
                        return data;
                    }
                    if (typeof data.text === 'undefined') {
                        return null;
                    }
                    var term = params.term.toLowerCase();
                    var text = data.text.toLowerCase();
                    var nim = $(data.element).val().toLowerCase();
                    if (text.indexOf(term) > -1 || nim.indexOf(term) > -1) {
                        return data;
                    }
                    return null;
                }
            });
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('searchJudulDosenLain');
    if (input) {
        input.addEventListener('keyup', function() {
            const filter = input.value.toLowerCase();
            // Cari table terdekat di dalam card-body
            const table = input.closest('.card-body').querySelector('table');
            const trs = table.querySelectorAll('tbody tr');
            trs.forEach(function(row) {
                // Kolom judul ada di kolom ke-2 (index 1)
                const judul = row.children[1]?.textContent.toLowerCase() || '';
                if (judul.indexOf(filter) > -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
});

$(document).ready(function() {
    $('#tableData').on('init.dt', function() {
        $('.dataTables_filter input[type="search"]').addClass('form-control form-control-sm').attr('placeholder', 'Cari Data Anda...');
    });
    // Untuk jaga-jaga jika event di atas tidak terpanggil
    setTimeout(function() {
        $('.dataTables_filter input[type="search"]').addClass('form-control form-control-sm').attr('placeholder', 'Cari Data Anda...');
    }, 500);
});

$(document).ready(function() {
    // DataTables v2 search input
    $('.dt-search input.dt-input[type="search"]').addClass('form-control form-control-sm');
});

document.querySelectorAll('.clickable-row').forEach(function(row) {
  row.addEventListener('click', function(e) {
    // Jika ada modal yang sedang terbuka, atau klik pada backdrop modal, abaikan klik baris
    if (e.target.closest('.modal') || e.target.classList.contains('modal-backdrop') || document.querySelector('.modal.show')) {
      return;
    }
    if (
      e.target.closest('form') ||
      e.target.closest('button') ||
      e.target.tagName === 'BUTTON' ||
      e.target.tagName === 'A' ||
      e.target.classList.contains('btn')
    ) {
      return;
    }
    // Tutup semua modal yang masih terbuka sebelum buka modal baru
    document.querySelectorAll('.modal.show').forEach(function(openModal) {
      var modalInstance = bootstrap.Modal.getInstance(openModal);
      if (modalInstance) modalInstance.hide();
    });
    // Hapus backdrop jika ada
    document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
      backdrop.parentNode.removeChild(backdrop);
    });
    var target = row.getAttribute('data-bs-target');
    if (target) {
      var modal = document.querySelector(target);
      if (modal) {
        // Pastikan opsi default (bisa tutup dengan klik backdrop)
        var modalInstance = new bootstrap.Modal(modal);
        modalInstance.show();
      }
    }
  });
});



try {
    const dataP = {
        "Fakultas Teknik Elektro (FTE)": ["S1 Teknik Elektro", "S1 Teknik Telekomunikasi", "S1 Teknik Fisika", "S1 Teknik Komputer", "S1 Teknik Biomedis", "S1 Teknik Sistem Energi", "S1 Teknik Telekomunikasi (Jakarta)", "S2 Teknik Elektro", "S3 Teknik Elektro"],
        "Fakultas Rekayasa Industri (FRI)": ["S1 Teknik Industri", "S1 Sistem Informasi", "S1 Teknik Logistik", "S1 Manajemen Rekayasa", "S1 Sistem Informasi (Jakarta)", "S2 Teknik Industri", "S2 Sistem Informasi"],
        "Fakultas Informatika (FIF)": ["S1 Informatika", "S1 Teknologi Informasi", "S1 Informatika PJJ", "S1 Sains Data", "S1 Rekayasa Perangkat Lunak", "S1 Teknologi Informasi (Jakarta)", "S2 Informatika", "S2 Ilmu Forensik", "S3 Informatika"],
        "Fakultas Ekonomi dan Bisnis (FEB)": ["S1 Manajemen Bisnis Telekomunikasi & Informatika (MBTI)", "S1 Akuntansi", "S1 Leisure Management", "S1 Administrasi Bisnis", "S1 Bisnis Digital", "S2 Manajemen", "S2 Manajemen PJJ", "S2 Administrasi Bisnis"],
        "Fakultas Komunikasi dan Ilmu Sosial (FKI)": ["S1 Ilmu Komunikasi", "S1 Hubungan Masyarakat", "S1 Digital Content Brodcating", "S1 Psikologi", "S2 Ilmu Komunikasi"],
        "Fakultas Industri Kreatif (FIK)": ["S1 Desain Komunikasi Visual", "S1 Desian Produk", "S1 Desain Interior", "S1 Seni Rupa", "S1 Kriya", "S1 Film dan Animasi", "S1 Desain Komunikasi Visual (Jakarta)", "S2 Desain"],
        "Fakultas Ilmu Terapan (FIT)": ["D3 Teknik Telekomunikasi", "D3 Rekayasa Perangkat Lunak Aplikasi", "D3 Sistem Informasi", "D3 Sistem Informasi Akuntansi", "D3 Teknologi Komputer", "D3 Digital Marketing", "D3 Hospitality & Culinary Art", "D3 Teknik Telekomunikasi (Jakarat)", "S1 Terapan Digital Creative Multimedia", "S1 Terapan Sistem Informasi Kota Cerdas"]
    };

    window.updateProgramStudiP = function() {
        const fakultasP = document.getElementById('fakultasP').value;
        const programStudiSelectP = document.getElementById('program_studiP');
        programStudiSelectP.innerHTML = '<option value="">-- Pilih Program Studi --</option>';
        if (dataP[fakultasP]) {
            dataP[fakultasP].forEach(function(prodi) {
                const option = document.createElement('option');
                option.value = prodi;
                option.text = prodi;
                programStudiSelectP.add(option);
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('fakultasP') && document.getElementById('fakultasP').value) {
            window.updateProgramStudiP();
        }
    });
} catch(e) { console.error('Dropdown Prodi Error:', e); }

document.addEventListener('DOMContentLoaded', function() {
    // ... kode lain ...
    const bidangSelectDosen = document.getElementById('bidangSelectDosen');
    if (bidangSelectDosen) {
        new Choices(bidangSelectDosen, {
            removeItemButton: true,
            searchResultLimit: 100,
            shouldSort: false,
            placeholder: true,
            placeholderValue: 'Pilih bidang...'
        });
    }
    // ... kode lain ...
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.bidang-edit-select').forEach(function(select) {
        new Choices(select, {
            removeItemButton: true,
            searchResultLimit: 100,
            shouldSort: false,
            placeholder: true,
            placeholderValue: 'Pilih bidang...'
        });
    });
});
</script>
</body>
</html>