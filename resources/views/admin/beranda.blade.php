<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>InfoTA - Beranda</title>
    <link rel="stylesheet" href="{{ asset('/storage/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('/storage/assets/fonts/fontawesome-all.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <a class="nav-link active" href="/admin/beranda">
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

                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                            <i class="fas fa-users"></i><span>Kelola Pengguna</span>
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
                        <h3 class="text-dark mb-0">Dashboard</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <a href="/admin/mahasiswa" style="text-decoration: none;">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                <span>mahasiswa (penyusun ta)</span>
                                            </div>
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span>{{ number_format($JumlahDataMahasiswa) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <a href="/admin/dosen" style="text-decoration: none;">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1">
                                                <span>dosen (pembimbing)</span>
                                            </div>
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span>{{ number_format($JumlahDataDosen) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
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
    </script>
    <script>
    // Pie Chart: Proporsi Topik per Dosen
    const ctxPieDosen = document.getElementById('pieDosenTopikChart').getContext('2d');
    new Chart(ctxPieDosen, {
        type: 'pie',
        data: {
            labels: ['Dr. A', 'Dr. B', 'Dr. C', 'Dr. D', 'Dr. E'],
            datasets: [{
                data: [8, 5, 7, 4, 6],
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
    // Bar Chart: Jumlah Topik per Bidang
    const ctxBidang = document.getElementById('bidangTopikChart').getContext('2d');
    new Chart(ctxBidang, {
        type: 'bar',
        data: {
            labels: ['Web', 'AI', 'Jaringan', 'IoT', 'Data Science'],
            datasets: [{
                label: 'Jumlah Topik',
                data: [7, 4, 6, 3, 5],
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
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [
                {
                    label: 'Dr. A',
                    data: [2, 3, 4, 5, 6, 7],
                    borderColor: '#60a5fa',
                    backgroundColor: 'rgba(96,165,250,0.12)',
                    tension: 0.4,
                    fill: false,
                    pointRadius: 4,
                    pointBackgroundColor: '#60a5fa',
                },
                {
                    label: 'Dr. B',
                    data: [1, 2, 2, 3, 4, 5],
                    borderColor: '#4ade80',
                    backgroundColor: 'rgba(74,222,128,0.12)',
                    tension: 0.4,
                    fill: false,
                    pointRadius: 4,
                    pointBackgroundColor: '#4ade80',
                },
                {
                    label: 'Dr. C',
                    data: [0, 1, 2, 2, 3, 4],
                    borderColor: '#facc15',
                    backgroundColor: 'rgba(250,204,21,0.12)',
                    tension: 0.4,
                    fill: false,
                    pointRadius: 4,
                    pointBackgroundColor: '#facc15',
                }
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
    </style>
</body>
</html>