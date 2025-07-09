<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Pembimbing 2 - TAKU</title>
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
        <nav class="navbar align-items-start sidebar sidebar-dark accordion p-0 navbar-dark">
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
                    <li class="nav-item">
                        <a class="nav-link" href="/dosen/daftar_topik"><i class="far fa-file-alt"></i><span>Daftar Topik</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dosen/template_laporan"><i class="fas fa-file-word"></i><span>Template Laporan</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link active" href="/dosen/pembimbing-dua"><i class="fas fa-user-friends"></i><span>Pembimbing Dua</span></a>
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

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6>
                                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
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
                        <h3 class="text-dark mb-0">Permintaan Pembimbing 2</h3>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(count($permintaan) == 0)
                        <div class="alert alert-info">Tidak ada permintaan pembimbing dua saat ini.</div>
                    @else
                    <div class="card shadow">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul Topik</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Pembimbing 1</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permintaan as $i => $row)
                                    <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $row['judul'] }}</td>
                                        <td>
                                            @foreach($row['anggota'] as $a)
                                                <span class="badge rounded-pill bg-dark m-1">{{ $a->nama_anggota }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $row['pembimbing_satu'] }}</td>
                                        <td>
                                            <form action="{{ route('dosen.accept_pembimbing_dua', $row['id']) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button class="btn btn-success btn-sm" type="submit">Accept</button>
                                            </form>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalTolak{{ $row['id'] }}">Reject</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modalTolak{{ $row['id'] }}" tabindex="-1" aria-labelledby="modalTolakLabel{{ $row['id'] }}" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <form action="{{ route('dosen.reject_pembimbing_dua', $row['id']) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="modalTolakLabel{{ $row['id'] }}">Alasan Penolakan</h5>
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
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
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
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
</body>
</html>
