<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Bimbingan Mahasiswa - infoTA</title>
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
                <div class="container-fluid">
                    <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                    <ul class="navbar-nav flex-nowrap ms-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                    <span class="badge bg-danger badge-counter">{{ Auth::guard('dosen')->user()->unreadNotifications ? Auth::guard('dosen')->user()->unreadNotifications->count() : 0 }}</span>
                                    <i class="fas fa-bell fa-fw"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                    <h6 class="dropdown-header">Alerts Center</h6>
                                    @php $notifs = Auth::guard('dosen')->user()->notifications ?? []; @endphp
                                    @forelse ($notifs as $notif)
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-warning icon-circle">
                                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="small text-gray-500">{{ $notif->created_at->format('d M Y H:i') }}</span>
                                                <p>{{ $notif->data['pesan'] ?? '' }}</p>
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
                <h3 class="mb-4">Daftar Pengajuan Bimbingan</h3>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Judul</th>
                                    <th>Pembimbing</th>
                                    <th>Jadwal</th>
                                    <th>Status</th>
                                    <th>Catatan</th>
                                    <th>Kritik & Saran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($bimbinganList as $i => $b)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $mahasiswaNama[$b->nim] ?? $b->nim }}</td>
                                    <td>{{ $b->judul }}</td>
                                    <td>{{ $b->pembimbing == '1' ? 'Pembimbing 1' : 'Pembimbing 2' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($b->jadwal)->format('d-m-Y H:i') }}</td>
                                    <td>
                                        @if($b->status=='pending')<span class="badge bg-warning text-dark">Pending</span>@endif
                                        @if($b->status=='accepted')<span class="badge bg-success">Accepted</span>@endif
                                        @if($b->status=='rejected')<span class="badge bg-danger">Rejected</span>@endif
                                        @if($b->status=='selesai')<span class="badge bg-info text-dark">Selesai</span>@endif
                                    </td>
                                    <td>{{ $b->catatan }}</td>
                                    <td>
                                        @if($b->status=='accepted' || $b->status=='selesai')
                                            <form action="{{ route('dosen.bimbingan.kritik_saran', $b->id) }}" method="POST" class="d-flex">
                                                @csrf
                                                <input type="text" name="kritik_saran" class="form-control form-control-sm me-1" value="{{ $b->kritik_saran }}" placeholder="Kritik & Saran" required>
                                                <button class="btn btn-info btn-sm" type="submit">Kirim</button>
                                            </form>
                                        @elseif($b->status=='rejected')
                                            <span class="text-danger">{{ $b->alasan_tolak }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($b->status=='pending')
                                            <form action="{{ route('dosen.bimbingan.acc', $b->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button class="btn btn-success btn-sm" type="submit">ACC</button>
                                            </form>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalTolak{{ $b->id }}">Reject</button>
                                            <!-- Modal Tolak -->
                                            <div class="modal fade" id="modalTolak{{ $b->id }}" tabindex="-1" aria-labelledby="modalTolakLabel{{ $b->id }}" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <form action="{{ route('dosen.bimbingan.reject', $b->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="modalTolakLabel{{ $b->id }}">Alasan Penolakan</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <textarea name="alasan_tolak" class="form-control" required></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                      <button type="submit" class="btn btn-danger">Tolak</button>
                                                    </div>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="9" class="text-center">Tidak ada pengajuan bimbingan</td></tr>
                            @endforelse
                            </tbody>
                        </table>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
</body>
</html> 