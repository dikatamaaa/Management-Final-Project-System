<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Brand</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/css/style.css') }}">
</head>

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
                    <li class="nav-item"><a class="nav-link" href="/dosen/dokumen_cd"><i class="fas fa-file-word"></i><span>Dokumen Capstone Design</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="/dosen/progres_ta"><i class="fas fa-chart-line"></i><span>Progres Tugas Akhir</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="/dosen/penilaian_mahasiswa"><i class="fas fa-pencil-alt"></i><span>Penilaian Mahasiswa</span></a></li>
                    <li class="nav-item">
                        <hr><a class="nav-link active" href="/dosen/profil"><i class="fas fa-user"></i><span>Profil</span></a>
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
                    <h3 class="text-dark mb-4">Profil</h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow">
                                    <img class="rounded-circle mb-3 mt-4" src="{{ asset('/storage/assets/img/avatars/'.(Auth::guard('dosen')->user()->foto ?? 'default.jpg')) }}" width="160" height="160">
                                    <div class="mb-3">
                                        <form action="{{ route('dosen.editFoto', Auth::guard('dosen')->user()->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input class="form-control-sm form-control @error('foto') is-invalid @enderror" type="file" name="foto" accept="image/*">
                                        {{-- Pesan Error Untuk Foto --}}
                                        @error('foto')
                                            <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                            <br>
                                        @enderror
                                        <button class="btn btn-sm link-light mt-2" type="submit" style="background: #881d1d;">
                                            <i class="fa fa-upload"></i>&nbsp;Unggah
                                        </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-dark m-0 fw-bold">Biodata</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('dosen.editBiodata', Auth::guard('dosen')->user()->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nip"><strong>NIP</strong></label>
                                                            <input class="form-control form-control-sm @error('nip') is-invalid @enderror" type="number" id="nip" value="{{ old('nip', Auth::guard('dosen')->user()->nip) }}" placeholder="Nomor Induk Pegawai" name="nip">
                                                            {{-- Pesan Error Untuk NIP --}}
                                                            @error('nip')
                                                                <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="kode_dosen"><strong>Kode Dosen</strong></label>
                                                            <input class="form-control form-control-sm @error('kode_dosen') is-invalid @enderror" type="text" id="kode_dosen" name="kode_dosen" value="{{ old('kode_dosen', Auth::guard('dosen')->user()->kode_dosen) }}" placeholder="Kode Dosen">
                                                            {{-- Pesan Error Untuk Kode Dosen --}}
                                                            @error('kode_dosen')
                                                                <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nama"><strong>Nama</strong></label>
                                                            <input class="form-control form-control-sm @error('nama') is-invalid @enderror" type="text" name="nama" id="nama" value="{{ old('nama', Auth::guard('dosen')->user()->nama) }}" placeholder="Nama">
                                                            {{-- Pesan Error Untuk Nama --}}
                                                            @error('nama')
                                                                <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email"><strong>Email</strong></label>
                                                            <input class="form-control form-control-sm @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email', Auth::guard('dosen')->user()->email) }}" placeholder="Email">
                                                            {{-- Pesan Error Untuk Email --}}
                                                            @error('email')
                                                                <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="no_hp"><strong>No Handphone</strong></label>
                                                            <input class="form-control form-control-sm @error('no_hp') is-invalid @enderror" type="text" id="no_hp" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="no_hp" value="{{ old('no_hp', Auth::guard('dosen')->user()->no_hp) }}" placeholder="Ex: 081XXXXXX">
                                                            {{-- Pesan Error Untuk No Handphone --}}
                                                            @error('no_hp')
                                                                <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-sm link-light" type="submit" id="EditBiodata" style="background: #881d1d;" disabled>
                                                        <i class="fa fa-save"></i>&nbsp;Perbarui
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-dark m-0 fw-bold">Ganti Kata Sandi</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('dosen.gantiKataSandi', Auth::guard('dosen')->user()->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="username"><strong>Nama Pengguna</strong></label><input class="form-control form-control-sm" type="text" placeholder="Nama Pengguna" value="{{ Auth::guard('dosen')->user()->nama_pengguna }}" disabled></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">
                                                                <strong>Kata Sandi Lama</strong>
                                                            </label>
                                                            <input class="form-control form-control-sm @error('kata_sandi_lama') is-invalid @enderror" type="password" name="kata_sandi_lama" placeholder="Kata Sandi Lama">
                                                            {{-- Pesan Error Untuk Kata Sandi Lama --}}
                                                            @error('kata_sandi_lama')
                                                                <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="first_name">
                                                                <strong>Kata Sandi Baru</strong>
                                                            </label>
                                                            <input class="form-control form-control-sm @error('kata_sandi_baru') is-invalid @enderror" type="password" name="kata_sandi_baru" placeholder="Kata Sandi Baru">
                                                            {{-- Pesan Error Untuk Kata Sandi Baru --}}
                                                            @error('kata_sandi_baru')
                                                                <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="first_name">
                                                                <strong>Konfirmasi Kata Sandi</strong>
                                                            </label>
                                                            <input class="form-control form-control-sm @error('konfirmasi_kata_sandi') is-invalid @enderror" type="password" name="konfirmasi_kata_sandi" placeholder="Konfirmasi Kata Sandi">
                                                            {{-- Pesan Error Untuk Konfirmasi Kata Sandi --}}
                                                            @error('konfirmasi_kata_sandi')
                                                                <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3"><button class="btn btn-sm link-light" type="submit" style="background: #881d1d;"><i class="fa fa-save"></i>&nbsp;Perbarui</button></div>
                                            </form>
                                        </div>
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

        // Button Edit Biodata
        const inputs = [nip, kode_dosen, nama, email, no_hp];
        const initial = inputs.map(input => input.value);

        inputs.forEach((input, i) => {
            input.addEventListener('input', () => {
            EditBiodata.disabled = !inputs.some((el, j) => el.value !== initial[j]);
            });
        });
    </script>
</body>
</html>