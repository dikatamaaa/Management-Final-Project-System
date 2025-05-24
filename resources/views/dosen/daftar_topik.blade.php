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
</head>
<style>
/* Samakan tampilan select2 dengan Bootstrap form-control */
.select2-container--default .select2-selection--single,
.select2-container--default .select2-selection--multiple {
    border: 1px solid #ced4da; /* Bootstrap default border */
    border-radius: 0.375rem;    /* Bootstrap border radius */
    height: auto;               /* Untuk menyesuaikan tinggi dinamis */
    font-size: 0.8475rem;       /* Ukuran font opsional */
}

/* Hover & focus state agar seperti input Bootstrap */
.select2-container--default .select2-selection--single:focus,
.select2-container--default .select2-selection--multiple:focus,
.select2-container--default .select2-selection--single:hover,
.select2-container--default .select2-selection--multiple:hover {
    border-color: #afb2b8;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25); /* Bootstrap's focus effect */
}

/* Ukuran font dropdown list */
.select2-results__option {
    font-size: 0.9375rem;
}

/* Ukuran font pada tag item yang dipilih (multiple mode) */
.select2-selection__choice {
    font-size: 0.875rem;
}
</style>
<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark" style="background: #881d1d;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon"><img class="img-fluid" src="{{ asset('/storage/assets/img/Logo/Logo%20White%20(1000%20x%201000%20piksel).png') }}" width="100px"></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="/dosen/beranda"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
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
                                            @foreach ($menampilkanDataDaftarTopik as $data)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{$data->judul}}</td>
                                                <td class="text-center">{{$data->kode_dosen}}</td>
                                                <td class="text-center">{{$data->kuota." Orang"}}</td>
                                                <td class="text-center">
                                                    @php $bidangList = $data->bidang; @endphp
                                                    @if ($bidangList)
                                                        @foreach ($bidangList as $bidang)
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
                                                        <span class="badge rounded-pill bg-info text-dark">TA</span>
                                                    @elseif($jumlah_anggota >= $data->kuota)
                                                        <span class="badge rounded-pill bg-danger">Full</span>
                                                        <div class="mt-2">
                                                            <form action="{{ route('kelompok.terima') }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                <input type="hidden" name="judul" value="{{ $data->judul }}">
                                                                <button type="submit" class="btn btn-success btn-sm ms-1">Diterima</button>
                                                            </form>
                                                            <button type="button" class="btn btn-danger btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#modalTolak{{ $data->id }}">Ditolak</button>
                                                        </div>
                                                        <!-- Modal Alasan Ditolak -->
                                                        <div class="modal fade" id="modalTolak{{ $data->id }}" tabindex="-1" aria-labelledby="modalTolakLabel{{ $data->id }}" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form action="{{ route('kelompok.tolak') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="judul" value="{{ $data->judul }}">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="modalTolakLabel{{ $data->id }}">Alasan Penolakan</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <textarea name="alasan" class="form-control" rows="3" placeholder="Tulis alasan penolakan..." required></textarea>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif($data->status == 'Tersedia')
                                                        <span class="badge rounded-pill bg-success">Available</span>
                                                    @elseif($data->status == 'Booked')
                                                        <span class="badge rounded-pill bg-warning text-dark">Booked</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-warning text-dark">{{ $data->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <p class="text-center">
                                                        <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#ModalEditDaftarTopik{{$data->id}}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm ms-1 me-1" type="button" data-bs-toggle="modal" data-bs-target="#ModalHapusDaftarTopik{{$data->id}}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#ModalLihatDaftarTopik{{$data->id}}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-success btn-sm ms-1" type="button" data-bs-toggle="modal" data-bs-target="#ModalTambahMahasiswa{{$data->id}}">
                                                            <i class="fas fa-user-plus"></i> Tambah Mahasiswa
                                                        </button>
                                                    </p>
                                                </td>
                                            </tr>
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
                                                                @php $selected = old('bidang', $data->bidang ?? []); @endphp
                                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Bidang :</label>
                                                                <select class="form-select form-select-sm bidang-select @error('bidang_'.$data->id) is-invalid @enderror" name="bidang_{{$data->id}}[]" multiple>
                                                                    <option value="Internet Of Things" {{ in_array('Internet Of Things', $selected) ? 'selected' : '' }}>Internet Of Things</option>
                                                                    <option value="Artificial Intelligence" {{ in_array('Artificial Intelligence', $selected) ? 'selected' : '' }}>Artificial Intelligence</option>
                                                                    <option value="Web Developer" {{ in_array('Web Developer', $selected) ? 'selected' : '' }}>Web Developer</option>
                                                                    <option value="Data Managemen" {{ in_array('Data Managemen', $selected) ? 'selected' : '' }}>Data Managemen</option>
                                                                    <option value="Data Analis" {{ in_array('Data Analis', $selected) ? 'selected' : '' }}>Data Analis</option>
                                                                    <option value="Software Developer" {{ in_array('Software Developer', $selected) ? 'selected' : '' }}>Software Developer</option>
                                                                </select>
                                                                @error('bidang_'.$data->id)
                                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                    <br>
                                                                @enderror
                                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Kuota :</label>
                                                                <input class="form-control form-control-sm @error('kuota_'.$data->id) is-invalid @enderror" type="number" name="kuota_{{$data->id}}" value="{{ old('kuota', $data->kuota) }}" placeholder="Kuota">
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
                                            <!-- Modal Lihat Topik -->
                                            <div class="modal fade" role="dialog" tabindex="-1" id="ModalLihatDaftarTopik{{$data->id}}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" style="font-weight: bold;">Lihat Topik {{ $data->judul }}</h5>
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
                                                                    @if($data->status == 'Proposal')
                                                                        <span class="badge rounded-pill bg-primary">Proposal</span>
                                                                        <form action="{{ route('daftar_topik.ubah_status', $data->id) }}" method="POST" class="mt-2">
                                                                            @csrf
                                                                            <select name="status" class="form-select form-select-sm d-inline w-auto" style="display:inline-block;">
                                                                                <option value="Available">Available</option>
                                                                                <option value="Booked">Booked</option>
                                                                                <option value="Full">Full</option>
                                                                                <option value="Proposal">Proposal</option>
                                                                                <option value="TA">TA</option>
                                                                            </select>
                                                                            <button type="submit" class="btn btn-primary btn-sm ms-1">Ubah Status</button>
                                                                        </form>
                                                                    @elseif($data->status == 'TA')
                                                                        <span class="badge rounded-pill bg-info text-dark">TA</span>
                                                                    @else
                                                                        <span class="badge rounded-pill {{ $data->status == 'Available' ? 'bg-success' : ($data->status == 'Full' ? 'bg-danger' : ($data->status == 'Booked' ? 'bg-warning text-dark' : 'bg-warning text-dark')) }}">{{ $data->status == 'Tersedia' ? 'Available' : ($data->status == 'Penuh' ? 'Full' : $data->status) }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4"><span style="font-weight: bold;">Kelompok</span></div>
                                                                <div class="col-8">
                                                                    <p><span class="fw-bold">:&nbsp;</span>
                                                                        @if(isset($data->anggota_kelompok) && count($data->anggota_kelompok) > 0)
                                                                            @foreach($data->anggota_kelompok as $anggota)
                                                                                <span class="badge rounded-pill bg-dark m-1">{{ $anggota->nama_anggota }} ({{ $anggota->nim }})</span>
                                                                            @endforeach
                                                                        @else
                                                                            -
                                                                        @endif
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
                    <!-- CARD: Topik dari Dosen Lain -->
                    <div class="container-fluid mt-5">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h5 class="text-dark m-0 fw-bold">Topik dari Dosen Lain</h5>
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
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($semuaTopik as $data)
                                                @if($data->kode_dosen != Auth::guard('dosen')->user()->kode_dosen)
                                                <tr>
                                                    <td class="text-center">{{ $no++ }}</td>
                                                    <td class="text-center">{{$data->judul}}</td>
                                                    <td class="text-center">{{$data->kode_dosen}}</td>
                                                    <td class="text-center">{{$data->kuota." Orang"}}</td>
                                                    <td class="text-center">
                                                        @php $bidangList = $data->bidang; @endphp
                                                        @if ($bidangList)
                                                            @foreach ($bidangList as $bidang)
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
                                                            <span class="badge rounded-pill bg-info text-dark">TA</span>
                                                        @elseif($jumlah_anggota >= $data->kuota)
                                                            <span class="badge rounded-pill bg-danger">Full</span>
                                                        @elseif($data->status == 'Tersedia')
                                                            <span class="badge rounded-pill bg-success">Available</span>
                                                        @else
                                                            <span class="badge rounded-pill bg-warning text-dark">{{ $data->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                                            <button class="btn btn-info btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#ModalLihatDaftarTopikLain{{ $data->id }}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </div>
                                                        <!-- Modal Lihat Daftar Topik Dinamis -->
                                                        <div class="modal fade" role="dialog" tabindex="-1" id="ModalLihatDaftarTopikLain{{ $data->id }}">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" style="font-weight: bold;">Lihat Daftar Topik dari Dosen Lain {{ $data->judul }}</h5>
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
                                                                                <p><span class="fw-bold">:&nbsp;</span>
                                                                                    @if($data->status == 'Tersedia')
                                                                                        <span class="badge rounded-pill bg-success">Available</span>
                                                                                    @elseif($data->status == 'Booked')
                                                                                        <span class="badge rounded-pill bg-warning text-dark">Booked</span>
                                                                                    @elseif($data->status == 'Penuh')
                                                                                        <span class="badge rounded-pill bg-danger">Full</span>
                                                                                    @else
                                                                                        <span class="badge rounded-pill bg-primary">{{ $data->status }}</span>
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-4"><span style="font-weight: bold;">Kelompok</span></div>
                                                                            <div class="col-8">
                                                                                <p><span class="fw-bold">:&nbsp;</span>
                                                                                    @if(isset($data->anggota_kelompok) && count($data->anggota_kelompok) > 0)
                                                                                        @foreach($data->anggota_kelompok as $anggota)
                                                                                            <span class="badge rounded-pill bg-dark m-1">{{ $anggota->nama_anggota }} ({{ $anggota->nim }})</span>
                                                                                        @endforeach
                                                                                    @else
                                                                                        -
                                                                                    @endif
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
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
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
                    search: "Cari:",
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

        function updateProgramStudiP() {
            const fakultasP = document.getElementById('fakultasP').value;
            const programStudiSelectP = document.getElementById('program_studiP');
    
            // Kosongkan pilihan sebelumnya
            programStudiSelectP.innerHTML = '<option selected>-- Pilih Program Studi --</option>';
    
            if (dataP[fakultasP]) {
                dataP[fakultasP].forEach(function(prodi) {
                    const option = document.createElement('option');
                    option.value = prodi;
                    option.text = prodi;
                    programStudiSelectP.add(option);
                });
            }
        }

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
    </script>
    <!-- Modal Tambah Topik -->
    <div class="modal fade" role="dialog" tabindex="-1" id="ModalTambahDaftarTopik">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('daftar_topik.tambah') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" style="color: var(--bs-emphasis-color);font-weight: bold;">Tambah Topik</h5>
                        <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label text-dark" style="font-weight: bold;">Judul :</label>
                        <input class="form-control form-control-sm @error('judul') is-invalid @enderror" type="text" name="judul" placeholder="Judul Topik">
                        @error('judul')
                            <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                            <br>
                        @enderror
                        <label class="form-label text-dark mt-3" style="font-weight: bold;">Program Studi :</label>
                        <select class="form-select form-select-sm @error('program_studi') is-invalid @enderror" name="program_studi" id="program_studiP">
                            <option selected disabled>-- Pilih Program Studi --</option>
                        </select>
                        @error('program_studi')
                            <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                            <br>
                        @enderror
                        <label class="form-label text-dark mt-3" style="font-weight: bold;">Fakultas :</label>
                        <select class="form-select form-select-sm @error('fakultas') is-invalid @enderror" name="fakultas" id="fakultasP" onchange="updateProgramStudiP()">
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
                        <label class="form-label text-dark mt-3" style="font-weight: bold;">Bidang :</label>
                        <select class="form-select form-select-sm @error('bidang') is-invalid @enderror" name="bidang[]" id="bidang" multiple>
                            <option value="Internet Of Things">Internet Of Things</option>
                            <option value="Artificial Intelligence">Artificial Intelligence</option>
                            <option value="Web Developer">Web Developer</option>
                            <option value="Data Managemen">Data Managemen</option>
                            <option value="Data Analis">Data Analis</option>
                            <option value="Software Developer">Software Developer</option>
                        </select>
                        @error('bidang')
                            <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                            <br>
                        @enderror
                        <label class="form-label text-dark mt-3" style="font-weight: bold;">Kuota :</label>
                        <input class="form-control form-control-sm @error('kuota') is-invalid @enderror" type="number" name="kuota" placeholder="Kuota">
                        @error('kuota')
                            <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                            <br>
                        @enderror
                        <label class="form-label text-dark mt-3" style="font-weight: bold;">Deskripsi :</label>
                        <textarea class="form-control form-control-sm @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="5" placeholder="Deskripsi Tentang Topik..."></textarea>
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
</body>
</html>