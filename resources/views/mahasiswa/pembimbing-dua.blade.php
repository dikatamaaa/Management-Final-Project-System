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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #881d1d;
            --primary-darker: #6e1717;
            --primary-lighter: #a83232;
            --sidebar-text: rgba(255, 255, 255, 0.8);
            --sidebar-text-active: #ffffff;
            --secondary-color: #f8f9fa;
            --font-family: 'Poppins', sans-serif;
        }
        body {
            font-family: var(--font-family);
            background-color: var(--secondary-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        #wrapper {
            display: flex;
            min-height: 100vh;
            flex: 1;
        }
        .sidebar {
            background: var(--primary-color) !important;
            transition: all 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            width: 250px;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .sidebar .sidebar-brand {
            height: 60px;
            transition: background-color 0.2s ease;
        }
        .sidebar .sidebar-brand:hover {
           /* background-color: var(--primary-darker); */
        }
        .sidebar .sidebar-brand-icon img {
            transition: transform 0.3s ease;
        }
        .sidebar .sidebar-brand:hover .sidebar-brand-icon img {
            transform: scale(1.1) rotate(3deg);
        }
        hr.sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }
        .sidebar .nav-item {
            position: relative;
        }
        .sidebar .nav-item .nav-link {
            color: var(--sidebar-text);
            font-weight: 500;
            padding: 0.9rem 1.25rem;
            transition: all 0.2s ease-in-out;
            border-left: 4px solid transparent;
        }
        .sidebar .nav-item .nav-link:hover {
            color: var(--sidebar-text-active);
            background-color: var(--primary-darker);
            border-left-color: var(--primary-lighter);
        }
        .sidebar .nav-item.active .nav-link,
        .sidebar .nav-link.active {
            color: var(--sidebar-text-active);
            font-weight: 600;
            background-color: var(--primary-darker);
            border-left-color: #ffffff;
        }
        .sidebar .nav-item .nav-link i {
            font-size: 1em;
            width: 24px;
            text-align: center;
            margin-right: 0.75rem;
        }
        .sidebar .dropdown-menu {
            background-color: var(--primary-lighter);
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .sidebar .dropdown-item {
            color: var(--sidebar-text);
            padding: 0.6rem 1.5rem;
            transition: background-color 0.2s ease;
        }
        .sidebar .dropdown-item:hover, .sidebar .dropdown-item:focus {
            background-color: var(--primary-darker);
            color: var(--sidebar-text-active);
        }
        .sidebar .dropdown-item i {
            margin-right: 0.5rem;
        }
        .card {
            border-radius: 16px;
            box-shadow: 0 2px 16px 0 rgba(0,0,0,0.07);
            border: none;
            margin-bottom: 2rem;
        }
        .card-header {
            background: #f8fafc;
            border-radius: 16px 16px 0 0;
            font-weight: 700;
            font-size: 1.15rem;
            color: #1e293b;
            border-bottom: 1.5px solid #e5e7eb;
        }
        .table th, .table td {
            padding: 0.55rem 0.7rem;
            vertical-align: middle;
            border-top: none;
            border-bottom: 1.5px solid #e5e7eb;
            background: transparent;
        }
        .table thead th {
            background: #f1f5f9;
            font-weight: 600;
            border-bottom: 2px solid #d1d5db;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            --bs-table-accent-bg: #f8fafc;
        }
        .badge {
            border-radius: 8px;
            font-size: 0.85em;
            padding: 0.35em 0.7em;
            font-weight: 500;
            letter-spacing: 0.01em;
        }
        .badge.bg-success {
            background: #4ade80 !important;
            color: #065f46 !important;
        }
        .badge.bg-danger {
            background: #f87171 !important;
            color: #7f1d1d !important;
        }
        .badge.bg-warning {
            background: #facc15 !important;
            color: #92400e !important;
        }
        .badge.bg-dark {
            background: #334155 !important;
            color: #fff !important;
        }
        .badge.bg-primary {
            background: #60a5fa !important;
            color: #1e3a8a !important;
        }
        .badge.bg-info {
            background: #38bdf8 !important;
            color: #0369a1 !important;
        }
        .btn {
            border-radius: 7px !important;
            font-size: 0.97em;
            font-weight: 500;
            transition: background 0.18s, box-shadow 0.18s;
            box-shadow: 0 2px 8px 0 rgba(37,99,235,0.07);
        }
        .btn-primary, .btn-success, .btn-danger, .btn-warning, .btn-info {
            border: none;
        }
        .btn-primary {
            background: #2563eb;
        }
        .btn-primary:hover {
            background: #1d4ed8;
        }
        .btn-success {
            background: #22c55e;
        }
        .btn-success:hover {
            background: #16a34a;
        }
        .btn-danger {
            background: #ef4444;
        }
        .btn-danger:hover {
            background: #b91c1c;
        }
        .btn-warning {
            background: #facc15;
            color: #92400e;
        }
        .btn-warning:hover {
            background: #eab308;
            color: #78350f;
        }
        .btn-info {
            background: #38bdf8;
            color: #0369a1;
        }
        .btn-info:hover {
            background: #0ea5e9;
            color: #075985;
        }
        .btn-sm {
            padding: 0.32em 1.1em;
            font-size: 0.93em;
        }
        .clickable-row {
            cursor: pointer;
            transition: background 0.18s;
        }
        .clickable-row:hover {
            background: #f1f5f9 !important;
        }
        .table-responsive {
            margin-bottom: 0.5rem;
        }
        
        /* Footer styling */
        .sticky-footer {
            position: sticky;
            bottom: 0;
            width: 100%;
            padding: 1rem 0;
            border-top: 1px solid #e5e7eb;
            background: #ffffff;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
            margin-top: auto;
            z-index: 100;
            flex-shrink: 0;
        }
        
        /* Ensure content wrapper takes full height */
        #content-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin-left: 250px;
        }
        
        /* Make content area flexible */
        #content {
            flex: 1 0 auto;
            display: flex;
            flex-direction: column;
        }
        
        /* Container for main content */
        .container-fluid {
            flex: 1 0 auto;
        }
        
        /* Ensure main content area takes available space */
        .main-content {
            flex: 1 0 auto;
            min-height: 0;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 280px;
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            #content-wrapper {
                margin-left: 0 !important;
                width: 100% !important;
                min-height: 100vh;
            }
            .sticky-footer {
                margin-top: auto;
                position: sticky;
                bottom: 0;
            }
            .table th, .table td {
                padding: 0.45rem 0.3rem;
                font-size: 0.98em;
            }
            .btn-sm {
                font-size: 0.91em;
                padding: 0.28em 0.7em;
            }
            .card-header {
                font-size: 1.01rem;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon">
                        <img class="img-fluid" src="{{ asset('storage/assets/img/Logo/TAKU_White.png') }}" width="100px" alt="Logo TAKU">
                    </div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/beranda"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/daftar_topik"><i class="far fa-file-alt"></i><span>Daftar Topik</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/template_laporan"><i class="fas fa-file-word"></i><span>Template Laporan</span></a>
                    </li>                    
                    <li class="nav-item active">
                        <a class="nav-link active" href="/mahasiswa/pembimbing-dua"><i class="fas fa-users"></i><span>Pembimbing 2</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa/dokumen-bimbingan"><i class="fas fa-comments"></i><span>Bimbingan</span></a>
                    </li>
                    <li class="nav-item mt-auto">
                        <hr class="sidebar-divider my-0">
                        <a class="nav-link" href="/mahasiswa/profil"><i class="fas fa-user"></i><span>Profil</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i><span>Keluar</span></a>
                    </li>
                </ul>
                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
                </div>
            </div>
        </nav>
        
        <div class="d-flex flex-column" id="content-wrapper" style="margin-left: 225px;">
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
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::guard('mahasiswa')->user()->nama_pengguna }}</span>
                                        <span class="badge rounded-pill me-2" style="background: #881d1d;">Mahasiswa</span>
                                        <img class="border rounded-circle img-profile" src="{{ asset('/storage/assets/img/avatars/'.(Auth::guard('mahasiswa')->user()->foto ?? 'default.jpg')) }}">
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item" href="/mahasiswa/profil">
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

                <div class="container-fluid main-content">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Pembimbing 2</h3>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <p class="text-dark m-0 fw-bold">Mencari Pembimbing 2</p>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning" role="alert"><span><strong>Catatan :</strong></span>
                                <ul>                                  
                                    <li>Pembimbing 1 Akan Otomatis Dipilih Sesuai Dengan Topik Yang Dimiliki Oleh Dosen Bersangkutan</li>
                                    <li>Pembimbing 2 Bisa Dipilih Setelah Mendapatkan Topik dan Pembimbing 1</li>
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h5>Pembimbing</h5>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Pembimbing 1</label>
                                            @if(isset($kelompokSaya) && $kelompokSaya)
                                                <input class="form-control-sm form-control" type="text" value="{{ $kelompokSaya->pembimbing_satu }}" readonly>
                                            @else
                                                <input class="form-control-sm form-control" type="text" value="" readonly placeholder="Akan muncul otomatis setelah Anda memiliki kelompok">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label class="form-label">Pembimbing 2</label>
                                            @if(isset($kelompokSaya) && $kelompokSaya)
                                                @php
                                                    $disablePembimbing2 = ($kelompokSaya->status_pembimbing_dua === 'pending' || $kelompokSaya->status_pembimbing_dua === 'accepted');
                                                @endphp
                                                <form action="{{ route('mahasiswa.pilih_pembimbing_dua') }}" method="POST">
                                                    @csrf
                                                    <select class="form-select form-select-sm" name="pembimbing_dua" id="pembimbing_2" required @if($disablePembimbing2) disabled @endif>
                                                        <option value="">-- Pilih Pembimbing 2 --</option>
                                                        @foreach($dosenList as $dosen)
                                                            @if(!isset($kelompokSaya) || $kelompokSaya->pembimbing_satu != $dosen->nama)
                                                                <option value="{{ $dosen->nama }}" {{ isset($kelompokSaya) && $kelompokSaya->pembimbing_dua == $dosen->nama ? 'selected' : '' }}>{{ $dosen->nama }} ({{ $dosen->kode_dosen }})</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <div class="d-grid gap-2 mt-2">
                                                        <button class="btn btn-sm" type="submit" style="background: #881d1d;color: rgb(255,255,255);" @if($disablePembimbing2) disabled @endif>
                                                            <i class="fas fa-save"></i>&nbsp;Pilih Pembimbing 2
                                                        </button>
                                                    </div>
                                                </form>
                                                @if($kelompokSaya->status_pembimbing_dua === 'pending')
                                                    <div class="alert alert-info mt-2">Menunggu konfirmasi dosen pembimbing dua.</div>
                                                @elseif($kelompokSaya->status_pembimbing_dua === 'accepted')
                                                    <div class="alert alert-success mt-2">Pembimbing dua sudah diterima oleh dosen.</div>
                                                @elseif($kelompokSaya->status_pembimbing_dua === 'rejected')
                                                    <div class="alert alert-danger mt-2">Permintaan pembimbing dua ditolak. Silakan pilih ulang pembimbing dua.</div>
                                                @endif
                                            @else
                                                <select class="form-select form-select-sm" disabled>
                                                    <option>-- Pilih Pembimbing 2 --</option>
                                                </select>
                                                <div class="alert alert-info mt-2">Fitur ini hanya bisa digunakan setelah Anda memiliki kelompok.</div>
                                            @endif
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
                    <div class="text-center my-auto copyright"><span>Copyright © TAKU 2025</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
   <script src="{{ asset('/storage/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/storage/assets/js/script.js') }}"></script>
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

