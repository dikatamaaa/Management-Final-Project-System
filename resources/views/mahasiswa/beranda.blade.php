<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Mahasiswa</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            transition: all 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            width: 250px;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .sidebar .sidebar-brand {
            height: 60px;
            transition: background-color 0.2s ease;
        }
        .sidebar .sidebar-brand:hover {
            /* background-color: var(--primary-darker); */
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
        
        /* Footer styling */
        .sticky-footer {
            position: relative;
            bottom: 0;
            width: 100%;
            padding: 1rem 0;
            border-top: 1px solid #e5e7eb;
            background: #ffffff;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
            margin-top: auto;
        }
        
        /* Ensure content wrapper takes full height */
        #content-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        /* Make content area flexible */
        #content {
            flex: 1 0 auto;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 280px;
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            #content-wrapper {
                margin-left: 0 !important;
                width: 100% !important;
                min-height: 100vh;
            }
            .sticky-footer {
                margin-top: auto;
            }
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
        <nav class="navbar align-items-start sidebar sidebar-dark accordion p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon">
                        <img class="img-fluid" src="{{ asset('storage/assets/img/Logo/TAKU_White.png') }}" width="100px" alt="Logo TAKU">
                    </div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item active">
                        <a class="nav-link active" href="/mahasiswa/beranda"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/daftar_topik"><i class="far fa-file-alt"></i><span>Daftar Topik</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/template_laporan"><i class="fas fa-file-word"></i><span>Template Laporan</span></a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/pembimbing-dua"><i class="fas fa-users"></i><span>Pembimbing 2</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/dokumen-bimbingan"><i class="fas fa-comments"></i><span>Bimbingan</span></a>
                    </li>
                    <li class="nav-item mt-auto">
                        <hr class="sidebar-divider my-0">
                        <a class="nav-link" href="/mahasiswa/profil"><i class="fas fa-user"></i><span>Profil</span></a>
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
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="badge bg-danger badge-counter">
                                            {{ Auth::guard('mahasiswa')->user()->unreadNotifications->count() }}
                                        </span>
                                        <i class="fas fa-bell fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">Alerts Center</h6>
                                        @forelse (Auth::guard('mahasiswa')->user()->notifications as $notif)
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="me-3">
                                                    <div class="bg-warning icon-circle">
                                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span class="small text-gray-500">{{ $notif->created_at->format('d M Y H:i') }}</span>
                                                    <p>{{ $notif->data['pesan'] }}</p>
                                                </div>
                                            </a>
                                        @empty
                                            <a class="dropdown-item text-center small text-gray-500" href="#">Tidak ada notifikasi</a>
                                        @endforelse
                                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::guard('mahasiswa')->user()->nama_pengguna }}</span>
                                        <span class="badge rounded-pill me-2" style="background: #881d1d;">Mahasiswa</span>
                                        <img class="border rounded-circle img-profile" src="{{ asset('/storage/assets/img/avatars/'.(Auth::guard('mahasiswa')->user()->foto ?? 'default.jpg')) }}">
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item" href="/mahasiswa/profil">
                                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profil
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/logout">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Keluar
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Komposisi Status Topik</p>
                                </div>
                                <div class="card-body">
                                    <canvas id="statusTopikChart" height="180"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Proporsi Topik per Dosen</p>
                                </div>
                                <div class="card-body">
                                    <canvas id="pieDosenTopikChart" height="180"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Jumlah Topik per Bidang</p>
                                </div>
                                <div class="card-body">
                                    <canvas id="bidangTopikChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row mt-3 d-flex align-items-stretch">
                        <div class="col-md-4 mb-4 d-flex">
                            <div class="card shadow h-100 w-100">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Data Pembimbing</p>
                                    <button class="btn btn-sm" type="button" style="color: rgb(136,29,29); background: none; font-weight: bold;" data-bs-toggle="modal" data-bs-target="#modalDosenPembimbing">
                                        Lihat Selengkapnya... <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path></svg>
                                    </button>
                                </div>
                                <div class="card-body p-4">
                                    <!-- Tabel Data Pembimbing -->
                                    <div class="table-responsive table mt-0">
                                        <table class="table table-striped table-hover" id="tableData1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Kode Dosen</th>
                                                    <th>Posisi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 1; @endphp
                                                @if($pembimbingSatu && $pembimbingSatu != '-')
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $pembimbingSatu }}</td>
                                                    <td>{{ \App\Models\Dosen::where('nama', $pembimbingSatu)->first()->kode_dosen ?? '-' }}</td>
                                                    <td>Pembimbing 1</td>
                                                </tr>
                                                @endif
                                                @if($pembimbingDua && $pembimbingDua != '-')
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $pembimbingDua }}</td>
                                                    <td>{{ \App\Models\Dosen::where('nama', $pembimbingDua)->first()->kode_dosen ?? '-' }}</td>
                                                    <td>Pembimbing 2</td>
                                                </tr>
                                                @endif
                                                @if(($pembimbingSatu == '-' || !$pembimbingSatu) && ($pembimbingDua == '-' || !$pembimbingDua))
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center">Belum ada pembimbing</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>No</strong></td>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>Kode Dosen</strong></td>
                                                    <td><strong>Posisi</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 d-flex">
                            <div class="card shadow h-100 w-100">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Data Kelompok</p>
                                    <button class="btn btn-sm" type="button" style="color: rgb(136,29,29); background: none; font-weight: bold;" data-bs-toggle="modal" data-bs-target="#modalDataKelompok">
                                        Lihat Selengkapnya... <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right"><path fill-rule="evenodd" d="M1 8a.0.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path></svg>
                                    </button>
                                </div>
                                <div class="card-body p-4">
                                    <!-- Tabel Data Kelompok -->
                                    <div class="table-responsive table mt-0">
                                        <table class="table table-striped table-hover" id="tableData2">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIM</th>
                                                    <th>Nama</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 1; @endphp
                                                @forelse($anggotaKelompok as $anggota)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $anggota->nim }}</td>
                                                    <td>{{ $anggota->nama_anggota }}</td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm ms-1" type="button" data-bs-toggle="modal" data-bs-target="#ModalLihatKelompok{{ $anggota->id }}"><i class="fas fa-eye"></i></button>
                                                        <!-- Modal detail anggota kelompok -->
                                                        <div class="modal fade" role="dialog" tabindex="-1" id="ModalLihatKelompok{{ $anggota->id }}">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" style="font-weight: bold;">Lihat Data Kelompok</h5>
                                                                        <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-5"><span style="font-weight: bold;">NIM</span></div>
                                                                            <div class="col-7"><p><span class="fw-bold">:&nbsp;</span>{{ $anggota->nim }}</p></div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5"><span style="font-weight: bold;">Nama</span></div>
                                                                            <div class="col-7"><p><span class="fw-bold">:&nbsp;</span>{{ $anggota->nama_anggota }}</p></div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5"><span style="font-weight: bold;">Status Pembimbing 1</span></div>
                                                                            <div class="col-7"><p><span class="fw-bold">:&nbsp;</span>{{ $pembimbingSatu }}</p></div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5"><span style="font-weight: bold;">Status Pembimbing 2</span></div>
                                                                            <div class="col-7"><p><span class="fw-bold">:&nbsp;</span>{{ $pembimbingDua }}</p></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer"><button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tutup</button></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center">Belum ada anggota kelompok</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>No</strong></td>
                                                    <td><strong>NIM</strong></td>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>Aksi</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 d-flex">
                            <div class="card shadow h-100 w-100">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center" style="gap: 8px;">
                                        <i class="fas fa-calendar-alt me-2" style="font-size: 1.3em; color: #4f6ef7;"></i>
                                        <p class="text-dark m-0 fw-bold">Jadwal Sidang Kamu</p>
                                    </div>
                                    <button class="btn btn-sm" type="button" style="color: rgb(136,29,29); background: none; font-weight: bold;" data-bs-toggle="modal" data-bs-target="#modalJadwalSidang">
                                        Lihat Selengkapnya... <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path></svg>
                                    </button>
                                </div>
                                <div class="card-body p-4">
                                    @if(isset($jadwalSidang) && $jadwalSidang && $jadwalSidang->judul)
                                    <div class="jadwal-sidang-content">
                                        <div class="jadwal-item mb-3">
                                            <div class="jadwal-label">Judul TA</div>
                                            <div class="jadwal-value">{{ $jadwalSidang->judul }}</div>
                                        </div>
                                        <div class="jadwal-item mb-3">
                                            <div class="jadwal-label">Tanggal & Waktu</div>
                                            <div class="jadwal-value">{{ isset($jadwalSidang->tanggal_sidang) ? \Carbon\Carbon::parse($jadwalSidang->tanggal_sidang)->format('d/m/Y H:i') : '-' }}</div>
                                        </div>
                                        <div class="jadwal-item mb-3">
                                            <div class="jadwal-label">Ruangan</div>
                                            <div class="jadwal-value">{{ $jadwalSidang->ruangan ?? '-' }}</div>
                                        </div>
                                        <div class="jadwal-item mb-3">
                                            <div class="jadwal-label">Penguji 1</div>
                                            <div class="jadwal-value">{{ $jadwalSidang->dosenPenguji1->nama ?? '-' }}</div>
                                        </div>
                                        <div class="jadwal-item mb-3">
                                            <div class="jadwal-label">Penguji 2</div>
                                            <div class="jadwal-value">{{ $jadwalSidang->dosenPenguji2->nama ?? '-' }}</div>
                                        </div>
                                        <div class="jadwal-item mb-3">
                                            <div class="jadwal-label">Jenis Sidang</div>
                                            <div class="jadwal-value">{{ $jadwalSidang->jenis_sidang ?? '-' }}</div>
                                        </div>
                                        <div class="jadwal-item mb-3">
                                            <div class="jadwal-label">Status</div>
                                            <div class="jadwal-value">
                                                @php
                                                    $badge = 'secondary';
                                                    if($jadwalSidang->status == 'Scheduled') $badge = 'primary';
                                                    elseif($jadwalSidang->status == 'Completed') $badge = 'success';
                                                    elseif($jadwalSidang->status == 'Postponed') $badge = 'warning';
                                                @endphp
                                                <span class="badge bg-{{ $badge }}">{{ $jadwalSidang->status ?? '-' }}</span>
                                            </div>
                                        </div>
                                        <div class="jadwal-item mb-0">
                                            <div class="jadwal-label">Catatan</div>
                                            <div class="jadwal-value">{{ $jadwalSidang->catatan ?? '-' }}</div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="text-center d-flex flex-column align-items-center justify-content-center" style="min-height: 280px;">
                                        <i class="fas fa-calendar-times mb-3" style="font-size: 3.5em; color: #e5e7eb;"></i>
                                        <p class="fw-bold text-muted mb-2" style="font-size: 1.1em;">Belum ada jadwal sidang</p>
                                        <p class="text-muted text-center" style="font-size: 0.95em; line-height: 1.5;">Silakan cek secara berkala atau hubungi admin jika ada kendala.</p>
                                    </div>
                                    @endif
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
    <script src="{{ asset('/storage/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/storage/assets/js/theme.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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

        // Datatables 1
        $(document).ready( function () {
            $('#tableData1').DataTable({
                language: {
                    lengthMenu: "Tampilkan _MENU_ entri per halaman",
                    search: "Cari:",
                    info: "Menampilkan _START_ Sampai _END_ Dari _TOTAL_ Entri",
                    infoEmpty: "Menampilkan 0 Sampai 0 Dari 0 Entri",
                    emptyTable: "Tidak Ada Data Tersedia",
                    zeroRecords: "Tidak Ditemukan Hasil",
                },
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
                layout: {
                    topEnd: {
                        search: {
                            placeholder: 'Cari Data Anda...'
                        }
                    }
                }
            });
        });

        // Datatables 2
        $(document).ready( function () {
            $('#tableData2').DataTable({
                language: {
                    lengthMenu: "Tampilkan _MENU_ entri per halaman",
                    search: "Cari:",
                    info: "Menampilkan _START_ Sampai _END_ Dari _TOTAL_ Entri",
                    infoEmpty: "Menampilkan 0 Sampai 0 Dari 0 Entri",
                    emptyTable: "Tidak Ada Data Tersedia",
                    zeroRecords: "Tidak Ditemukan Hasil",
                },
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
                columnDefs: [{
                    targets: 3,
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

        // Mark notifications as read when Alerts Center is opened
        $(function() {
            $('.nav-item.dropdown.no-arrow.mx-1').on('show.bs.dropdown', function () {
                $.post("{{ route('mahasiswa.notifications.read') }}", {
                    _token: '{{ csrf_token() }}'
                }, function() {
                    $('.badge-counter').text('0');
                });
            });
        });

        // Sidebar toggle functionality
        $(document).ready(function() {
            $('#sidebarToggle, #sidebarToggleTop').on('click', function() {
                $('.sidebar').toggleClass('show');
            });

            // Close sidebar when clicking outside on mobile
            $(document).on('click', function(e) {
                if ($(window).width() <= 768) {
                    if (!$(e.target).closest('.sidebar, #sidebarToggle, #sidebarToggleTop').length) {
                        $('.sidebar').removeClass('show');
                    }
                }
            });
        });

        // Chart.js Pie Chart: Komposisi Status Topik
        const ctxStatus = document.getElementById('statusTopikChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: @json($statusLabels),
                datasets: [{
                    data: @json($statusCounts),
                    backgroundColor: [
                        '#4ade80', // Tersedia (hijau)
                        '#f87171', // Penuh (merah)
                        '#60a5fa', // Proposal (biru)
                        '#38bdf8', // TA (biru muda)
                        '#facc15', // Booked (kuning)
                        '#800080', // Sidang (ungu)
                        '#a3a3a3'  // Selesai (abu-abu)
                    ],
                    borderWidth: 2,
                    borderColor: '#fff',
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            color: '#334155',
                            font: { family: 'Poppins', size: 14 }
                        }
                    }
                },
                cutout: '70%',
                responsive: true,
                maintainAspectRatio: false
            }
        });
        // Chart.js Bar Chart: Jumlah Topik per Bidang - Fleksibel
        const ctxBidang = document.getElementById('bidangTopikChart').getContext('2d');
        
        // Data untuk chart
        const bidangData = @json($bidangData);
        const bidangLabels = @json($bidangLabels);
        
        // Hitung nilai maksimum untuk menentukan skala Y yang fleksibel
        const maxValue = Math.max(...bidangData);
        const stepSize = maxValue <= 5 ? 1 : Math.ceil(maxValue / 5);
        const maxYAxis = Math.ceil(maxValue * 1.2); // Tambah 20% untuk ruang di atas
        
        new Chart(ctxBidang, {
            type: 'bar',
            data: {
                labels: bidangLabels,
                datasets: [{
                    label: 'Jumlah Topik',
                    data: bidangData,
                    backgroundColor: '#60a5fa',
                    borderRadius: 8,
                    maxBarThickness: 32
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.parsed.y + ' Topik';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { 
                            color: '#64748b', 
                            font: { family: 'Poppins', size: 13 },
                            maxRotation: 45,
                            minRotation: 0
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#e5e7eb' },
                        ticks: { 
                            color: '#64748b', 
                            font: { family: 'Poppins', size: 13 }, 
                            stepSize: stepSize,
                            max: maxYAxis
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
        // Pie Chart: Proporsi Topik per Dosen
        const ctxPieDosen = document.getElementById('pieDosenTopikChart').getContext('2d');
        new Chart(ctxPieDosen, {
            type: 'pie',
            data: {
                labels: @json($dosenLabels),
                datasets: [{
                    data: @json($dosenData),
                    backgroundColor: [
                        '#60a5fa', '#4ade80', '#facc15', '#a78bfa', '#f87171'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff',
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            color: '#334155',
                            font: { family: 'Poppins', size: 14 }
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
        
    </script>
    <style>
    #statusTopikChart, #pieDosenTopikChart {
        min-height: 180px;
        max-height: 260px;
    }
    
    #bidangTopikChart {
        min-height: 200px;
        max-height: 350px;
        width: 100% !important;
    }
    
    /* Responsif untuk chart bar */
    @media (max-width: 768px) {
        #bidangTopikChart {
            min-height: 250px;
            max-height: 400px;
        }
    }
    .card .card-body {
        padding-bottom: 1.5rem;
    }
    
    /* Jadwal Sidang Styling */
    .jadwal-sidang-content {
        padding: 0.5rem 0;
    }
    
    .jadwal-item {
        display: flex;
        flex-direction: column;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.2s ease;
    }
    
    .jadwal-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    
    .jadwal-item:hover {
        background-color: #f8fafc;
        border-radius: 8px;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        margin-left: -0.5rem;
        margin-right: -0.5rem;
    }
    
    .jadwal-label {
        font-size: 0.85em;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .jadwal-value {
        font-size: 0.95em;
        font-weight: 500;
        color: #1e293b;
        line-height: 1.4;
        word-wrap: break-word;
    }
    
    .jadwal-value .badge {
        font-size: 0.8em;
        padding: 0.4em 0.8em;
        border-radius: 6px;
        font-weight: 600;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .jadwal-item {
            padding: 0.5rem 0;
        }
        
        .jadwal-label {
            font-size: 0.8em;
        }
        
        .jadwal-value {
            font-size: 0.9em;
        }
    }
    
    /* Table styling improvements */
    .table-responsive.table {
        margin-bottom: 0;
    }
    
    .table-responsive.table .table {
        margin-bottom: 0;
        font-size: 0.9em;
    }
    
    .table-responsive.table .table thead th {
        padding: 0.75rem 0.5rem;
        font-size: 0.85em;
        font-weight: 600;
        color: #64748b;
        background-color: #f8fafc;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .table-responsive.table .table tbody td {
        padding: 0.75rem 0.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .table-responsive.table .table tbody tr:hover {
        background-color: #f8fafc;
    }
    
    .table-responsive.table .table tfoot th {
        padding: 0.5rem 0.5rem;
        font-size: 0.8em;
        font-weight: 600;
        color: #64748b;
        background-color: #f8fafc;
        border-top: 2px solid #e2e8f0;
    }
    
    /* DataTables styling improvements */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1rem;
    }
    
    .dataTables_wrapper .dataTables_length select {
        padding: 0.25rem 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 0.85em;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        padding: 0.25rem 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 0.85em;
        margin-left: 0.5rem;
    }
    
    .dataTables_wrapper .dataTables_info {
        font-size: 0.85em;
        color: #64748b;
        margin-top: 1rem;
    }
    
    .dataTables_wrapper .dataTables_paginate {
        margin-top: 1rem;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.5rem;
        margin: 0 0.125rem;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 0.85em;
        color: #64748b !important;
        background: #ffffff;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f8fafc !important;
        color: #1e293b !important;
        border-color: #cbd5e1;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #881d1d !important;
        color: #ffffff !important;
        border-color: #881d1d;
    }
    
    /* Modal Jadwal Sidang Styling */
    .jadwal-detail-item {
        padding: 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }
    
    .jadwal-detail-item:hover {
        background-color: #f1f5f9;
        border-color: #cbd5e1;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .jadwal-detail-label {
        font-size: 0.85em;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .jadwal-detail-value {
        font-size: 1em;
        font-weight: 500;
        color: #1e293b;
        line-height: 1.4;
        word-wrap: break-word;
    }
    
    .jadwal-detail-value .badge {
        font-size: 0.9em;
        padding: 0.5em 1em;
        border-radius: 6px;
        font-weight: 600;
    }
    </style>
    <!-- Modal Data Pembimbing -->
    <div class="modal fade" id="modalDosenPembimbing" tabindex="-1" aria-labelledby="modalDosenPembimbingLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalDosenPembimbingLabel">Dosen Pembimbing</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Dosen</th>
                  <th>Kode Dosen</th>
                  <th>Posisi</th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @if($pembimbingSatu && $pembimbingSatu != '-')
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $pembimbingSatu }}</td>
                  <td>{{ \App\Models\Dosen::where('nama', $pembimbingSatu)->first()->kode_dosen ?? '-' }}</td>
                  <td>Pembimbing 1</td>
                </tr>
                @endif
                @if($pembimbingDua && $pembimbingDua != '-')
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $pembimbingDua }}</td>
                  <td>{{ \App\Models\Dosen::where('nama', $pembimbingDua)->first()->kode_dosen ?? '-' }}</td>
                  <td>Pembimbing 2</td>
                </tr>
                @endif
                @if(($pembimbingSatu == '-' || !$pembimbingSatu) && ($pembimbingDua == '-' || !$pembimbingDua))
                <tr>
                  <td colspan="4" class="text-center">Belum ada pembimbing</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Data Kelompok -->
    <div class="modal fade" id="modalDataKelompok" tabindex="-1" aria-labelledby="modalDataKelompokLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalDataKelompokLabel">Data Kelompok</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Nama</th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @forelse($anggotaKelompok as $anggota)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $anggota->nim }}</td>
                  <td>{{ $anggota->nama_anggota }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="3" class="text-center">Belum ada anggota kelompok</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal Jadwal Sidang -->
    <div class="modal fade" id="modalJadwalSidang" tabindex="-1" aria-labelledby="modalJadwalSidangLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalJadwalSidangLabel">
              <i class="fas fa-calendar-alt me-2" style="color: #4f6ef7;"></i>
              Detail Jadwal Sidang
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @if(isset($jadwalSidang) && $jadwalSidang && $jadwalSidang->judul)
            <div class="row">
              <div class="col-md-6">
                <div class="jadwal-detail-item mb-3">
                  <div class="jadwal-detail-label">Judul TA</div>
                  <div class="jadwal-detail-value">{{ $jadwalSidang->judul }}</div>
                </div>
                <div class="jadwal-detail-item mb-3">
                  <div class="jadwal-detail-label">Tanggal & Waktu</div>
                  <div class="jadwal-detail-value">{{ isset($jadwalSidang->tanggal_sidang) ? \Carbon\Carbon::parse($jadwalSidang->tanggal_sidang)->format('d/m/Y H:i') : '-' }}</div>
                </div>
                <div class="jadwal-detail-item mb-3">
                  <div class="jadwal-detail-label">Ruangan</div>
                  <div class="jadwal-detail-value">{{ $jadwalSidang->ruangan ?? '-' }}</div>
                </div>
                <div class="jadwal-detail-item mb-3">
                  <div class="jadwal-detail-label">Jenis Sidang</div>
                  <div class="jadwal-detail-value">{{ $jadwalSidang->jenis_sidang ?? '-' }}</div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="jadwal-detail-item mb-3">
                  <div class="jadwal-detail-label">Penguji 1</div>
                  <div class="jadwal-detail-value">{{ $jadwalSidang->dosenPenguji1->nama ?? '-' }}</div>
                </div>
                <div class="jadwal-detail-item mb-3">
                  <div class="jadwal-detail-label">Penguji 2</div>
                  <div class="jadwal-detail-value">{{ $jadwalSidang->dosenPenguji2->nama ?? '-' }}</div>
                </div>
                <div class="jadwal-detail-item mb-3">
                  <div class="jadwal-detail-label">Status</div>
                  <div class="jadwal-detail-value">
                    @php
                        $badge = 'secondary';
                        if($jadwalSidang->status == 'Scheduled') $badge = 'primary';
                        elseif($jadwalSidang->status == 'Completed') $badge = 'success';
                        elseif($jadwalSidang->status == 'Postponed') $badge = 'warning';
                    @endphp
                    <span class="badge bg-{{ $badge }} fs-6">{{ $jadwalSidang->status ?? '-' }}</span>
                  </div>
                </div>
                <div class="jadwal-detail-item mb-3">
                  <div class="jadwal-detail-label">Catatan</div>
                  <div class="jadwal-detail-value">{{ $jadwalSidang->catatan ?? '-' }}</div>
                </div>
              </div>
            </div>
            @else
            <div class="text-center py-5">
              <i class="fas fa-calendar-times mb-3" style="font-size: 4em; color: #e5e7eb;"></i>
              <h5 class="fw-bold text-muted mb-2">Belum ada jadwal sidang</h5>
              <p class="text-muted">Silakan cek secara berkala atau hubungi admin jika ada kendala.</p>
            </div>
            @endif
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</body>
</html>