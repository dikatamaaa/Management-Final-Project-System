@php
// Helper untuk ambil penilaian anggota
if (!function_exists('getNilaiAnggota')) {
    function getNilaiAnggota($penilaian, $nim, $judul, $pembimbing, $dosen) {
        $row = $penilaian->where('nim', $nim)->where('kelompok_judul', $judul)->where('pembimbing', $pembimbing)->where('dosen_nama', $dosen)->first();
        return $row ? $row->nilai : '';
    }
    function getNilaiKelompok($penilaian, $judul, $pembimbing, $dosen) {
        $row = $penilaian->whereNull('nim')->where('kelompok_judul', $judul)->where('pembimbing', $pembimbing)->where('dosen_nama', $dosen)->first();
        return $row ? $row->nilai : '';
    }
}
// Helper baru untuk rubrik custom
if (!function_exists('getNilaiRubrik')) {
    function getNilaiRubrik($penilaian, $nim, $judul, $pembimbing, $dosen, $rubrik_id) {
        $row = $penilaian->where('nim', $nim)
            ->where('kelompok_judul', $judul)
            ->where('pembimbing', $pembimbing)
            ->where('dosen_nama', $dosen)
            ->where('rubrik_id', $rubrik_id)
            ->first();
        return $row ? $row->nilai : '';
    }
}
@endphp

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Penilaian Kelompok - infoTA</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap">
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
                <li class="nav-item">
                    <a class="nav-link" href="/dosen/pembimbing-dua"><i class="fas fa-user-friends"></i><span>Pembimbing Dua</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dosen/bimbingan"><i class="fas fa-file-word"></i><span>Bimbingan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dosen/progres_ta"><i class="fas fa-chart-line"></i><span>Progres Tugas Akhir</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="/dosen/penilaian-kelompok"><i class="fas fa-pencil-alt"></i><span>Penilaian Kelompok</span></a>
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
                    <h3 class="text-dark mb-0">Penilaian Kelompok & Anggota</h3>
                </div>
                <a href="{{ route('dosen.penilaian_kelompok.export_csv') }}" target="_blank" class="btn btn-success mb-3">Export Semua (.csv)</a>
                <a href="{{ route('dosen.penilaian_kelompok.export_csv', ['pembimbing'=>1]) }}" target="_blank" class="btn btn-primary mb-3 ms-2">Export Pembimbing 1 (.csv)</a>
                <a href="{{ route('dosen.penilaian_kelompok.export_csv', ['pembimbing'=>2]) }}" target="_blank" class="btn btn-info mb-3 ms-2">Export Pembimbing 2 (.csv)</a>
                @if(session('success'))
                    <script>Swal.fire({icon:'success',title:'Berhasil',text:'{{ session('success') }}',showConfirmButton:false,timer:2000});</script>
                @endif
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs mb-3" id="tabPenilaian" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pemb1-tab" data-bs-toggle="tab" data-bs-target="#pemb1" type="button" role="tab">Sebagai Pembimbing 1</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pemb2-tab" data-bs-toggle="tab" data-bs-target="#pemb2" type="button" role="tab">Sebagai Pembimbing 2</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="tabPenilaianContent">
                            <div class="tab-pane fade show active" id="pemb1" role="tabpanel">
                                <input type="text" class="form-control mb-3" id="searchKelompok1" placeholder="Cari kelompok...">
                                <div class="accordion" id="accordionKelompok1">
                                @if($kelompokPemb1->count())
                                    @foreach($kelompokPemb1 as $judul => $anggota)
                                        <div class="accordion-item mb-3">
                                            <h2 class="accordion-header" id="heading1-{{ $loop->index }}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1-{{ $loop->index }}" aria-expanded="false" aria-controls="collapse1-{{ $loop->index }}">
                                                    Kelompok: {{ $judul }}
                                                </button>
                                            </h2>
                                            <div id="collapse1-{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="heading1-{{ $loop->index }}" data-bs-parent="#accordionKelompok1">
                                                <div class="accordion-body">
                                                    <form action="{{ route('dosen.penilaian_kelompok.simpan') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="kelompok_judul" value="{{ $judul }}">
                                                        <input type="hidden" name="pembimbing" value="1">
                                                        @foreach($rubrik as $aspek)
                                                            @if($aspek->tipe == 'kelompok')
                                                                <div class="mb-2">
                                                                    <label><b>{{ $aspek->aspek }}</b> (Kelompok)</label>
                                                                    <select name="kelompok_rubrik[{{ $aspek->id }}]" class="form-select" required>
                                                                        @foreach($aspek->indikator as $skor => $label)
                                                                            <option value="{{ $skor }}" {{ getNilaiRubrik($penilaian, null, $judul, 1, $nama_dosen, $aspek->id) == $skor ? 'selected' : '' }}>{{ $skor }} - {{ $label }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @else
                                                                <div class="mb-2">
                                                                    <label><b>{{ $aspek->aspek }}</b> (Individu)</label>
                                                                    <table class="table table-bordered table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>NIM</th>
                                                                                <th>Nama</th>
                                                                                <th>Nilai</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($anggota as $i => $mhs)
                                                                            <tr>
                                                                                <td>
                                                                                    {{ $mhs->nim }}
                                                                                    <input type="hidden" name="anggota[{{ $i }}][nim]" value="{{ $mhs->nim }}">
                                                                                </td>
                                                                                <td>{{ $mhs->nama_anggota }}</td>
                                                                                <td>
                                                                                    <select name="anggota[{{ $i }}][nilai_rubrik][{{ $aspek->id }}]" class="form-select form-select-sm" required>
                                                                                        @foreach($aspek->indikator as $skor => $label)
                                                                                            <option value="{{ $skor }}" {{ getNilaiRubrik($penilaian, $mhs->nim, $judul, 1, $nama_dosen, $aspek->id) == $skor ? 'selected' : '' }}>{{ $skor }} - {{ $label }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        <button class="btn btn-success" type="submit">Simpan Penilaian Kelompok</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-info">Tidak ada kelompok yang Anda bimbing sebagai Pembimbing 1.</div>
                                @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pemb2" role="tabpanel">
                                <input type="text" class="form-control mb-3" id="searchKelompok2" placeholder="Cari kelompok...">
                                <div class="accordion" id="accordionKelompok2">
                                @if($kelompokPemb2->count())
                                    @foreach($kelompokPemb2 as $judul => $anggota)
                                        <div class="accordion-item mb-3">
                                            <h2 class="accordion-header" id="heading2-{{ $loop->index }}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-{{ $loop->index }}" aria-expanded="false" aria-controls="collapse2-{{ $loop->index }}">
                                                    Kelompok: {{ $judul }}
                                                </button>
                                            </h2>
                                            <div id="collapse2-{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="heading2-{{ $loop->index }}" data-bs-parent="#accordionKelompok2">
                                                <div class="accordion-body">
                                                    <form action="{{ route('dosen.penilaian_kelompok.simpan') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="kelompok_judul" value="{{ $judul }}">
                                                        <input type="hidden" name="pembimbing" value="2">
                                                        @foreach($rubrik as $aspek)
                                                            @if($aspek->tipe == 'kelompok')
                                                                <div class="mb-2">
                                                                    <label><b>{{ $aspek->aspek }}</b> (Kelompok)</label>
                                                                    <select name="kelompok_rubrik[{{ $aspek->id }}]" class="form-select" required>
                                                                        @foreach($aspek->indikator as $skor => $label)
                                                                            <option value="{{ $skor }}" {{ getNilaiRubrik($penilaian, null, $judul, 2, $nama_dosen, $aspek->id) == $skor ? 'selected' : '' }}>{{ $skor }} - {{ $label }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @else
                                                                <div class="mb-2">
                                                                    <label><b>{{ $aspek->aspek }}</b> (Individu)</label>
                                                                    <table class="table table-bordered table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>NIM</th>
                                                                                <th>Nama</th>
                                                                                <th>Nilai</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($anggota as $i => $mhs)
                                                                            <tr>
                                                                                <td>
                                                                                    {{ $mhs->nim }}
                                                                                    <input type="hidden" name="anggota[{{ $i }}][nim]" value="{{ $mhs->nim }}">
                                                                                </td>
                                                                                <td>{{ $mhs->nama_anggota }}</td>
                                                                                <td>
                                                                                    <select name="anggota[{{ $i }}][nilai_rubrik][{{ $aspek->id }}]" class="form-select form-select-sm" required>
                                                                                        @foreach($aspek->indikator as $skor => $label)
                                                                                            <option value="{{ $skor }}" {{ getNilaiRubrik($penilaian, $mhs->nim, $judul, 2, $nama_dosen, $aspek->id) == $skor ? 'selected' : '' }}>{{ $skor }} - {{ $label }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        <button class="btn btn-success" type="submit">Simpan Penilaian Kelompok</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-info">Tidak ada kelompok yang Anda bimbing sebagai Pembimbing 2.</div>
                                @endif
                                </div>
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
    document.getElementById('searchKelompok1').addEventListener('input', function() {
        let val = this.value.toLowerCase();
        document.querySelectorAll('#accordionKelompok1 .accordion-item').forEach(function(item) {
            item.style.display = item.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });
    document.getElementById('searchKelompok2').addEventListener('input', function() {
        let val = this.value.toLowerCase();
        document.querySelectorAll('#accordionKelompok2 .accordion-item').forEach(function(item) {
            item.style.display = item.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });
</script>
</body>
</html> 