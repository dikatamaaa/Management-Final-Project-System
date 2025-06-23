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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark" style="background: #881d1d;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon"><img class="img-fluid" src="{{ asset('/storage/assets/img/Logo/Logo%20White%20(1000%20x%201000%20piksel).png') }}" width="100px"></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link active" href="/mahasiswa/beranda"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
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
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="badge bg-danger badge-counter">
                                            {{ Auth::guard('mahasiswa')->user()->unreadNotifications->count() }}
                                        </span>
                                        <i class="fas fa-bell fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">Alerts Center</h6>
                                        @forelse (Auth::guard('mahasiswa')->user()->notifications as $notif)
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="me-3">
                                                    <div class="bg-warning icon-circle">
                                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span class="small text-gray-500">{{ $notif->created_at->format('d M Y H:i') }}</span>
                                                    <p>{{ $notif->data['pesan'] }}</p>
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
                        <h3 class="text-dark mb-0">Dashboard</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Komposisi Status Topik</p>
                                </div>
                                <div class="card-body">
                                    <canvas id="statusTopikChart" height="180"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Jumlah Topik per Bidang</p>
                                </div>
                                <div class="card-body">
                                    <canvas id="bidangTopikChart" height="180"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Proporsi Topik per Dosen</p>
                                </div>
                                <div class="card-body">
                                    <canvas id="pieDosenTopikChart" height="180"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
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
                    <div class="row mt-3">
                        <div class="col-6 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <p class="text-dark m-0 fw-bold">Data Pembimbing</p><button class="btn btn-sm" type="button" style="color: rgb(136,29,29);"><strong>Lihat Selengkapnya...</strong><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
                                        </svg></button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                        <table class="table table-striped table-hover" id="tableData1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Kode Dosen</th>
                                                    <th>Posisi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 1; @endphp
                                                @if($pembimbingSatu && $pembimbingSatu != '-')
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $pembimbingSatu }}</td>
                                                    <td>{{ \App\Models\Dosen::where('nama', $pembimbingSatu)->first()->kode_dosen ?? '-' }}</td>
                                                    <td>Pembimbing 1</td>
                                                </tr>
                                                @endif
                                                @if($pembimbingDua && $pembimbingDua != '-')
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $pembimbingDua }}</td>
                                                    <td>{{ \App\Models\Dosen::where('nama', $pembimbingDua)->first()->kode_dosen ?? '-' }}</td>
                                                    <td>Pembimbing 2</td>
                                                </tr>
                                                @endif
                                                @if(($pembimbingSatu == '-' || !$pembimbingSatu) && ($pembimbingDua == '-' || !$pembimbingDua))
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center">Belum ada pembimbing</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>No</strong></td>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>Kode Dosen</strong></td>
                                                    <td><strong>Posisi</strong></td>
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
                                    <p class="text-dark m-0 fw-bold">Data Kelompok</p><button class="btn btn-sm" type="button" style="color: rgb(136,29,29);"><strong>Lihat Selengkapnya...</strong><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
                                        </svg></button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table mt-2" id="dataTable-2" role="grid" aria-describedby="dataTable_info">
                                        <table class="table table-striped table-hover" id="tableData2">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIM</th>
                                                    <th>Nama</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 1; @endphp
                                                @forelse($anggotaKelompok as $anggota)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $anggota->nim }}</td>
                                                    <td>{{ $anggota->nama_anggota }}</td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm ms-1" type="button" data-bs-toggle="modal" data-bs-target="#ModalLihatKelompok{{ $anggota->id }}"><i class="fas fa-eye"></i></button>
                                                        <!-- Modal detail anggota kelompok -->
                                                        <div class="modal fade" role="dialog" tabindex="-1" id="ModalLihatKelompok{{ $anggota->id }}">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" style="font-weight: bold;">Lihat Data Kelompok</h5>
                                                                        <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-5"><span style="font-weight: bold;">NIM</span></div>
                                                                            <div class="col-7"><p><span class="fw-bold">:&nbsp;</span>{{ $anggota->nim }}</p></div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5"><span style="font-weight: bold;">Nama</span></div>
                                                                            <div class="col-7"><p><span class="fw-bold">:&nbsp;</span>{{ $anggota->nama_anggota }}</p></div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5"><span style="font-weight: bold;">Status Pembimbing 1</span></div>
                                                                            <div class="col-7"><p><span class="fw-bold">:&nbsp;</span>{{ $pembimbingSatu }}</p></div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-5"><span style="font-weight: bold;">Status Pembimbing 2</span></div>
                                                                            <div class="col-7"><p><span class="fw-bold">:&nbsp;</span>{{ $pembimbingDua }}</p></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer"><button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tutup</button></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center">Belum ada anggota kelompok</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>No</strong></td>
                                                    <td><strong>NIM</strong></td>
                                                    <td><strong>Nama</strong></td>
                                                    <td><strong>Aksi</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
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

        // Mark notifications as read when Alerts Center is opened
        $(function() {
            $('.nav-item.dropdown.no-arrow.mx-1').on('show.bs.dropdown', function () {
                $.post("{{ route('mahasiswa.notifications.read') }}", {
                    _token: '{{ csrf_token() }}'
                }, function() {
                    $('.badge-counter').text('0');
                });
            });
        });

        // Chart.js Pie Chart: Komposisi Status Topik
        const ctxStatus = document.getElementById('statusTopikChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: @json($statusLabels),
                datasets: [{
                    data: @json($statusCounts),
                    backgroundColor: [
                        '#4ade80', '#f87171', '#60a5fa', '#38bdf8', '#facc15'
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
                cutout: '70%',
                responsive: true,
                maintainAspectRatio: false
            }
        });
        // Chart.js Bar Chart: Jumlah Topik per Bidang
        const ctxBidang = document.getElementById('bidangTopikChart').getContext('2d');
        new Chart(ctxBidang, {
            type: 'bar',
            data: {
                labels: @json($bidangLabels),
                datasets: [{
                    label: 'Jumlah Topik',
                    data: @json($bidangData),
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
        // Pie Chart: Proporsi Topik per Dosen
        const ctxPieDosen = document.getElementById('pieDosenTopikChart').getContext('2d');
        new Chart(ctxPieDosen, {
            type: 'pie',
            data: {
                labels: @json($dosenLabels),
                datasets: [{
                    data: @json($dosenData),
                    backgroundColor: [
                        '#60a5fa', '#4ade80', '#facc15', '#a78bfa', '#f87171'
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
        // Line Chart: Progress Bimbingan per Dosen
        const ctxLineBimbingan = document.getElementById('lineBimbinganChart').getContext('2d');
        new Chart(ctxLineBimbingan, {
            type: 'line',
            data: {
                labels: @json($progressLabels),
                datasets: [
                    @foreach($pembimbingChartLabels as $i => $label)
                    {
                        label: '{{ $label }}',
                        data: @json($progressData[$label]),
                        borderColor: ['#60a5fa', '#4ade80'][{{ $i }} % 2],
                        backgroundColor: 'rgba(96,165,250,0.12)',
                        tension: 0.4,
                        fill: false,
                        pointRadius: 4,
                        pointBackgroundColor: ['#60a5fa', '#4ade80'][{{ $i }} % 2],
                    },
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
    #statusTopikChart, #bidangTopikChart {
        min-height: 180px;
        max-height: 260px;
    }
    .card .card-body {
        padding-bottom: 1.5rem;
    }
    </style>
</body>
</html>