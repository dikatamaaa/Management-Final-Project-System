<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>InfoTA - Mahasiswa</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark" style="background: #881d1d;">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon">
                        <img class="img-fluid" src="{{ asset('/storage/assets/img/Logo/Logo%20White%20(1000%20x%201000%20piksel).png') }}" width="100px">
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

                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link active" aria-expanded="false" data-bs-toggle="dropdown" href="#">
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
                        <a class="nav-link" href="logout">
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
                        <h3 class="text-dark mb-0">Mahasiswa</h3>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <p class="text-dark m-0 fw-bold">Data Mahasiswa</p>
                            <button class="btn btn-sm link-light" type="button" style="background: #881d1d;" data-bs-toggle="modal" data-bs-target="#ModalTambahMahasiswa">
                                <i class="fas fa-plus"></i>&nbsp;Tambah Mahasiswa
                            </button>
                            <div class="modal fade" role="dialog" tabindex="-1" id="ModalTambahMahasiswa">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('mahasiswa.tambah') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark" style="color: var(--bs-emphasis-color);font-weight: bold;">Tambah Mahasiswa</h5>
                                                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">NIM :</label>
                                                <input class="form-control form-control-sm @error('nim') is-invalid @enderror" type="number" name="nim" placeholder="Nomor Induk Mahasiswa">
                                                {{-- Pesan Error Untuk NIM --}}
                                                @error('nim')
                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                    <br>
                                                @enderror

                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Nama :</label>
                                                <input class="form-control form-control-sm @error('nama') is-invalid @enderror" type="text" name="nama" placeholder="Nama">
                                                {{-- Pesan Error Untuk Nama --}}
                                                @error('nama')
                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                    <br>
                                                @enderror

                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Kelas :</label>
                                                <input class="form-control form-control-sm @error('kelas') is-invalid @enderror" type="text" name="kelas" placeholder="Kelas">
                                                {{-- Pesan Error Untuk Kelas --}}
                                                @error('kelas')
                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                    <br>
                                                @enderror

                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Program Studi :</label>
                                                <select class="form-select form-select-sm @error('program_studi') is-invalid @enderror" name="program_studi" id="program_studiP">
                                                    <option selected disabled>-- Pilih Program Studi --</option>
                                                </select>
                                                {{-- Pesan Error Untuk Program Studi --}}
                                                @error('program_studi')
                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                    <br>
                                                @enderror

                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Fakultas :</label>
                                                <select class="form-select form-select-sm @error('fakultas') is-invalid @enderror" name="fakultas" id="fakultasP" onchange="updateProgramStudiP()">
                                                    <option selected>-- Pilih Fakultas --</option>
                                                    <option value="Fakultas Teknik Elektro (FTE)">Fakultas Teknik Elektro (FTE)</option>
                                                    <option value="Fakultas Rekayasa Industri (FRI)">Fakultas Rekayasa Industri (FRI)</option>
                                                    <option value="Fakultas Informatika (FIF)">Fakultas Informatika (FIF)</option>
                                                    <option value="Fakultas Ekonomi dan Bisnis (FEB)">Fakultas Ekonomi dan Bisnis (FEB)</option>
                                                    <option value="Fakultas Komunikasi dan Ilmu Sosial (FKI)">Fakultas Komunikasi dan Ilmu Sosial (FKI)</option>
                                                    <option value="Fakultas Industri Kreatif (FIK)">Fakultas Industri Kreatif (FIK)</option>
                                                    <option value="Fakultas Ilmu Terapan (FIT)">Fakultas Ilmu Terapan (FIT)</option>
                                                </select>
                                                {{-- Pesan Error Untuk Fakultas --}}
                                                @error('fakultas')
                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                    <br>
                                                @enderror

                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Angkatan :</label>
                                                <select class="form-select form-select-sm @error('angkatan') is-invalid @enderror" name="angkatan">
                                                    <option selected>-- Pilih Angkatan --</option>
                                                    @for ($year = 2015; $year <= date('Y'); $year++)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endfor
                                                </select>
                                                {{-- Pesan Error Untuk Angkatan --}}
                                                @error('angkatan')
                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                    <br>
                                                @enderror

                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Email :</label>
                                                <input class="form-control form-control-sm @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email">
                                                {{-- Pesan Error Untuk Email --}}
                                                @error('email')
                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                    <br>
                                                @enderror

                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">No HP :</label>
                                                <input class="form-control form-control-sm @error('no_hp') is-invalid @enderror" type="text" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="no_hp" placeholder="Ex: 081XXXXXX">
                                                {{-- Pesan Error Untuk No Handphone --}}
                                                @error('no_hp')
                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                    <br>
                                                @enderror

                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Nama Pengguna :</label>
                                                <input class="form-control form-control-sm @error('nama_pengguna') is-invalid @enderror" type="text" name="nama_pengguna" placeholder="Nama Pengguna">
                                                {{-- Pesan Error Untuk Nama Pengguna --}}
                                                @error('nama_pengguna')
                                                    <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                    <br>
                                                @enderror

                                                <label class="form-label text-dark mt-3" style="font-weight: bold;">Kata Sandi :</label>
                                                <input class="form-control form-control-sm @error('kata_sandi') is-invalid @enderror" type="password" name="kata_sandi" placeholder="Kata Sandi">
                                                {{-- Pesan Error Untuk Kata Sandi --}}
                                                @error('kata_sandi')
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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-striped table-hover" id="tableData">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Foto</th>
                                            <th class="text-center">NIM</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Program Studi</th>
                                            <th class="text-center">Fakultas</th>
                                            <th class="text-center">Angkatan</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">No Handphone</th>
                                            <th class="text-center">Nama Pengguna</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menampilkanDataMahasiswa as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img class="rounded-circle img-fluid" src="{{ asset('/storage/assets/img/avatars/'.($data->foto ?? 'default.jpg'))}}" width="60px">
                                            </td>
                                            <td class="text-center">{{ $data->nim }}</td>
                                            <td class="text-center">{{ $data->nama }}</td>
                                            <td class="text-center">{{ $data->kelas }}</td>
                                            <td class="text-center">{{ $data->program_studi }}</td>
                                            <td class="text-center">{{ $data->fakultas }}</td>
                                            <td class="text-center">{{ $data->angkatan }}</td>
                                            <td class="text-center">{{ $data->email }}</td>
                                            <td class="text-center">{{ $data->no_hp }}</td>
                                            <td class="text-center">{{ $data->nama_pengguna }}</td>
                                            <td>
                                                <p class="text-center">
                                                <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#ModalEditDosenPembimbing{{$data->id}}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm ms-1 me-1" type="button" data-bs-toggle="modal" data-bs-target="#ModalHapusDosenPembimbing{{$data->id}}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <button class="btn btn-info btn-sm me-1" type="button" data-bs-toggle="modal" data-bs-target="#ModalLihatDosenPembimbing{{$data->id}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#ModalGantiKataSandi{{$data->id}}">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                                </p>

                                                <div class="modal fade" role="dialog" tabindex="-1" id="ModalEditDosenPembimbing{{$data->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ route('mahasiswa.edit', $data->id)}}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" style="font-weight: bold;">Edit Mahasiswa</h5>
                                                                    <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label class="form-label text-dark mt-3" style="font-weight: bold;">NIM :</label>
                                                                    <input class="form-control form-control-sm @error('nim_'.$data->id) is-invalid @enderror" type="number" name="nim_{{$data->id}}" value="{{ old('nim', $data->nim) }}" placeholder="Nomor Induk Mahasiswa">
                                                                    {{-- Pesan Error Untuk NIM --}}
                                                                    @error('nim_'.$data->id)
                                                                        <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                        <br>
                                                                    @enderror

                                                                    <label class="form-label text-dark mt-3" style="font-weight: bold;">Nama :</label>
                                                                    <input class="form-control form-control-sm @error('nama_'.$data->id) is-invalid @enderror" type="text" name="nama_{{$data->id}}" value="{{ old('nama', $data->nama) }}" placeholder="Nama">
                                                                    {{-- Pesan Error Untuk Nama --}}
                                                                    @error('nama_'.$data->id)
                                                                        <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                        <br>
                                                                    @enderror

                                                                    <label class="form-label text-dark mt-3" style="font-weight: bold;">Kelas :</label>
                                                                    <input class="form-control form-control-sm @error('kelas_'.$data->id) is-invalid @enderror" type="text" name="kelas_{{$data->id}}" value="{{ old('kelas', $data->kelas) }}" placeholder="Kelas">
                                                                    {{-- Pesan Error Untuk Kelas --}}
                                                                    @error('kelas_'.$data->id)
                                                                        <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                        <br>
                                                                    @enderror

                                                                    <label class="form-label text-dark mt-3" style="font-weight: bold;">Program Studi :</label>
                                                                    <select class="form-select form-select-sm @error('program_studi_'.$data->id) is-invalid @enderror" name="program_studi_{{$data->id}}" id="program_studi{{ $data->id }}" data-default="{{ old('program_studi_' . $data->id, $data->program_studi) }}">
                                                                        <option value="">-- Pilih Program Studi --</option>
                                                                    </select>
                                                                    {{-- Pesan Error Untuk Program Studi --}}
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
                                                                    {{-- Pesan Error Untuk Fakultas --}}
                                                                    @error('fakultas_'.$data->id)
                                                                        <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                        <br>
                                                                    @enderror

                                                                    <label class="form-label text-dark mt-3" style="font-weight: bold;">Angkatan :</label>
                                                                    <select class="form-select form-select-sm @error('angkatan_'.$data->id) is-invalid @enderror" name="angkatan_{{$data->id}}">
                                                                        <option selected>-- Pilih Angkatan --</option>
                                                                        @for ($year = 2015; $year <= date('Y'); $year++)
                                                                            <option value="{{ $year }}" {{ old('angkatan', $data->angkatan) == $year ? 'selected' : '' }}>{{ $year }}</option>
                                                                        @endfor
                                                                    </select>
                                                                    {{-- Pesan Error Untuk Angkatan --}}
                                                                    @error('angkatan_'.$data->id)
                                                                        <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                        <br>
                                                                    @enderror

                                                                    <label class="form-label text-dark mt-3" style="font-weight: bold;">Email :</label>
                                                                    <input class="form-control form-control-sm @error('email_'.$data->id) is-invalid @enderror" type="email" name="email_{{$data->id}}" value="{{ old('email', $data->email) }}" placeholder="Email">
                                                                    {{-- Pesan Error Untuk Email --}}
                                                                    @error('email_'.$data->id)
                                                                        <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                        <br>
                                                                    @enderror

                                                                    <label class="form-label text-dark mt-3" style="font-weight: bold;">No HP :</label>
                                                                    <input class="form-control form-control-sm @error('no_hp_'.$data->id) is-invalid @enderror" type="text" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="no_hp_{{$data->id}}" value="{{ old('no_hp', $data->no_hp) }}" placeholder="Ex: 081XXXXXX">
                                                                    {{-- Pesan Error Untuk No Handphone --}}
                                                                    @error('no_hp_'.$data->id)
                                                                        <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                        <br>
                                                                    @enderror

                                                                    <label class="form-label text-dark mt-3" style="font-weight: bold;">Nama Pengguna :</label>
                                                                    <input class="form-control form-control-sm @error('nama_pengguna_'.$data->id) is-invalid @enderror" type="text" name="nama_pengguna_{{$data->id}}" value="{{ old('nama_pengguna', $data->nama_pengguna) }}" placeholder="Nama Pengguna">
                                                                    {{-- Pesan Error Untuk Nama Pengguna --}}
                                                                    @error('nama_pengguna_'.$data->id)
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
                                                <div class="modal fade" role="dialog" tabindex="-1" id="ModalHapusDosenPembimbing{{$data->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="font-weight: bold;">Hapus Mahasiswa</h5>
                                                                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <h1 class="display-3">
                                                                    <i class="fas fa-exclamation-triangle"></i>
                                                                </h1>
                                                                <h6>Apakah anda yakin ingin menghapusnya?</h6>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal">
                                                                    <i class="fa fa-close"></i>&nbsp;Tidak
                                                                </button>
                                                                <a href="{{ route('mahasiswa.hapus', $data->id) }}" class="btn btn-danger btn-sm" type="button">
                                                                    <i class="far fa-trash-alt"></i>&nbsp;Ya, Hapus
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" role="dialog" tabindex="-1" id="ModalLihatDosenPembimbing{{$data->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="font-weight: bold;">Lihat Mahasiswa</h5>
                                                                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h1 class="display-3 text-center">
                                                                    <img class="rounded-circle img-fluid" src="{{ asset('/storage/assets/img/avatars/'.($data->foto ?? 'default.jpg'))}}" width="120px">
                                                                </h1>
                                                                <h5 class="mt-4" style="font-weight: bold;">Biodata</h5>
                                                                <div class="row">
                                                                    <div class="col-4"><span style="font-weight: bold;">NIM :</span>
                                                                        <p>{{ $data->nim }}</p>
                                                                    </div>
                                                                    <div class="col-4"><span style="font-weight: bold;">Nama :</span>
                                                                        <p>{{ $data->nama }}</p>
                                                                    </div>
                                                                    <div class="col-4"><span style="font-weight: bold;">Kelas :</span>
                                                                        <p>{{ $data->kelas }}</p>
                                                                    </div>
                                                                    <div class="col-4"><span style="font-weight: bold;">Program Studi :</span>
                                                                        <p>{{ $data->program_studi }}</p>
                                                                    </div>
                                                                    <div class="col-4"><span style="font-weight: bold;">Fakultas :</span>
                                                                        <p>{{ $data->fakultas }}</p>
                                                                    </div>
                                                                    <div class="col-4"><span style="font-weight: bold;">Angkatan :</span>
                                                                        <p>{{ $data->angkatan }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-8"><span style="font-weight: bold;">Email :</span>
                                                                        <p class="text-truncate">{{ $data->email }}</p>
                                                                    </div>
                                                                    <div class="col-4"><span style="font-weight: bold;">No HP :</span>
                                                                        <p class="text-truncate">{{ $data->no_hp }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-center">
                                                                    <div class="col-lg-11">
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                                <h5 class="mt-4" style="font-weight: bold;">Akun</h5>
                                                                <div class="row">
                                                                    <div class="col-6"><span style="font-weight: bold;">Nama Pengguna :</span>
                                                                        <p>{{ $data->nama_pengguna }}</p>
                                                                    </div>
                                                                    <div class="col-6"><span style="font-weight: bold;">Kata Sandi :</span>
                                                                        <p>{{ str_repeat('*', 8) }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal">
                                                                    <i class="fa fa-close"></i>&nbsp;Tutup
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" role="dialog" tabindex="-1" id="ModalGantiKataSandi{{$data->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <form method="post" action="{{ route('mahasiswa.GantiKataSandi', $data->id) }}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" style="font-weight: bold;">Ganti Kata Sandi</h5>
                                                                    <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                        <label class="form-label text-dark" style="font-weight: bold;">Kata Sandi Baru :</label>
                                                                        <input class="form-control form-control-sm @error('kata_sandi_baru_'.$data->id) is-invalid @enderror" type="password" name="kata_sandi_baru_{{$data->id}}" placeholder="Kata Sandi Baru">
                                                                        {{-- Pesan Error Untuk NIP --}}
                                                                        @error('kata_sandi_baru_'.$data->id)
                                                                            <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                            <br>
                                                                        @enderror

                                                                        <label class="form-label text-dark mt-3" style="font-weight: bold;">Konfirmasi Kata Sandi :</label>
                                                                        <input class="form-control form-control-sm @error('konfirmasi_kata_sandi_'.$data->id) is-invalid @enderror" type="password" name="konfirmasi_kata_sandi_{{$data->id}}" placeholder="Konfirmasi Kata Sandi">
                                                                        {{-- Pesan Error Untuk Kode Dosen --}}
                                                                        @error('konfirmasi_kata_sandi_'.$data->id)
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
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-center"><strong>No</strong></td>
                                            <td class="text-center"><strong>Foto</strong></td>
                                            <td class="text-center"><strong>NIM</strong></td>
                                            <td class="text-center"><strong>Nama</strong></td>
                                            <td class="text-center"><strong>Kelas</strong></td>
                                            <td class="text-center"><strong>Program Studi</strong></td>
                                            <td class="text-center"><strong>Fakultas</strong></td>
                                            <td class="text-center"><strong>Angkatan</strong></td>
                                            <td class="text-center"><strong>Email</strong></td>
                                            <td class="text-center"><strong>No Handphone</strong></td>
                                            <td class="text-center"><strong>Nama Pengguna</strong></td>
                                            <td class="text-center"><strong>Aksi</strong></td>
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
                    targets: 11,
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
      const idList = @json($menampilkanDataMahasiswa->pluck('id'));
      
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
    </script>
</body>
</html>