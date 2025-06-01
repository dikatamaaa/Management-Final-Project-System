@extends('mahasiswa.layout')
@section('content')
@php
    $kelompokSaya = \App\Models\Kelompok::where('nim', Auth::guard('mahasiswa')->user()->nim)->first();
    $bolehKumpul = false;
    $dokumenKelompok = collect();
    $dokumenKelompokList = collect();
    $bimbinganKelompok = collect();
    if ($kelompokSaya) {
        $judul = $kelompokSaya->judul;
        $kuota = \App\Models\DaftarTopik::where('judul', $judul)->first()->kuota ?? 99;
        $statusTopik = \App\Models\DaftarTopik::where('judul', $judul)->first()->status ?? null;
        $jumlahAnggota = \App\Models\Kelompok::where('judul', $judul)->count();
        if ($jumlahAnggota >= $kuota && ($statusTopik === 'Full' || $statusTopik === 'Proposal' || $statusTopik === 'TA')) {
            $bolehKumpul = true;
        }
        $nims = \App\Models\Kelompok::where('judul', $judul)->pluck('nim');
        $dokumenKelompok = \App\Models\DokumenMahasiswa::whereIn('nim', $nims)->orderByDesc('created_at')->get();
        $anggotaNama = \App\Models\Kelompok::where('judul', $judul)->pluck('nama_anggota','nim');
        $dokumenKelompokList = \App\Models\DokumenMahasiswa::whereIn('nim', $nims)->orderBy('judul')->get();
        $bimbinganKelompok = \App\Models\Bimbingan::whereIn('nim', $nims)->orderByDesc('created_at')->get();
    }
@endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3"><h5 class="m-0">Pengumpulan Dokumen</h5></div>
                <div class="card-body">
                    @if(!$kelompokSaya)
                        <div class="alert alert-warning">Anda belum memiliki kelompok. Tidak dapat mengumpulkan dokumen.</div>
                    @elseif(!$bolehKumpul)
                        <div class="alert alert-warning">Dokumen hanya dapat dikumpulkan jika kelompok Anda sudah <b>penuh</b> dan status topik <b>Full</b> atau <b>Proposal</b> atau <b>TA</b>.</div>
                    @endif
                    <form action="{{ route('mahasiswa.store_dokumen') }}" method="POST" @if(!$bolehKumpul) style="pointer-events:none;opacity:0.6;" @endif>
                        @csrf
                        <div class="mb-2">
                            <label class="form-label">Nama atau Judul Dokumen</label>
                            <input type="text" name="judul" class="form-control" required maxlength="255" @if(!$bolehKumpul) disabled @endif>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Link Dokumen (Google Drive, OneDrive, Dropbox, SharePoint)</label>
                            <input type="url" name="link" class="form-control" required @if(!$bolehKumpul) disabled @endif>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <button class="btn btn-primary" type="submit" @if(!$bolehKumpul) disabled @endif>Submit</button>
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#logDokumenModal">
                                Lihat Log Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3"><h5 class="m-0">Pengajuan Bimbingan</h5></div>
                <div class="card-body">
                    @if(!$kelompokSaya)
                        <div class="alert alert-warning">Anda belum memiliki kelompok. Tidak dapat mengajukan bimbingan.</div>
                    @endif
                    <form action="{{ route('mahasiswa.store_bimbingan') }}" method="POST" @if(!$kelompokSaya) style="pointer-events:none;opacity:0.6;" @endif>
                        @csrf
                        <div class="mb-2">
                            <label class="form-label">Pilih Dokumen Terkait</label>
                            <select id="selectDokumen" name="dokumen_terkait" class="form-select">
                                <option value="">-- Pilih Dokumen Terkait --</option>
                                @foreach($dokumenKelompokList as $dok)
                                    <option value="{{ $dok->id }}">{{ $dok->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Topik Bimbingan</label>
                            <input type="text" name="judul" id="judulBimbingan" class="form-control" required maxlength="255">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Pilih Pembimbing</label>
                            <select name="pembimbing" class="form-select" required @if(!$kelompokSaya) disabled @endif>
                                <option value="1">Pembimbing 1{{ $pembimbingSatu ? ' ('.$pembimbingSatu.')' : '' }}</option>
                                <option value="2" @if(!$pembimbingDua || $statusPembimbingDua!=='accepted') disabled @endif>
                                    Pembimbing 2{{ $pembimbingDua ? ' ('.$pembimbingDua.')' : '' }}
                                </option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Waktu yang Diusulkan</label>
                            <input type="text" id="jadwalBimbingan" name="jadwal" class="form-control" required @if(!$kelompokSaya) disabled @endif>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Materi yang Akan Dibahas</label>
                            <textarea name="catatan" class="form-control" @if(!$kelompokSaya) disabled @endif></textarea>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                        <button class="btn btn-primary" type="submit" @if(!$kelompokSaya) disabled @endif>Ajukan Bimbingan</button>
                            <button type="button" class="btn btn-info" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLogBimbingan">
                                Lihat Log Bimbingan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(session('success'))
<script>Swal.fire({icon:'success',title:'Berhasil',text:'{{ session('success') }}',showConfirmButton:false,timer:2000});</script>
@endif
@if(session('error'))
<script>Swal.fire({icon:'error',title:'Gagal',text:'{{ session('error') }}',showConfirmButton:false,timer:2000});</script>
@endif
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
flatpickr("#jadwalBimbingan", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    time_24hr: true
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Log Dokumen Modal -->
<div class="modal fade" id="logDokumenModal" tabindex="-1" aria-labelledby="logDokumenModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logDokumenModalLabel">Log Dokumen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Link</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($dokumenKelompok as $i => $d)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $anggotaNama[$d->nim] ?? '-' }}</td>
                    <td>{{ $d->judul }}</td>
                    <td><a href="{{ $d->link }}" target="_blank">Lihat</a></td>
                    <td>{{ $d->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <form action="{{ route('mahasiswa.hapus_dokumen', $d->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus dokumen ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Belum ada dokumen</td></tr>
            @endforelse
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Offcanvas Log Bimbingan -->
<div class="offcanvas offcanvas-end offcanvas-log-bimbingan" tabindex="-1" id="offcanvasLogBimbingan" aria-labelledby="offcanvasLogBimbinganLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasLogBimbinganLabel">Log Bimbingan</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <table class="table table-sm table-bordered">
        <thead><tr><th>#</th><th>Nama</th><th>Judul</th><th>Pembimbing</th><th>Jadwal</th><th>Status</th><th>Materi Bimbingan</th><th>Catatan Pembimbing</th></tr></thead>
        <tbody>
        @forelse($bimbinganKelompok as $i => $b)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $anggotaNama[$b->nim] ?? '-' }}</td>
                <td>{{ $b->judul }}</td>
                <td>{{ $b->pembimbing == '1' ? 'Pembimbing 1' : 'Pembimbing 2' }}</td>
                <td>{{ \Carbon\Carbon::parse($b->jadwal)->format('d-m-Y H:i') }}</td>
                <td>
                    @if($b->status=='pending')<span class="badge bg-warning text-dark">Pending</span>@endif
                    @if($b->status=='accepted')<span class="badge bg-success">Accepted</span>@endif
                    @if($b->status=='rejected')<span class="badge bg-danger">Rejected</span>@endif
                    @if($b->status=='selesai')<span class="badge bg-info text-dark">Selesai</span>@endif
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalMateri{{ $b->id }}">
                        Lihat Materi
                    </button>
                </td>
                <td>
                    @if($b->status=='rejected')
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalCatatanPembimbing{{ $b->id }}">
                            Lihat Catatan
                        </button>
                    @elseif($b->kritik_saran && $b->status!='rejected')
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalCatatanPembimbing{{ $b->id }}">
                            Lihat Catatan
                        </button>
                    @else
                        -
                    @endif
                </td>
            </tr>
        @empty
        <tr><td colspan="8" class="text-center">Belum ada pengajuan bimbingan</td></tr>
        @endforelse
        </tbody>
    </table>
  </div>
</div>

<!-- Modal untuk setiap bimbingan, diletakkan di luar tabel agar Bootstrap modal berfungsi -->
@foreach($bimbinganKelompok as $b)
    <!-- Modal Materi Bimbingan -->
    <div class="modal fade" id="modalMateri{{ $b->id }}" tabindex="-1" aria-labelledby="modalMateriLabel{{ $b->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMateriLabel{{ $b->id }}">Materi Bimbingan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ $b->catatan ?? '-' }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Catatan Pembimbing -->
    <div class="modal fade" id="modalCatatanPembimbing{{ $b->id }}" tabindex="-1" aria-labelledby="modalCatatanPembimbingLabel{{ $b->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCatatanPembimbingLabel{{ $b->id }}">
                        @if($b->status=='rejected') Alasan Penolakan @else Catatan Pembimbing @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($b->status=='rejected')
                        <span class="text-danger">{{ $b->alasan_tolak ?? '-' }}</span>
                    @elseif($b->kritik_saran && $b->status!='rejected')
                        {{ $b->kritik_saran }}
                    @else
                        -
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
<style>
@media (min-width: 768px) {
    .offcanvas-log-bimbingan {
        width: 80vw !important;
        max-width: 100vw;
    }
}
</style>
<script>
document.addEventListener('hidden.bs.offcanvas', function (event) {
    // Hapus backdrop jika tidak ada offcanvas yang sedang terbuka
    if (document.querySelectorAll('.offcanvas.show').length === 0) {
        document.querySelectorAll('.offcanvas-backdrop').forEach(function(backdrop) {
            backdrop.parentNode.removeChild(backdrop);
        });
        document.body.classList.remove('offcanvas-backdrop');
        document.body.style = '';
    }
});
</script>
<script>
document.addEventListener('shown.bs.offcanvas', function (event) {
    let backdrops = document.querySelectorAll('.offcanvas-backdrop');
    if (backdrops.length > 1) {
        for (let i = 0; i < backdrops.length - 1; i++) {
            backdrops[i].parentNode.removeChild(backdrops[i]);
        }
    }
});
</script>
@endsection 