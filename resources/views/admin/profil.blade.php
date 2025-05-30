<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>InfoTA - Profil</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome5-overrides.min.css') }}">
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
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/pengaturan_topik">
                            <i class="fas fa-cogs"></i>
                            <span>Pengaturan Topik</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/jadwal_sidang">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Jadwal Sidang</span>
                        </a>
                    </li>
                    

                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                            <i class="fas fa-users"></i>Kelola Pengguna
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
                        <a class="nav-link active" href="/admin/profil">
                            <i class="fas fa-user"></i>
                            <span>Profil</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/logout">
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
                                        <img class="border rounded-circle img-profile" src="{{ asset('/storage/assets/img/avatars/'.(Auth::guard('admin')->user()->image ?? 'default.jpg')) }}"></a>
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
                    <h3 class="text-dark mb-4">Profil</h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow">
                                    <img class="rounded-circle mb-3 mt-4" src="{{ asset('/storage/assets/img/avatars/'.(Auth::guard('admin')->user()->image ?? 'default.jpg')) }}" width="160" height="160">
                                    <div class="mb-3">
                                        <form action="{{ route('admin.editFoto', Auth::guard('admin')->user()->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                        <input class="form-control-sm form-control @error('image') is-invalid @enderror" type="file" name="image" accept="image/*" required="">
                                        {{-- Pesan Error Untuk Image --}}
                                        @error('image')
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
                                            <p class="text-dark m-0 fw-bold">Ganti Kata Sandi</p>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('admin.gantiKataSandi', Auth::guard('admin')->user()->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="username">
                                                                <strong>Nama Pengguna</strong>
                                                            </label>
                                                            <input class="form-control" type="text" placeholder="Nama Pengguna" value="{{ Auth::guard('admin')->user()->nama_pengguna }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">
                                                                <strong>Kata Sandi Lama</strong>
                                                            </label>
                                                            <input class="form-control @error('kata_sandi_lama') is-invalid @enderror" type="password" name="kata_sandi_lama" placeholder="Kata Sandi Lama">
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
                                                            <input class="form-control @error('kata_sandi_baru') is-invalid @enderror" type="password" name="kata_sandi_baru" placeholder="Kata Sandi Baru">
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
                                                            <input class="form-control @error('konfirmasi_kata_sandi') is-invalid @enderror" type="password" name="konfirmasi_kata_sandi" placeholder="Konfirmasi Kata Sandi">
                                                            {{-- Pesan Error Untuk Konfirmasi Kata Sandi --}}
                                                            @error('konfirmasi_kata_sandi')
                                                                <small class="fw-bold" style="color: #881d1d;">{{ $message }}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-sm link-light" type="submit" style="background: #881d1d;">
                                                        <i class="fa fa-save"></i>&nbsp;Perbarui
                                                    </button>
                                                </div>
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
        </script>
</body>
</html>