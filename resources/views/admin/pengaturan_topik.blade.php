<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>TAKU - Pengaturan Topik</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome-all.min.css') }}">
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
        
    </style>
</head>

<body id="page-top">
<div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion p-0 navbar-dark" style="background: #881d1d; position: fixed; height: 100vh; overflow-y: auto;">
        <div class="container-fluid d-flex flex-column p-0">
            <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                <div class="sidebar-brand-icon">
                    <img class="img-fluid" src="{{ asset('storage/assets/img/Logo/TAKU_White.png') }}" width="100px" alt="Logo TAKU">
                </div>
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/beranda"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/template_dokumen"><i class="far fa-newspaper"></i><span>Template Dokumen</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/admin/pengaturan_topik"><i class="fas fa-cogs"></i><span>Pengaturan Topik</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/jadwal_sidang"><i class="fas fa-calendar-alt"></i><span>Jadwal Sidang</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-users"></i><span>Kelola Pengguna</span></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/admin/dosen"><i class="fas fa-chalkboard-teacher"></i>Dosen</a>
                        <a class="dropdown-item" href="/admin/mahasiswa"><i class="fas fa-user-graduate"></i>Mahasiswa</a>
                    </div>
                </li>
                <li class="nav-item mt-auto"> <!-- Mendorong menu profil & keluar ke bawah -->
                    <hr class="sidebar-divider my-0">
                    <a class="nav-link" href="/admin/profil"><i class="fas fa-user-cog"></i><span>Profil</span></a>
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
                <div class="container-fluid">
                    <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                    <ul class="navbar-nav flex-nowrap ms-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                    @php $unreadCount = auth()->guard('admin')->user()->unreadNotifications->count(); @endphp
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
                                    <a class="dropdown-item" href="/admin/profil"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Keluar</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Pengaturan Topik</h3>
                </div>
                <div class="card shadow">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <p class="text-dark m-0 fw-bold">Pengaturan Kuota & List Bidang</p>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form action="{{ route('admin.simpan_pengaturan_topik') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="kuota_min" class="form-label">Kuota Minimal Anggota Kelompok</label>
                                <input type="number" class="form-control" id="kuota_min" name="kuota_min" min="2" max="10" value="{{ old('kuota_min', $pengaturan->kuota_min ?? 2) }}" required>
                                @error('kuota_min')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="kuota_max" class="form-label">Kuota Maksimal Anggota Kelompok</label>
                                <input type="number" class="form-control" id="kuota_max" name="kuota_max" min="2" max="10" value="{{ old('kuota_max', $pengaturan->kuota_max ?? 5) }}" required>
                                @error('kuota_max')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">List Bidang</label>
                                <div id="bidang-list">
                                    @php $bidang = old('list_bidang', $pengaturan->list_bidang ?? []); @endphp
                                    @foreach($bidang as $i => $b)
                                        <div class="input-group mb-2 bidang-item">
                                            <input type="text" name="list_bidang[]" class="form-control" value="{{ $b }}" required>
                                            <button type="button" class="btn btn-danger btn-remove-bidang">Hapus</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm link-light" id="btn-tambah-bidang" style="background: #881d1d;"><i class="fas fa-plus"></i> Tambah Bidang</button>
                                @error('list_bidang')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <button type="submit" class="btn btn-success">Simpan Pengaturan</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    $('#btn-tambah-bidang').click(function() {
        $('#bidang-list').append(`
            <div class="input-group mb-2 bidang-item">
                <input type="text" name="list_bidang[]" class="form-control" required>
                <button type="button" class="btn btn-danger btn-remove-bidang">Hapus</button>
            </div>
        `);
    });
    $(document).on('click', '.btn-remove-bidang', function() {
        $(this).closest('.bidang-item').remove();
    });
});
</script>
</body>
</html> 