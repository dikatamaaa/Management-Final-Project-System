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
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark" style="background: #881d1d;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon"><img class="img-fluid" src="{{ asset('/storage/assets/img/Logo/Logo%20White%20(1000%20x%201000%20piksel).png') }}" width="100px"></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="/mahasiswa/beranda"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="/mahasiswa/daftar_topik"><i class="far fa-file-alt"></i><span>Daftar Topik</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="/mahasiswa/template_laporan"><i class="fas fa-file-word"></i><span>Template Laporan</span></a></li>                    
                    <li class="nav-item"><a class="nav-link" href="/mahasiswa/pembimbing-dua"><i class="fas fa-users"></i><span>Pembimbing 2</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="/mahasiswa/dokumen-bimbingan"><i class="fas fa-comments"></i><span>Pengajuan Bimbingan</span></a></li>
                    <li class="nav-item">
                        <hr><a class="nav-link disabled" href="/mahasiswa/profil"><i class="fas fa-user"></i><span>Profil</span></a>
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
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::guard('mahasiswa')->user()->nama_pengguna }}</span><span class="badge rounded-pill me-2" style="background: #881d1d;">Mahasiswa</span><img class="border rounded-circle img-profile" src="{{ asset('/storage/assets/img/avatars/'.(Auth::guard('mahasiswa')->user()->foto ?? 'default.jpg')) }}"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item disabled" href="/mahasiswa/profil"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profil</a>
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
                                            <div class="row">
                                                <div class="col"><span class="text-dark fw-bold">Judul</span></div>
                                                <div class="col">
                                                    <p class="text-dark"><span class="text-dark fw-bold">:</span>&nbsp;Budidaya Ikan Air Tawar</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><span class="text-dark fw-bold">Kode Dosen</span></div>
                                                <div class="col">
                                                    <p class="text-dark"><span class="text-dark fw-bold">:</span>&nbsp;STY</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><span class="text-dark fw-bold">Kelompok</span></div>
                                                <div class="col">
                                                    <p class="text-dark"><span class="text-dark fw-bold">:</span>&nbsp;<span class="badge rounded-pill bg-dark m-1">Irfan</span><span class="badge rounded-pill bg-dark m-1">Geral</span><span class="badge rounded-pill bg-dark m-1">Dika</span></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><span class="text-dark fw-bold">Status</span></div>
                                                <div class="col">
                                                    <p class="text-dark"><span class="text-dark fw-bold">:</span>&nbsp;<span class="badge rounded-pill bg-warning text-dark m-1">Sedang Diproses...</span></p>
                                                </div>
                                            </div>
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
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach($daftarTopik as $topik)
                                            @php
                                                $anggota = \App\Models\Kelompok::where('judul', $topik->judul)->get();
                                                $nim = auth()->guard('mahasiswa')->user()->nim;
                                                $sudah_booking = \App\Models\Kelompok::where('judul', $topik->judul)->where('nim', $nim)->exists();
                                                $sudah_punya_kelompok = \App\Models\Kelompok::where('nim', $nim)->exists();
                                            @endphp
                                            <tr>
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
                                                    @if($topik->status == 'Tersedia')
                                                        <span class="badge rounded-pill bg-success">Tersedia</span>
                                                    @elseif($topik->status == 'Penuh')
                                                        <span class="badge rounded-pill bg-danger">Penuh</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-warning text-dark">{{ $topik->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($topik->status == 'Tersedia' && !$sudah_punya_kelompok)
                                                        <form action="{{ route('mahasiswa.pilih_topik', $topik->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button class="btn btn-success btn-sm link-light ms-1 me-1" type="submit"><i class="fas fa-plus"></i></button>
                                                        </form>
                                                    @endif
                                                    @if($sudah_booking && \App\Models\Kelompok::where('judul', $topik->judul)->count() < $topik->kuota)
                                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota{{ $topik->id }}">
                                                            <i class="fas fa-user-plus"></i> Tambah Anggota
                                                        </button>
                                                    @endif
                                                    <button class="btn btn-info btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#ModalLihatDaftarTopik{{ $topik->id }}"><i class="fas fa-eye"></i></button>
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
                                            <td><strong>Aksi</strong></td>
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
                            <select name="nim" class="form-select" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach(\App\Models\Mahasiswa::whereNotIn('nim', \App\Models\Kelompok::pluck('nim'))->get() as $mhs)
                                    <option value="{{ $mhs->nim }}">{{ $mhs->nama }} ({{ $mhs->nim }})</option>
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
                    <h5 class="modal-title" id="ModalLihatDaftarTopikLabel{{ $topik->id }}">Lihat Daftar Topik</h5>
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
                                @if($topik->status == 'Tersedia')
                                    <span class="badge rounded-pill bg-success">Tersedia</span>
                                @elseif($topik->status == 'Penuh')
                                    <span class="badge rounded-pill bg-danger">Penuh</span>
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
                                @php $anggota = \App\Models\Kelompok::where('judul', $topik->judul)->get(); @endphp
                                @if($anggota->count() > 0)
                                    @foreach($anggota as $a)
                                        <span class="badge rounded-pill bg-dark m-1">{{ $a->nama_anggota }} ({{ $a->nim }})</span>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4"><span style="font-weight: bold;">Deskripsi</span></div>
                        <div class="col-8"><p><span class="fw-bold">:&nbsp;</span>{{ $topik->deskripsi ?? '-' }}</p></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</body>
</html>