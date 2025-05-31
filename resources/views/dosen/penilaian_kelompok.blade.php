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
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: #f7f8fa;
        }
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 2px 16px 0 rgba(60,72,88,.08);
            margin-bottom: 32px;
        }
        .card-header {
            border-radius: 18px 18px 0 0;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }
        .accordion {
            --bs-accordion-bg: transparent;
        }
        .accordion-item {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px 0 rgba(60,72,88,.07);
            margin-bottom: 18px;
            background: #fff;
            overflow: hidden;
            transition: box-shadow 0.2s;
        }
        .accordion-item:focus-within, .accordion-item:hover {
            box-shadow: 0 4px 24px 0 rgba(136,29,29,0.10);
        }
        .accordion-button {
            background: linear-gradient(90deg, #fff 60%, #f7eaea 100%);
            color: #881d1d;
            font-weight: 600;
            font-size: 1.08rem;
            border: none;
            border-radius: 16px 16px 0 0;
            box-shadow: none;
            padding: 18px 22px;
            transition: background 0.2s, color 0.2s;
        }
        .accordion-button:not(.collapsed) {
            background: linear-gradient(90deg, #881d1d 60%, #b94a4a 100%);
            color: #fff;
        }
        .accordion-button:after {
            transition: transform 0.3s;
        }
        .accordion-button:not(.collapsed):after {
            transform: rotate(90deg);
        }
        .accordion-body {
            background: #fff;
            padding: 24px 18px 18px 18px;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e0e3e7;
            font-size: 0.98rem;
            transition: border-color 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #881d1d;
            box-shadow: 0 0 0 2px #f3d6d6;
        }
        .btn-success, .btn-primary, .btn-info {
            border-radius: 8px;
            font-weight: 500;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px 0 rgba(136,29,29,0.08);
            transition: background 0.2s, box-shadow 0.2s;
        }
        .btn-success:hover, .btn-primary:hover, .btn-info:hover {
            filter: brightness(0.95);
            box-shadow: 0 4px 16px 0 rgba(136,29,29,0.12);
        }
        .nav-tabs .nav-link {
            border: none;
            border-radius: 8px 8px 0 0;
            color: #881d1d;
            background: #f0f2f5;
            margin-right: 4px;
            font-weight: 500;
            transition: background 0.2s, color 0.2s;
        }
        .nav-tabs .nav-link.active {
            background: #fff;
            color: #fff;
            background: linear-gradient(90deg, #881d1d 60%, #b94a4a 100%);
            color: #fff;
            box-shadow: 0 2px 8px 0 rgba(136,29,29,0.08);
        }
        .alert-info {
            border-radius: 8px;
            background: #eaf3fa;
            color: #2b4a5f;
            border: none;
        }
        h4.mb-4 {
            font-weight: 700;
            color: #881d1d;
            letter-spacing: 0.5px;
        }
        #searchKelompok1, #searchKelompok2 {
            border-radius: 12px;
            border: 1.5px solid #e0e3e7;
            font-size: 1.05rem;
            padding: 12px 16px;
            margin-bottom: 18px;
            box-shadow: 0 1px 4px 0 rgba(60,72,88,.04);
            transition: border-color 0.2s;
        }
        #searchKelompok1:focus, #searchKelompok2:focus {
            border-color: #881d1d;
            box-shadow: 0 0 0 2px #f3d6d6;
        }
        .table {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }
        .table th, .table td {
            border: none;
            padding: 10px 14px;
            vertical-align: middle;
        }
        .table thead th {
            background: #f0f2f5;
            color: #333;
            font-weight: 600;
        }
        .table tbody tr {
            transition: background 0.2s;
        }
        .table tbody tr:hover {
            background: #f6f8fc;
        }
        @media (max-width: 600px) {
            .table th, .table td {
                font-size: 0.92rem;
                padding: 7px 6px;
            }
            .card-header, h4.mb-4 {
                font-size: 1rem;
            }
            .accordion-button {
                font-size: 0.98rem;
                padding: 13px 10px;
            }
            .accordion-body {
                padding: 14px 6px 10px 6px;
            }
        }
    </style>
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