$(document).ready(function () {

  // Fungsi untuk menyimpan opsi master pada setiap select
  function initMasterOptions(selector) {
    $(selector).each(function () {
      let options = [];
      $(this).find('option').each(function () {
        options.push({
          value: $(this).val(),
          text: $(this).text()
        });
      });
      $(this).data('options', options);
    });
  }

  // Fungsi untuk inisialisasi Select2 dan pasang event listener perubahan
  function initSelect2(selector) {
    $(selector).select2({
      placeholder: "-- Pilih Nama Anggota --",
      maximumSelectionLength: 1,
      width: '100%',
      language: {
          noResults: function() {
              return "Data Tidak ditemukan";
          },
          maximumSelected: function(args) {
              return "Anda hanya dapat memilih " + args.maximum + " item"; 
          }
      }
    });
    // Setiap ada perubahan pada select, panggil updateOptions
    $(selector).on('change', function () {
      updateOptions();
    });
  }

  // Fungsi untuk meng-update opsi pada setiap select sehingga opsi yang sudah dipilih pada select lain tidak muncul
  function updateOptions() {
    let allSelected = [];
    
    // Kumpulkan seluruh nilai yang terpilih di semua select
    $('.namaAnggotaSelect').each(function () {
      let selected = $(this).val();
      if (selected) {
        if (Array.isArray(selected)) {
          allSelected = allSelected.concat(selected);
        } else {
          allSelected.push(selected);
        }
      }
    });

    // Untuk setiap select, rebuild opsi berdasarkan master data
    $('.namaAnggotaSelect').each(function () {
      let $sel = $(this);
      let currentSelection = $sel.val() || [];
      let masterOptions = $sel.data('options');
      
      let filteredOptions = masterOptions.filter(function (opt) {
        // Tampilkan opsi yang saat ini terpilih, atau opsi yang belum terpilih di select lain
        if (currentSelection.includes(opt.value)) {
          return true;
        }
        return !allSelected.includes(opt.value);
      });

      // Bersihkan opsi yang ada di select
      $sel.empty();

      // Masukkan kembali opsi yang tersisa
      filteredOptions.forEach(function (opt) {
        let selected = currentSelection.includes(opt.value) ? 'selected' : '';
        $sel.append(`<option value="${opt.value}" ${selected}>${opt.text}</option>`);
      });

      // Hancurkan instance Select2 yang lama dan inisialisasi ulang
      $sel.select2('destroy');
      $sel.select2({
        placeholder: "-- Pilih Nama Anggota --",
        maximumSelectionLength: 1,
        width: '100%',
        language: {
          noResults: function() {
              return "Data Tidak Ada";
          },
          maximumSelected: function(args) {
              return "Anda hanya dapat memilih " + args.maximum + " item";
          }
        }
      });
    });
  }

  // Inisialisasi master option dan Select2 untuk input pertama
  initMasterOptions('.namaAnggotaSelect');
  initSelect2('#nama_anggota_1');

  // Event handler tombol "Tambah"
  $('#addInput').on('click', function () {
    let count = $('.inputGroup').length;
    if (count < 5) {
      let index = count + 1;
      let newInput = `
        <div class="inputGroup d-flex mt-3">
          <div class="col-11">
            <select class="form-select form-select-sm namaAnggotaSelect" name="nama_anggota[]" id="nama_anggota_${index}" multiple>
              @foreach ($dataMahasiswa as $data)
                <option value="{{ $data->nama }}">{{ $data->nim }} - {{ $data->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-1 ms-1">
            <button class="btn btn-danger btn-sm removeInput" type="button">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
      `;
      $('#formContainer').append(newInput);
      // Simpan master options untuk select yang baru
      initMasterOptions('#nama_anggota_' + index);
      // Inisialisasi Select2 untuk select yang baru ditambahkan
      initSelect2('#nama_anggota_' + index);
      updateOptions();
    } else {
      return
    }
  });

  // Event delegation untuk tombol "Hapus"
  $(document).on('click', '.removeInput', function () {
    if ($('.inputGroup').length > 1) {
      $(this).closest('.inputGroup').remove();
      updateOptions();
    }
  });

  $(document).ready(function() {
    $('#pembimbing_2').select2({
        placeholder: "-- Pilih Pembimbing 2 --",
        width: '100%'
    });
  });
});

        // Ensure footer stays at bottom
        function adjustFooter() {
            const contentWrapper = document.getElementById('content-wrapper');
            const content = document.getElementById('content');
            const footer = document.querySelector('.sticky-footer');
            
            if (contentWrapper && content && footer) {
                const windowHeight = window.innerHeight;
                const contentHeight = content.offsetHeight;
                const footerHeight = footer.offsetHeight;
                
                if (contentHeight + footerHeight < windowHeight) {
                    contentWrapper.style.minHeight = windowHeight + 'px';
                }
            }
        }
        
        // Run on page load and resize
        window.addEventListener('load', adjustFooter);
        window.addEventListener('resize', adjustFooter);
        </script>
</body>
</html>