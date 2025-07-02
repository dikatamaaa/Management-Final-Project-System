<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Admin</title>
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
                    <li class="nav-item active">
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
                        <h3 class="text-dark mb-0">Dashboard</h3>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-danger-emphasis fw-bold text-xs mb-1"><span>Topik yang tersedia</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>{{ $jumlahTersedia }}</span></div>
                                        </div>
                                        <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-clipboard2-check-fill fa-2x text-gray-300">
                                                <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5"></path>
                                                <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5m6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708Z"></path>
                                            </svg></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-danger-emphasis fw-bold text-xs mb-1"><span>Topik yang sudah diambil</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>{{ $jumlahDiambil }}</span></div>
                                        </div>
                                        <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-card-checklist fa-2x text-gray-300">
                                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"></path>
                                                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"></path>
                                            </svg></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-danger-emphasis fw-bold text-xs mb-1"><span>kelompok yang sudah selesai</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>199</span></div>
                                        </div>
                                        <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person-fill-check fa-2x text-gray-300">
                                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0"></path>
                                                <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4"></path>
                                            </svg></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-danger-emphasis fw-bold text-xs mb-1"><span>kelompok yang belum selesai</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>199</span></div>
                                        </div>
                                        <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person-fill-exclamation fa-2x text-gray-300">
                                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4"></path>
                                                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"></path>
                                            </svg></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Data Daftar Topik</p><a href="/dosen/daftar_topik" class="btn btn-sm" type="button" style="color: rgb(136,29,29);"><strong>Lihat Selengkapnya...</strong><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
                                        </svg></a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                        <table class="table table-striped table-hover" id="tableData1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Judul</th>
                                                    <th>Kode Dosen</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($daftarTopik as $i => $topik)
                                                <tr>
                                                    <td>{{ $i+1 }}</td>
                                                    <td>{{ $topik->judul }}</td>
                                                    <td>{{ $topik->kode_dosen }}</td>
                                                    <td>
                                                        @if($topik->status == 'Tersedia' || $topik->status == 'Available')
                                                            <span class="badge rounded-pill bg-success">Tersedia</span>
                                                        @elseif($topik->status == 'Penuh' || $topik->status == 'Full')
                                                            <span class="badge rounded-pill bg-danger">Penuh</span>
                                                        @else
                                                            <span class="badge rounded-pill bg-secondary">{{ $topik->status }}</span>
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
                                                    <td><strong>Status</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Data Progres Tugas Akhir</p><a href="/dosen/progres_ta" class="btn btn-sm" type="button" style="color: rgb(136,29,29);"><strong>Lihat Selengkapnya...</strong><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
                                        </svg></a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table mt-2" id="dataTable-2" role="grid" aria-describedby="dataTable_info">
                                        <table class="table table-striped table-hover" id="tableData2">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Judul</th>
                                                    <th>Capaian (%)</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Budidaya Ikan Air Tawar</td>
                                                    <td>40%</td>
                                                    <td><button class="btn btn-info btn-sm ms-1" type="button" data-bs-toggle="modal" data-bs-target="#ModalLihatProgresTugasAkhir"><i class="fas fa-eye"></i></button>
                                                        <div class="modal fade" role="dialog" tabindex="-1" id="ModalLihatProgresTugasAkhir">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" style="font-weight: bold;">Lihat Progres Tugas Akhir</h5><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-5"><span style="font-weight: bold;">Kelompok</span></div>
                                                                            <div class="col-7">
                                                                                <p><span class="fw-bold">:&nbsp;</span><span class="badge bg-dark m-1">Irfan</span><span class="badge bg-dark m-1">Dika</span><span class="badge bg-dark m-1">Geral</span></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5"><span style="font-weight: bold;">Judul</span></div>
                                                                            <div class="col-7">
                                                                                <p><span class="fw-bold">:&nbsp;</span>Budidaya Ikan Air Tawar</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5"><span style="font-weight: bold;">Status Pembimbing 1</span></div>
                                                                            <div class="col-7">
                                                                                <p><span class="fw-bold">:&nbsp;</span>Shin Tae Yong</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5"><span style="font-weight: bold;">Status Pembimbing 2</span></div>
                                                                            <div class="col-7">
                                                                                <p><span class="fw-bold">:&nbsp;</span>Umar Ali</p>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div id="PROGRES-TA" class="stepp-wrapper">
                                                                                    <div id="ITEM-CD1" class="stepper-item completed">
                                                                                        <div class="step-counter"><i><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-lg">
                                                                                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"></path>
                                                                                                </svg></i></div>
                                                                                        <div class="step-name"><small>CD 1</small></div>
                                                                                    </div>
                                                                                    <div id="ITEM-CD2" class="stepper-item completed">
                                                                                        <div class="step-counter"><i><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-lg">
                                                                                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"></path>
                                                                                                </svg></i></div>
                                                                                        <div class="step-name"><small>CD 2</small></div>
                                                                                    </div>
                                                                                    <div id="ITEM-CD3" class="stepper-item active">
                                                                                        <div class="step-counter"><i><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-file-word-fill">
                                                                                                    <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M5.485 4.879l1.036 4.144.997-3.655a.5.5 0 0 1 .964 0l.997 3.655 1.036-4.144a.5.5 0 0 1 .97.242l-1.5 6a.5.5 0 0 1-.967.01L8 7.402l-1.018 3.73a.5.5 0 0 1-.967-.01l-1.5-6a.5.5 0 1 1 .97-.242z"></path>
                                                                                                </svg></i></div>
                                                                                        <div class="step-name"><small>CD 3</small></div>
                                                                                    </div>
                                                                                    <div id="ITEM-CD4" class="stepper-item">
                                                                                        <div class="step-counter"><i><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-file-word-fill">
                                                                                                    <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M5.485 4.879l1.036 4.144.997-3.655a.5.5 0 0 1 .964 0l.997 3.655 1.036-4.144a.5.5 0 0 1 .97.242l-1.5 6a.5.5 0 0 1-.967.01L8 7.402l-1.018 3.73a.5.5 0 0 1-.967-.01l-1.5-6a.5.5 0 1 1 .97-.242z"></path>
                                                                                                </svg></i></div>
                                                                                        <div class="step-name"><small>CD 4</small></div>
                                                                                    </div>
                                                                                    <div id="ITEM-CD5" class="stepper-item">
                                                                                        <div class="step-counter"><i><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-file-word-fill">
                                                                                                    <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M5.485 4.879l1.036 4.144.997-3.655a.5.5 0 0 1 .964 0l.997 3.655 1.036-4.144a.5.5 0 0 1 .97.242l-1.5 6a.5.5 0 0 1-.967.01L8 7.402l-1.018 3.73a.5.5 0 0 1-.967-.01l-1.5-6a.5.5 0 1 1 .97-.242z"></path>
                                                                                                </svg></i></div>
                                                                                        <div class="step-name"><small>CD 5</small></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer"><button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tutup</button></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>No</strong></td>
                                                    <td><strong>Judul</strong></td>
                                                    <td><strong>Capaian (%)</strong></td>
                                                    <td><strong>Aksi</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Proporsi Topik per Dosen</p>
                                </div>
                                <div class="card-body">
                                    <canvas id="pieDosenTopikChart" height="180"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Jumlah Topik per Bidang</p>
                                </div>
                                <div class="card-body">
                                    <canvas id="bidangTopikChart" height="180"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Progress Bimbingan per Dosen</p>
                                </div>
                                <div class="card-body">
                                    <canvas id="lineBimbinganChart" height="180"></canvas>
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

        // Pie Chart: Proporsi Topik per Dosen
        const ctxPieDosen = document.getElementById('pieDosenTopikChart').getContext('2d');
        new Chart(ctxPieDosen, {
            type: 'pie',
            data: {
                labels: @json($pieLabels),
                datasets: [{
                    data: @json($pieData),
                    backgroundColor: [
                        '#60a5fa', '#4ade80', '#facc15', '#a78bfa', '#f87171', '#f472b6', '#34d399', '#fbbf24', '#818cf8', '#f87171'
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

        // Bar Chart: Jumlah Topik per Bidang
        const ctxBidang = document.getElementById('bidangTopikChart').getContext('2d');
        new Chart(ctxBidang, {
            type: 'bar',
            data: {
                labels: @json($barLabels),
                datasets: [{
                    label: 'Jumlah Topik',
                    data: @json($barData),
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
                        ticks: { color: '#64748b', font: { family: 'Poppins', size: 13 } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#e5e7eb' },
                        ticks: { color: '#64748b', font: { family: 'Poppins', size: 13 }, stepSize: 1 }
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Line Chart: Progress Bimbingan per Dosen
        const ctxLineBimbingan = document.getElementById('lineBimbinganChart').getContext('2d');
        new Chart(ctxLineBimbingan, {
            type: 'line',
            data: {
                labels: @json($progressLabels),
                datasets: [
                    @foreach($dosenList as $idx => $dosen)
                    {
                        label: '{{ $dosen }}',
                        data: @json($progressData[$dosen]),
                        borderColor: ['#60a5fa', '#4ade80', '#facc15', '#a78bfa', '#f87171', '#f472b6', '#34d399', '#fbbf24', '#818cf8', '#f87171'][$idx % 10],
                        backgroundColor: 'rgba(96,165,250,0.12)',
                        tension: 0.4,
                        fill: false,
                        pointRadius: 4,
                        pointBackgroundColor: ['#60a5fa', '#4ade80', '#facc15', '#a78bfa', '#f87171', '#f472b6', '#34d399', '#fbbf24', '#818cf8', '#f87171'][$idx % 10],
                    }@if(!$loop->last),@endif
                    @endforeach
                ]
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
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#64748b', font: { family: 'Poppins', size: 13 } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#e5e7eb' },
                        ticks: { color: '#64748b', font: { family: 'Poppins', size: 13 }, stepSize: 1 }
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
    <style>
    #pieDosenTopikChart, #bidangTopikChart, #lineBimbinganChart {
        min-height: 180px;
        max-height: 260px;
    }
    .card .card-body {
        padding-bottom: 1.5rem;
    }
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
    </style>
</body>
</html>