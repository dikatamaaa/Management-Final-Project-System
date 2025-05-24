@php
// Helper untuk ambil penilaian anggota
if (!function_exists('getNilaiAnggota')) {
    function getNilaiAnggota($penilaian, $nim, $judul, $pembimbing, $dosen) {
        $row = $penilaian->where('nim', $nim)->where('kelompok_judul', $judul)->where('pembimbing', $pembimbing)->where('dosen_nama', $dosen)->first();
        return $row ? $row->nilai : '';
    }
    function getCatatanAnggota($penilaian, $nim, $judul, $pembimbing, $dosen) {
        $row = $penilaian->where('nim', $nim)->where('kelompok_judul', $judul)->where('pembimbing', $pembimbing)->where('dosen_nama', $dosen)->first();
        return $row ? $row->catatan : '';
    }
    function getNilaiKelompok($penilaian, $judul, $pembimbing, $dosen) {
        $row = $penilaian->whereNull('nim')->where('kelompok_judul', $judul)->where('pembimbing', $pembimbing)->where('dosen_nama', $dosen)->first();
        return $row ? $row->nilai : '';
    }
    function getCatatanKelompok($penilaian, $judul, $pembimbing, $dosen) {
        $row = $penilaian->whereNull('nim')->where('kelompok_judul', $judul)->where('pembimbing', $pembimbing)->where('dosen_nama', $dosen)->first();
        return $row ? $row->catatan : '';
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
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
                <li class="nav-item"><a class="nav-link active" href="/dosen/beranda"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li class="nav-item"><a class="nav-link" href="/dosen/daftar_topik"><i class="far fa-file-alt"></i><span>Daftar Topik</span></a></li>
                <li class="nav-item"><a class="nav-link" href="/dosen/template_laporan"><i class="fas fa-file-word"></i><span>Template Laporan</span></a></li>
                <li class="nav-item"><a class="nav-link" href="/dosen/pembimbing-dua"><i class="fas fa-user-friends"></i><span>Pembimbing Dua</span></a></li>
                <li class="nav-item"><a class="nav-link" href="/dosen/bimbingan"><i class="fas fa-file-word"></i><span>Bimbingan</span></a></li>
                <li class="nav-item"><a class="nav-link" href="/dosen/progres_ta"><i class="fas fa-chart-line"></i><span>Progres Tugas Akhir</span></a></li>
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
                <h4 class="mb-4">Penilaian Kelompok & Anggota</h4>
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
                                @if($kelompokPemb1->count())
                                    @foreach($kelompokPemb1 as $judul => $anggota)
                                        <div class="card mb-4">
                                            <div class="card-header bg-primary text-white">
                                                <b>Kelompok:</b> {{ $judul }}
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('dosen.penilaian_kelompok.simpan') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="kelompok_judul" value="{{ $judul }}">
                                                    <input type="hidden" name="pembimbing" value="1">
                                                    <table class="table table-bordered table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>NIM</th>
                                                                <th>Nama</th>
                                                                <th>Nilai Anggota</th>
                                                                <th>Catatan Anggota</th>
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
                                                                <td><input type="number" name="anggota[{{ $i }}][nilai]" class="form-control form-control-sm" min="0" max="100" value="{{ getNilaiAnggota($penilaian, $mhs->nim, $judul, 1, $nama_dosen) }}" required></td>
                                                                <td><input type="text" name="anggota[{{ $i }}][catatan]" class="form-control form-control-sm" value="{{ getCatatanAnggota($penilaian, $mhs->nim, $judul, 1, $nama_dosen) }}"></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="mb-2">
                                                        <label><b>Nilai Kelompok</b></label>
                                                        <input type="number" name="nilai_kelompok" class="form-control" min="0" max="100" value="{{ getNilaiKelompok($penilaian, $judul, 1, $nama_dosen) }}" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label><b>Catatan Kelompok</b></label>
                                                        <input type="text" name="catatan_kelompok" class="form-control" value="{{ getCatatanKelompok($penilaian, $judul, 1, $nama_dosen) }}">
                                                    </div>
                                                    <button class="btn btn-success" type="submit">Simpan Penilaian Kelompok</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-info">Tidak ada kelompok yang Anda bimbing sebagai Pembimbing 1.</div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="pemb2" role="tabpanel">
                                @if($kelompokPemb2->count())
                                    @foreach($kelompokPemb2 as $judul => $anggota)
                                        <div class="card mb-4">
                                            <div class="card-header bg-secondary text-white">
                                                <b>Kelompok:</b> {{ $judul }}
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('dosen.penilaian_kelompok.simpan') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="kelompok_judul" value="{{ $judul }}">
                                                    <input type="hidden" name="pembimbing" value="2">
                                                    <table class="table table-bordered table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>NIM</th>
                                                                <th>Nama</th>
                                                                <th>Nilai Anggota</th>
                                                                <th>Catatan Anggota</th>
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
                                                                <td><input type="number" name="anggota[{{ $i }}][nilai]" class="form-control form-control-sm" min="0" max="100" value="{{ getNilaiAnggota($penilaian, $mhs->nim, $judul, 2, $nama_dosen) }}" required></td>
                                                                <td><input type="text" name="anggota[{{ $i }}][catatan]" class="form-control form-control-sm" value="{{ getCatatanAnggota($penilaian, $mhs->nim, $judul, 2, $nama_dosen) }}"></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="mb-2">
                                                        <label><b>Nilai Kelompok</b></label>
                                                        <input type="number" name="nilai_kelompok" class="form-control" min="0" max="100" value="{{ getNilaiKelompok($penilaian, $judul, 2, $nama_dosen) }}" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label><b>Catatan Kelompok</b></label>
                                                        <input type="text" name="catatan_kelompok" class="form-control" value="{{ getCatatanKelompok($penilaian, $judul, 2, $nama_dosen) }}">
                                                    </div>
                                                    <button class="btn btn-success" type="submit">Simpan Penilaian Kelompok</button>
                                                </form>
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
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © infoTA 2025</span></div>
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
</body>
</html> 