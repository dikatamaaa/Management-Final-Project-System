@extends('mahasiswa.layout')
@section('content')
<div class="container mt-4">
    <h3>Buat Topik Sendiri</h3>
    <form action="{{ route('mahasiswa.buat_topik') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Topik</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
            @error('judul')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="fakultas" class="form-label">Fakultas</label>
            <input type="text" class="form-control" id="fakultas" name="fakultas" value="{{ $fakultas }}" readonly>
            @error('fakultas')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="program_studi" class="form-label">Program Studi</label>
            <input type="text" class="form-control" id="program_studi" name="program_studi" value="{{ $program_studi }}" readonly>
            @error('program_studi')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Bidang (boleh lebih dari satu)</label>
            <select class="form-control" id="bidangSelect" name="bidang[]" multiple required>
                @foreach($bidangList as $bidang)
                    <option value="{{ $bidang }}" {{ (collect(old('bidang'))->contains($bidang)) ? 'selected' : '' }}>{{ $bidang }}</option>
                @endforeach
            </select>
            @error('bidang')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="kuota" class="form-label">Kuota Kelompok</label>
            <input type="number" class="form-control" id="kuota" name="kuota" min="{{ $kuotaMin }}" max="{{ $kuotaMax }}" value="{{ $kuotaMax }}" readonly>
            <small class="form-text text-muted">Kuota maksimal {{ $kuotaMax }} anggota (termasuk Anda).</small>
            @error('kuota')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Topik</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Tambah Anggota (opsional, yang belum punya kelompok)</label>
            <select class="form-control" id="anggotaTambahan" name="anggota_tambahan[]" multiple>
                <option value="all">All</option>
                @foreach($daftarMahasiswa as $mhs)
                    <option value="{{ $mhs->nim }}">{{ $mhs->nama }}</option>
                @endforeach
            </select>
            <small class="form-text text-muted">Pilih lebih dari satu jika ingin menambah beberapa anggota.</small>
        </div>
        <button type="submit" class="btn btn-success">Ajukan Topik</button>
        <a href="{{ url('/mahasiswa/daftar_topik') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<!-- jQuery (WAJIB PALING ATAS) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Choices.js untuk bidang -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
.custom-dropdown {
    position: relative;
    width: 100%;
    margin-bottom: 1rem;
}
.custom-dropdown .dropdown-btn {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 12px 16px;
    width: 100%;
    text-align: left;
    cursor: pointer;
    font-size: 1.1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.custom-dropdown .dropdown-content {
    display: none;
    position: absolute;
    background: #fff;
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    z-index: 10;
    margin-top: 5px;
    padding: 10px 0;
    max-height: 250px;
    overflow-y: auto;
}
.custom-dropdown.active .dropdown-content {
    display: block;
}
.custom-dropdown .checkbox-label {
    display: flex;
    align-items: center;
    padding: 8px 20px;
    cursor: pointer;
    font-size: 1.05rem;
}
.custom-dropdown .checkbox-label input[type=checkbox] {
    margin-right: 10px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const kuota = parseInt(document.getElementById('kuota').value) || 1;
    const maxAnggotaTambahan = kuota - 1;
    const anggotaSelect = document.getElementById('anggotaTambahan');
    const choices = new Choices(anggotaSelect, {
        removeItemButton: true,
        searchResultLimit: 100,
        searchPlaceholderValue: 'Cari nama atau NIM',
        shouldSort: false,
        maxItemCount: maxAnggotaTambahan,
        placeholder: true,
        placeholderValue: 'Pilih anggota...'
    });
    // Handle 'All' option
    anggotaSelect.addEventListener('change', function(e) {
        const values = Array.from(anggotaSelect.selectedOptions).map(opt => opt.value);
        if (values.includes('all')) {
            // Select all kecuali 'all' jika belum semua
            if (anggotaSelect.selectedOptions.length < anggotaSelect.options.length) {
                for (let i = 0; i < anggotaSelect.options.length; i++) {
                    if (anggotaSelect.options[i].value !== 'all') {
                        anggotaSelect.options[i].selected = true;
                    }
                }
                choices.setValue(Array.from(anggotaSelect.options).filter(opt => opt.value !== 'all').map(opt => ({value: opt.value, label: opt.text})));
            } else {
                // Deselect all
                for (let i = 0; i < anggotaSelect.options.length; i++) {
                    anggotaSelect.options[i].selected = false;
                }
                choices.removeActiveItems();
            }
        }
        // Batasi jumlah anggota tambahan
        if (anggotaSelect.selectedOptions.length > maxAnggotaTambahan) {
            // Deselect yang terakhir
            anggotaSelect.selectedOptions[anggotaSelect.selectedOptions.length-1].selected = false;
            choices.removeActiveItems();
        }
    });

    const bidangSelect = document.getElementById('bidangSelect');
    const bidangChoices = new Choices(bidangSelect, {
        removeItemButton: true,
        searchResultLimit: 100,
        shouldSort: false,
        placeholder: true,
        placeholderValue: 'Pilih bidang...'
    });
});
</script>
@endsection 