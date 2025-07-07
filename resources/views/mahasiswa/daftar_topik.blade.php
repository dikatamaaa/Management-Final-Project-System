<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background-color: inherit;
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
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/beranda"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link active" href="/mahasiswa/daftar_topik"><i class="far fa-file-alt"></i><span>Daftar Topik</span></a>
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
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::guard('mahasiswa')->user()->nama_pengguna }}</span><span class="badge rounded-pill me-2" style="background: #881d1d;">Mahasiswa</span><img class="border rounded-circle img-profile" src="{{ asset('/storage/assets/img/avatars/'.(Auth::guard('mahasiswa')->user()->foto ?? 'default.jpg')) }}"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="/mahasiswa/profil"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profil</a>
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
                        <a href="{{ route('mahasiswa.form_buat_topik') }}" class="btn btn-primary">Buat Topik Sendiri</a>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <p class="text-dark m-0 fw-bold">Data Daftar Topik</p><button class="btn btn-sm link-light" type="button" style="background: #881d1d;" data-bs-toggle="modal" data-bs-target="#ModalDaftarTopikYangDipilih"><i class="fas fa-eye"></i>&nbsp;Daftar Topik Yang Dipilih</button>
                            <div class="modal fade" role="dialog" tabindex="-1" id="ModalDaftarTopikYangDipilih">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" style="color: var(--bs-emphasis-color);font-weight: bold;">Daftar Topik Yang Dipilih</h5><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            @php
                                                $nim = auth()->guard('mahasiswa')->user()->nim;
                                                $topik_dipilih = null;
                                                foreach($daftarTopik as $topik) {
                                                    if(\App\Models\Kelompok::where('judul', $topik->judul)->where('nim', $nim)->exists()) {
                                                        $topik_dipilih = $topik;
                                                        break;
                                                    }
                                                }
                                                $anggota = $topik_dipilih ? \App\Models\Kelompok::where('judul', $topik_dipilih->judul)->get() : collect();
                                            @endphp
                                            @if($topik_dipilih)
                                            <div class="row">
                                                <div class="col"><span class="text-dark fw-bold">Judul</span></div>
                                                <div class="col">
                                                    <p class="text-dark"><span class="text-dark fw-bold">:</span>&nbsp;{{ $topik_dipilih->judul }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><span class="text-dark fw-bold">Kode Dosen</span></div>
                                                <div class="col">
                                                    <p class="text-dark"><span class="text-dark fw-bold">:</span>&nbsp;{{ $topik_dipilih->kode_dosen }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><span class="text-dark fw-bold">Kelompok</span></div>
                                                <div class="col">
                                                    <p class="text-dark"><span class="text-dark fw-bold">:</span>&nbsp;
                                                        @foreach($anggota as $a)
                                                            <span class="badge rounded-pill bg-dark m-1">{{ $a->nama_anggota }}</span>
                                                        @endforeach
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><span class="text-dark fw-bold">Status</span></div>
                                                <div class="col">
                                                    <p class="text-dark"><span class="text-dark fw-bold">:</span>&nbsp;
                                                        @if($topik_dipilih->status == 'Tersedia' || $topik_dipilih->status == 'Available')
                                                            <span class="badge rounded-pill bg-success">Available</span>
                                                        @elseif($topik_dipilih->status == 'Penuh' || $topik_dipilih->status == 'Full')
                                                            <span class="badge rounded-pill bg-danger">Full</span>
                                                        @elseif($topik_dipilih->status == 'Proposal')
                                                            <span class="badge rounded-pill bg-primary">Proposal</span>
                                                        @elseif($topik_dipilih->status == 'TA')
                                                            <span class="badge rounded-pill bg-info text-dark">Tugas Akhir</span>
                                                        @else
                                                            <span class="badge rounded-pill bg-warning text-dark">{{ $topik_dipilih->status }}</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            @else
                                            <div class="row">
                                                <div class="col text-center text-muted">Belum ada topik yang dipilih oleh kelompok Anda.</div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-striped table-hover" id="tableData">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Kode Dosen</th>
                                            <th>Kuota</th>
                                            <th>Bidang</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $nim = auth()->guard('mahasiswa')->user()->nim;
                                            $topikSaya = [];
                                            $topikLain = [];
                                            foreach($daftarTopik as $topik) {
                                                $sudah_booking = \App\Models\Kelompok::where('judul', $topik->judul)->where('nim', $nim)->exists();
                                                if($sudah_booking) {
                                                    $topikSaya[] = $topik;
                                                } else {
                                                    $topikLain[] = $topik;
                                                }
                                            }
                                            $daftarTopikUrut = array_merge($topikSaya, $topikLain);
                                            $no = 1;
                                        @endphp
                                        @foreach($daftarTopikUrut as $topik)
                                            @php
                                                $anggota = \App\Models\Kelompok::where('judul', $topik->judul)->get();
                                                $sudah_booking = \App\Models\Kelompok::where('judul', $topik->judul)->where('nim', $nim)->exists();
                                                $sudah_punya_kelompok = \App\Models\Kelompok::where('nim', $nim)->exists();
                                            @endphp
                                            <tr class="clickable-row{{ $sudah_booking ? ' topik-saya' : '' }}" data-bs-toggle="modal" data-bs-target="#ModalLihatDaftarTopik{{ $topik->id }}">
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $topik->judul }}</td>
                                                <td>{{ $topik->kode_dosen }}</td>
                                                <td>{{ $topik->kuota }} Orang</td>
                                                <td>
                                                    @if(is_array($topik->bidang))
                                                        @foreach($topik->bidang as $bidang)
                                                            <span class="badge bg-dark me-1">{{ $bidang }}</span>
                                                        @endforeach
                                                    @else
                                                        <span class="badge bg-dark me-1">{{ $topik->bidang }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($topik->status == 'Tersedia' || $topik->status == 'Available')
                                                        <span class="badge rounded-pill bg-success">Available</span>
                                                        @if(!$sudah_punya_kelompok)
                                                            <form action="{{ route('mahasiswa.pilih_topik', $topik->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="button" class="btn btn-primary btn-sm ms-2"
                                                                    onclick="event.stopPropagation(); this.form.submit(); return false;"
                                                                    onmousedown="event.stopPropagation();">
                                                                    Pilih Topik
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @elseif($topik->status == 'Penuh' || $topik->status == 'Full')
                                                        <span class="badge rounded-pill bg-danger">Full</span>
                                                    @elseif($topik->status == 'Proposal')
                                                        <span class="badge rounded-pill bg-primary">Proposal</span>
                                                    @elseif($topik->status == 'TA')
                                                        <span class="badge rounded-pill bg-info text-dark">Tugas Akhir</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-warning text-dark">{{ $topik->status }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>No</strong></td>
                                            <td><strong>Judul</strong></td>
                                            <td><strong>Kode Dosen</strong></td>
                                            <td><strong>Kuota</strong></td>
                                            <td><strong>Bidang</strong></td>
                                            <td><strong>Status</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
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
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="{{ asset('/storage/assets/js/theme.js') }}"></script>
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

        // Kembalikan fokus ke tombol pemicu modal setelah modal ditutup
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var target = btn.getAttribute('data-bs-target');
                var modal = document.querySelector(target);
                if (modal) {
                    modal.addEventListener('hidden.bs.modal', function () {
                        btn.focus();
                    }, { once: true });
                }
            });
        });

        // Hilangkan warning aria-hidden dengan memindahkan fokus ke body setelah modal ditutup
        document.querySelectorAll('.modal').forEach(function(modal) {
            modal.addEventListener('hidden.bs.modal', function () {
                document.activeElement.blur(); // Hilangkan fokus dari elemen manapun
                document.body.focus(); // Pindahkan fokus ke body
            });
        });

        $(document).on('shown.bs.modal', '.modal', function () {
            $(this).find('.select-mahasiswa').select2({
                dropdownParent: $(this),
                width: '100%',
                placeholder: '-- Pilih Mahasiswa --',
                matcher: function(params, data) {
                    if ($.trim(params.term) === '') {
                        return data;
                    }
                    var term = params.term.toLowerCase();
                    var text = (data.text || '').toLowerCase();
                    var nim = $(data.element).data('nim') ? $(data.element).data('nim').toString().toLowerCase() : '';
                    if (text.indexOf(term) > -1 || nim.indexOf(term) > -1) {
                        return data;
                    }
                    return null;
                }
            });
        });
    </script>
    <!-- Setelah tabel, render semua modal tambah anggota di luar tabel -->
    @foreach($daftarTopik as $topik)
        @php
            $nim = auth()->guard('mahasiswa')->user()->nim;
            $sudah_booking = \App\Models\Kelompok::where('judul', $topik->judul)->where('nim', $nim)->exists();
        @endphp
        @if($sudah_booking)
        <div class="modal fade" id="modalTambahAnggota{{ $topik->id }}" tabindex="-1" aria-labelledby="modalTambahAnggotaLabel{{ $topik->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('mahasiswa.tambah_anggota_kelompok', $topik->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahAnggotaLabel{{ $topik->id }}">Tambah Anggota Kelompok</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Pilih Mahasiswa</label>
                            <select name="nim" class="form-select select-mahasiswa" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach(\App\Models\Mahasiswa::whereNotIn('nim', \App\Models\Kelompok::pluck('nim'))->get() as $mhs)
                                    <option value="{{ $mhs->nim }}" data-nim="{{ $mhs->nim }}">{{ $mhs->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    @endforeach
    <!-- Setelah tabel, render semua modal Lihat di luar tabel -->
    @foreach($daftarTopik as $topik)
    <div class="modal fade" id="ModalLihatDaftarTopik{{ $topik->id }}" tabindex="-1" aria-labelledby="ModalLihatDaftarTopikLabel{{ $topik->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLihatDaftarTopikLabel{{ $topik->id }}">Lihat Topik {{ $topik->judul }}
                        @php
                            $nim = auth()->guard('mahasiswa')->user()->nim;
                            $sudah_booking = \App\Models\Kelompok::where('judul', $topik->judul)->where('nim', $nim)->exists();
                        @endphp
                        
                            @if($sudah_booking && $topik->status == 'Booked')
                                <button type="button" class="btn btn-success btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota{{ $topik->id }}" onclick="event.stopPropagation();">
                                    Tambah Anggota
                                </button>
                            @endif
                            
                        
                    </h5>
                    <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4"><span style="font-weight: bold;">Judul</span></div>
                        <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $topik->judul }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-4"><span style="font-weight: bold;">Jurusan</span></div>
                        <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $topik->program_studi ?? '-' }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-4"><span style="font-weight: bold;">Fakultas</span></div>
                        <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $topik->fakultas ?? '-' }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-4"><span style="font-weight: bold;">Bidang</span></div>
                        <div class="col-8">
                            <p><span class="fw-bold">:&nbsp;</span>
                                @if(is_array($topik->bidang))
                                    @foreach($topik->bidang as $bidang)
                                        <span class="badge bg-dark me-1">{{ $bidang }}</span>
                                    @endforeach
                                @else
                                    <span class="badge bg-dark me-1">{{ $topik->bidang }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4"><span style="font-weight: bold;">Kuota</span></div>
                        <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $topik->kuota }} Orang</p></div>
                    </div>
                    <div class="row">
                        <div class="col-4"><span style="font-weight: bold;">Dosen</span></div>
                        <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $topik->dosen ?? '-' }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-4"><span style="font-weight: bold;">Kode Dosen</span></div>
                        <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $topik->kode_dosen ?? '-' }}</p></div>
                    </div>
                    <div class="row">
                        <div class="col-4"><span style="font-weight: bold;">Status</span></div>
                        <div class="col-8">
                            <p><span class="fw-bold">:&nbsp;</span>
                                @if($topik->status == 'Tersedia' || $topik->status == 'Available')
                                    <span class="badge rounded-pill bg-success">Available</span>
                                @elseif($topik->status == 'Penuh' || $topik->status == 'Full')
                                    <span class="badge rounded-pill bg-danger">Full</span>
                                @elseif($topik->status == 'Proposal')
                                    <span class="badge rounded-pill bg-primary">Proposal</span>
                                @elseif($topik->status == 'TA')
                                    <span class="badge rounded-pill bg-info text-dark">Tugas Akhir</span>
                                @else
                                    <span class="badge rounded-pill bg-warning text-dark">{{ $topik->status }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4"><span style="font-weight: bold;">Kelompok</span></div>
                        <div class="col-8">
                            <p><span class="fw-bold">:&nbsp;</span>
                                <div class="kelompok-badge-list">
                                @php $anggota = \App\Models\Kelompok::where('judul', $topik->judul)->get(); @endphp
                                @if($anggota->count() > 0)
                                    @foreach($anggota as $a)
                                        <span class="badge rounded-pill bg-dark m-1">{{ $a->nama_anggota }} ({{ $a->nim }})</span>
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
                        <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $topik->deskripsi ?? '-' }}</p></div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if($topik->status == 'Booked' && $sudah_booking)
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalBatalBooked{{ $topik->id }}" onclick="event.stopPropagation();">
                            Batal Booked
                        </button>
                    @endif
                    @if($topik->status == 'Menunggu Pembimbing' && $sudah_booking)
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalBatalMenunggu{{ $topik->id }}" onclick="event.stopPropagation();">
                            Batal
                        </button>
                    @endif
                    <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal">
                        <i class="fa fa-close"></i>&nbsp;Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Batal Booked -->
    @if($topik->status == 'Booked' && $sudah_booking)
    <div class="modal fade" id="modalBatalBooked{{ $topik->id }}" tabindex="-1" aria-labelledby="modalBatalBookedLabel{{ $topik->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('mahasiswa.batal_booked', $topik->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBatalBookedLabel{{ $topik->id }}">Konfirmasi Batal Booked</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin membatalkan booking topik <strong>{{ $topik->judul }}</strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Ya, Batalkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    @if($topik->status == 'Menunggu Pembimbing' && $sudah_booking)
    <div class="modal fade" id="modalBatalMenunggu{{ $topik->id }}" tabindex="-1" aria-labelledby="modalBatalMenungguLabel{{ $topik->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('mahasiswa.batal_menunggu', $topik->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBatalMenungguLabel{{ $topik->id }}">Konfirmasi Batal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin membatalkan pengajuan topik <strong>{{ $topik->judul }}</strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Ya, Batalkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    <style>
    body, table, th, td {
        font-family: 'Poppins', 'Roboto', Arial, sans-serif;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
        --bs-table-accent-bg: #fafbfc;
    }
    .table th, .table td {
        border: none;
        padding: 0.7rem 1rem;
        vertical-align: middle;
    }
    .table thead th {
        background: #f3f4f6;
        color: #881d1d;
        font-weight: 700;
        font-size: 1.08em;
        letter-spacing: 0.02em;
        border-bottom: 2px solid #d1d5db;
    }
    .table {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 16px 0 rgba(60,72,88,.08);
    }
    .table-responsive {
        border-radius: 16px;
        box-shadow: 0 2px 16px 0 rgba(60,72,88,.08);
        margin-bottom: 0.5rem;
    }
    .topik-saya {
        background: linear-gradient(90deg, #f3e8e8 80%, #fff 100%) !important;
        border-left: 5px solid #881d1d;
        font-weight: 600;
        box-shadow: 0 2px 12px 0 rgba(136,29,29,0.07);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .topik-saya:hover {
        background: linear-gradient(90deg, #fbeee7 80%, #fff 100%) !important;
        box-shadow: 0 4px 24px 0 rgba(136,29,29,0.13);
    }
    .badge {
        border-radius: 10px;
        font-size: 0.97em;
        padding: 0.38em 0.9em;
        font-weight: 600;
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
    .btn-primary.btn-sm, .btn-success.btn-sm {
        border-radius: 8px;
        font-size: 1em;
        font-weight: 500;
        padding: 0.38em 1.2em;
        box-shadow: 0 2px 8px 0 rgba(37,99,235,0.08);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-primary.btn-sm:hover, .btn-success.btn-sm:hover {
        filter: brightness(0.95);
        box-shadow: 0 4px 16px 0 rgba(37,99,235,0.13);
    }
    .clickable-row {
        cursor: pointer;
        transition: background 0.18s;
    }
    .clickable-row:hover {
        background: #f1f5f9 !important;
    }
    @media (max-width: 768px) {
        .table th, .table td {
            padding: 0.45rem 0.3rem;
            font-size: 0.98em;
        }
        .btn-primary.btn-sm, .btn-success.btn-sm {
            font-size: 0.93em;
            padding: 0.32em 0.7em;
        }
    }
    /* Hilangkan space kosong bawah tabel */
    .table-responsive {
        margin-bottom: 0.5rem;
    }
    .kelompok-badge-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.3em 0.5em;
        margin-bottom: 0.5em;
    }
    .kelompok-badge-list .badge {
        display: inline-block;
        margin-bottom: 0.2em;
        word-break: break-word;
        white-space: normal;
        max-width: 100%;
        font-size: 0.98em;
        padding: 0.45em 1em;
    }
    </style>
</body>
</html>