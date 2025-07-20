<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>TAKU - Penjadwalan Sidang</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* CSS Kustom untuk Makeover Navbar */
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

        /* === RENOVASI SIDEBAR === */
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
            border-left: 4px solid transparent; /* Garis indikator non-aktif */
        }
        .sidebar .nav-item .nav-link:hover {
            color: var(--sidebar-text-active);
            background-color: var(--primary-darker);
            border-left-color: var(--primary-lighter);
        }
        .sidebar .nav-item.active .nav-link {
            color: var(--sidebar-text-active);
            font-weight: 600;
            background-color: var(--primary-darker);
            border-left-color: #ffffff; /* Garis indikator aktif */
        }

        .sidebar .nav-item .nav-link i {
            font-size: 1em;
            width: 24px; /* Memberi ruang yang konsisten untuk ikon */
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

        /* === RENOVASI TOPBAR === */
        #content-wrapper {
            width: 100%;
        }
        .topbar {
            height: 60px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(0,0,0,0.05) !important;
        }
        .topbar .nav-item .nav-link {
            height: 60px;
            display: flex;
            align-items: center;
        }
        .topbar .img-profile {
            height: 40px;
            width: 40px;
            object-fit: cover;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .topbar .dropdown-list {
            width: 20rem !important;
        }
        .topbar .dropdown-header {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #fff;
        }
        .topbar .dropdown-item {
            transition: background-color 0.2s ease;
        }
        .topbar .dropdown-item:active {
            background-color: #f8f9fa;
        }

        /* === STYLING UNTUK DATETIME INPUT === */
        input[type="datetime-local"] {
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        input[type="datetime-local"]:hover {
            border-color: #881d1d;
            box-shadow: 0 4px 12px rgba(136, 29, 29, 0.15);
            transform: translateY(-1px);
        }

        input[type="datetime-local"]:focus {
            border-color: #881d1d;
            box-shadow: 0 0 0 3px rgba(136, 29, 29, 0.1);
            outline: none;
            background: #ffffff;
        }

        /* Styling untuk dropdown yang lebih smooth */
        .form-select {
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .form-select:hover {
            border-color: #881d1d;
            box-shadow: 0 4px 12px rgba(136, 29, 29, 0.15);
            transform: translateY(-1px);
        }

        .form-select:focus {
            border-color: #881d1d;
            box-shadow: 0 0 0 3px rgba(136, 29, 29, 0.1);
            outline: none;
            background: #ffffff;
        }

        /* Styling untuk textarea */
        textarea.form-control {
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            resize: vertical;
        }

        textarea.form-control:hover {
            border-color: #881d1d;
            box-shadow: 0 4px 12px rgba(136, 29, 29, 0.15);
            transform: translateY(-1px);
        }

        textarea.form-control:focus {
            border-color: #881d1d;
            box-shadow: 0 0 0 3px rgba(136, 29, 29, 0.1);
            outline: none;
            background: #ffffff;
        }

        /* Styling untuk text input */
        input[type="text"].form-control {
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        input[type="text"].form-control:hover {
            border-color: #881d1d;
            box-shadow: 0 4px 12px rgba(136, 29, 29, 0.15);
            transform: translateY(-1px);
        }

        input[type="text"].form-control:focus {
            border-color: #881d1d;
            box-shadow: 0 0 0 3px rgba(136, 29, 29, 0.1);
            outline: none;
            background: #ffffff;
        }

        /* === STYLING UNTUK TIME PICKER === */
        /* Styling untuk input time yang lebih user-friendly */
        input[type="time"] {
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            cursor: pointer;
        }

        input[type="time"]:hover {
            border-color: #881d1d;
            box-shadow: 0 4px 12px rgba(136, 29, 29, 0.15);
            transform: translateY(-1px);
        }

        input[type="time"]:focus {
            border-color: #881d1d;
            box-shadow: 0 0 0 3px rgba(136, 29, 29, 0.1);
            outline: none;
            background: #ffffff;
        }

        /* Styling untuk datetime-local yang lebih spesifik */
        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            background-color: transparent;
            border-radius: 4px;
            padding: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            filter: brightness(0.7);
        }

        input[type="datetime-local"]::-webkit-calendar-picker-indicator:hover {
            background-color: #f8f9fa;
            transform: scale(1.05);
            filter: brightness(1);
        }

        /* Styling untuk time picker dropdown */
        input[type="datetime-local"]::-webkit-datetime-edit-hour-field,
        input[type="datetime-local"]::-webkit-datetime-edit-minute-field,
        input[type="datetime-local"]::-webkit-datetime-edit-day-field,
        input[type="datetime-local"]::-webkit-datetime-edit-month-field,
        input[type="datetime-local"]::-webkit-datetime-edit-year-field {
            padding: 2px 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        input[type="datetime-local"]::-webkit-datetime-edit-hour-field:focus,
        input[type="datetime-local"]::-webkit-datetime-edit-minute-field:focus,
        input[type="datetime-local"]::-webkit-datetime-edit-day-field:focus,
        input[type="datetime-local"]::-webkit-datetime-edit-month-field:focus,
        input[type="datetime-local"]::-webkit-datetime-edit-year-field:focus {
            background-color: rgba(136, 29, 29, 0.1);
            outline: none;
        }

        /* Styling untuk Firefox */
        input[type="datetime-local"]::-moz-calendar-picker-indicator {
            background-color: transparent;
            border-radius: 4px;
            padding: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            filter: brightness(0.7);
        }

        input[type="datetime-local"]::-moz-calendar-picker-indicator:hover {
            background-color: #f8f9fa;
            transform: scale(1.05);
            filter: brightness(1);
        }

        /* Custom styling untuk time picker popup */
        input[type="datetime-local"]:focus {
            position: relative;
        }

        /* Animasi untuk saat picker dibuka */
        @keyframes pickerFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Styling untuk placeholder text */
        input[type="datetime-local"]::placeholder {
            color: #6c757d;
            font-style: italic;
        }

        /* Active state untuk picker */
        input[type="datetime-local"].picker-active {
            border-color: #881d1d;
            box-shadow: 0 0 0 3px rgba(136, 29, 29, 0.2);
            background: #ffffff;
            transform: translateY(-2px);
        }

        /* Smooth transition untuk semua datetime elements */
        input[type="datetime-local"] * {
            transition: all 0.2s ease;
        }
    </style>

</head>
<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark" style="background: #881d1d;">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon">
                        <img class="img-fluid" src="{{ asset('storage/assets/img/Logo/TAKU_White.png') }}" width="100px" alt="Logo TAKU">
                    </div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/beranda">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/template_dokumen">
                            <i class="far fa-newspaper"></i>
                            <span>Template Dokumen</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/pengaturan_topik">
                            <i class="fas fa-cogs"></i>
                            <span>Pengaturan Topik</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin/jadwal_sidang">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Jadwal Sidang</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                            <i class="fas fa-users"></i>
                            <span>Kelola Pengguna</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/admin/dosen">
                                <i class="fas fa-chalkboard-teacher"></i>&nbsp;Dosen
                            </a>
                            <a class="dropdown-item" href="/admin/mahasiswa">
                                <i class="fas fa-user-graduate"></i>&nbsp;Mahasiswa
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <hr>
                        <a class="nav-link" href="/admin/profil">
                            <i class="fas fa-user"></i>
                            <span>Profil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
                </div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button">
                            <i class="fas fa-bars"></i>
                        </button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        @php
                                            $unreadCount = auth()->guard('admin')->user()->unreadNotifications->count();
                                        @endphp
                                        @if ($unreadCount > 0)
                                            <span class="badge bg-danger badge-counter">{{ $unreadCount }}</span>
                                        @endif
                                        <i class="fas fa-bell fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header bg-danger border-danger">Notifikasi</h6>
                                        @forelse (auth()->guard('admin')->user()->notifications as $notification)
                                            @if (is_null($notification->read_at))
                                                <form id="formNotification-{{  $notification->id }}" action="/notification/{{ $notification->id }}/read" method="post">
                                                <div class="dropdown-item d-flex align-items-center" style="background-color: rgba(247, 162, 162, 0.1); cursor: pointer;" onclick="document.getElementById('formNotification-{{ $notification->id }}').submit()">
                                                @csrf
                                                @method('POST')
                                                <div class="me-3">
                                                    <div class="icon-circle {{ $notification->data['bg_icon'] }}">
                                                        <i class="{{ $notification->data['icon'] }} text-white"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span class="small text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                                    <p class="fw-bold">{{ $notification->data['message'] }}</p>
                                                </div>
                                                </div>
                                                </form>
                                            @else
                                                <div class="dropdown-item d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="icon-circle {{ $notification->data['bg_icon'] }}">
                                                            <i class="{{ $notification->data['icon'] }} text-white"></i>
                                                        </div>
                                                    </div>
                                                <div><span class="small text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                                    <p>{{ $notification->data['message'] }}</p>
                                                </div>
                                                </div>
                                            @endif
                                        @empty
                                        <div class="dropdown-item align-items-center" href="#">
                                            <div class="text-center">
                                                <p class="p-2 pt-4 fw-bold text-center h6">Notifikasi Tidak Ada</p>
                                            </div>
                                        </div>    
                                        @endforelse
                                        <div class="row dropdown-footer">
                                            <div class="col pe-1">
                                                <form action="{{ route('admin.notifications.read') }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-center fw-bold text-gray-900" href="#">Sudah Dibaca</button>
                                                </form>
                                            </div>
                                            <div class="col ps-1">
                                                <form action="{{ route('admin.notifications.drop') }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-center fw-bold text-gray-900" href="#">Bersihkan Semua</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::guard('admin')->user()->nama_pengguna }}</span>
                                        <span class="badge rounded-pill me-2" style="background: #881d1d;">Admin</span>
                                        <img class="border rounded-circle img-profile" src="{{ asset('/storage/assets/img/avatars/'.(Auth::guard('admin')->user()->image ?? 'default.jpg')) }}">
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item" href="/admin/profil">
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
        <h3 class="text-dark mb-0">Penjadwalan Sidang</h3>
    </div>
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <p class="text-dark m-0 fw-bold">Data Jadwal Sidang</p>
            <button class="btn btn-sm link-light" type="button" style="background: #881d1d;" data-bs-toggle="modal" data-bs-target="#ModalTambahJadwal">
                <i class="fas fa-plus"></i>&nbsp;Tambah Jadwal Sidang
            </button>
        </div>
        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                <table class="table table-striped table-hover" id="tableData">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Judul TA</th>
                            <th class="text-center">Tanggal & Waktu</th>
                            <th class="text-center">Ruangan</th>
                            <th class="text-center">Penguji 1</th>
                            <th class="text-center">Penguji 2</th>
                            <th class="text-center">Jenis Sidang</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalSidang as $jadwal)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $jadwal->judul }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($jadwal->tanggal_sidang)->format('d/m/Y H:i') }}</td>
                            <td class="text-center">{{ $jadwal->ruangan }}</td>
                            <td>{{ $jadwal->dosenPenguji1->nama }}</td>
                            <td>{{ $jadwal->dosenPenguji2->nama }}</td>
                            <td class="text-center">{{ $jadwal->jenis_sidang }}</td>
                            <td class="text-center">
                                <span class="badge {{ $jadwal->status == 'Scheduled' ? 'bg-primary' : ($jadwal->status == 'Completed' ? 'bg-success' : 'bg-warning') }}">
                                    {{ $jadwal->status == 'Scheduled' ? 'Terjadwal' : ($jadwal->status == 'Completed' ? 'Selesai' : 'Ditunda') }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#ModalEditJadwal{{ $jadwal->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm ms-1" type="button" data-bs-toggle="modal" data-bs-target="#ModalHapusJadwal{{ $jadwal->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="ModalEditJadwal{{ $jadwal->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                                    <form action="{{ route('admin.jadwal_sidang.update', $jadwal->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="kelompok_id" value="{{ $jadwal->kelompok_id }}">
                                        <input type="hidden" name="judul" value="{{ $jadwal->judul }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Jadwal Sidang</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Judul TA</label>
                                                <input type="text" class="form-control" value="{{ $jadwal->judul }}" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal & Waktu</label>
                                                <input type="datetime-local" class="form-control" name="tanggal_sidang" 
                                                       value="{{ \Carbon\Carbon::parse($jadwal->tanggal_sidang)->format('Y-m-d\TH:i') }}" 
                                                       onclick="this.showPicker()" 
                                                       required>
                                                <small class="text-muted">Klik pada kotak untuk memilih tanggal dan waktu</small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Ruangan</label>
                                                <input type="text" class="form-control" name="ruangan" value="{{ $jadwal->ruangan }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Penguji 1</label>
                                                <select class="form-select" name="penguji_1" required>
                                                    @foreach($dosenList as $dosen)
                                                        <option value="{{ $dosen->id }}" {{ $jadwal->penguji_1 == $dosen->id ? 'selected' : '' }}>
                                                            {{ $dosen->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Penguji 2</label>
                                                <select class="form-select" name="penguji_2" required>
                                                    @foreach($dosenList as $dosen)
                                                        <option value="{{ $dosen->id }}" {{ $jadwal->penguji_2 == $dosen->id ? 'selected' : '' }}>
                                                            {{ $dosen->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Sidang</label>
                                                <select class="form-select" name="jenis_sidang" required>
                                                    <option value="Sidang Akhir" {{ isset($jadwal) && $jadwal->jenis_sidang == 'Sidang Akhir' ? 'selected' : '' }}>Sidang Akhir</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="status" required>
                                                    <option value="Scheduled" {{ $jadwal->status == 'Scheduled' ? 'selected' : '' }}>Terjadwal</option>
                                                    <option value="Completed" {{ $jadwal->status == 'Completed' ? 'selected' : '' }}>Selesai</option>
                                                    <option value="Postponed" {{ $jadwal->status == 'Postponed' ? 'selected' : '' }}>Ditunda</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Catatan</label>
                                                <textarea class="form-control" name="catatan" rows="3">{{ $jadwal->catatan }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-warning">Perbarui</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="ModalHapusJadwal{{ $jadwal->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Hapus Jadwal Sidang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <h1 class="display-3"><i class="fas fa-exclamation-triangle text-warning"></i></h1>
                                        <p>Apakah anda yakin ingin menghapus jadwal sidang ini?</p>
                                        <p class="text-muted">{{ $jadwal->judul }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('admin.jadwal_sidang.destroy', $jadwal->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambahJadwal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                            <form action="{{ route('admin.jadwal_sidang.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal Sidang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kelompok</label>
                        <select class="form-select" name="kelompok_id" required>
                            <option value="">Pilih Kelompok</option>
                            @foreach($kelompokList as $kelompok)
                                <option value="{{ $kelompok->id }}" data-judul="{{ $kelompok->judul }}">{{ $kelompok->judul }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="judul" id="selected_judul">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal & Waktu</label>
                        <input type="datetime-local" class="form-control" name="tanggal_sidang" 
                               onclick="this.showPicker()" 
                               required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ruangan</label>
                        <input type="text" class="form-control" name="ruangan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penguji 1</label>
                        <select class="form-select" name="penguji_1" required>
                            <option value="">Pilih Dosen Penguji 1</option>
                            @foreach($dosenList as $dosen)
                                <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penguji 2</label>
                        <select class="form-select" name="penguji_2" required>
                            <option value="">Pilih Dosen Penguji 2</option>
                            @foreach($dosenList as $dosen)
                                <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Sidang</label>
                        <select class="form-select" name="jenis_sidang" required>
                            <option value="Sidang Akhir">Sidang Akhir</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea class="form-control" name="catatan" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
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
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
        // Datatables
        $(document).ready( function () {
        $('#tableData').DataTable({
            language: {
                lengthMenu: "Tampilkan _MENU_ entri per halaman",
                search: "Cari:",
                info: "Menampilkan _START_ Sampai _END_ Dari _TOTAL_ Entri",
                infoEmpty: "Menampilkan 0 Sampai 0 Dari 0 Entri",
                emptyTable: "Tidak Ada Data Tersedia",
                zeroRecords: "Tidak Ditemukan Hasil",
            },
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
                order: [[2, 'asc']],
        });
        $('select[name="kelompok_id"]').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var judul = selectedOption.data('judul');
            $('#selected_judul').val(judul);
        });

        // Enhanced datetime picker experience
        $('input[type="datetime-local"]').on('click', function() {
            // Add smooth animation when picker opens
            $(this).addClass('picker-active');
            
            // Auto-focus on the input for better UX
            setTimeout(() => {
                this.showPicker();
            }, 100);
        });

        // Add visual feedback when picker is active
        $('input[type="datetime-local"]').on('focus', function() {
            $(this).addClass('picker-active');
        });

        $('input[type="datetime-local"]').on('blur', function() {
            $(this).removeClass('picker-active');
        });

        // Smooth scrolling for time picker
        $(document).on('wheel', function(e) {
            if ($(e.target).closest('input[type="datetime-local"]').length) {
                e.preventDefault();
            }
        });
    });
</script>
</body>
</html> 