@extends('mahasiswa.layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-danger text-white"><b>Ganti Password Wajib</b></div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/mahasiswa/ganti-password-awal') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="kata_sandi_baru" class="form-label">Kata Sandi Baru</label>
                            <input type="password" class="form-control @error('kata_sandi_baru') is-invalid @enderror" id="kata_sandi_baru" name="kata_sandi_baru" required minlength="8">
                            @error('kata_sandi_baru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="konfirmasi_kata_sandi" class="form-label">Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control @error('konfirmasi_kata_sandi') is-invalid @enderror" id="konfirmasi_kata_sandi" name="konfirmasi_kata_sandi" required minlength="8">
                            @error('konfirmasi_kata_sandi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fakultas" class="form-label">Fakultas</label>
                            <select class="form-control @error('fakultas') is-invalid @enderror" id="fakultas" name="fakultas" required>
                                <option value="">-- Pilih Fakultas --</option>
                                <option value="Fakultas Teknik Elektro (FTE)" {{ old('fakultas', auth()->guard('mahasiswa')->user()->fakultas) == 'Fakultas Teknik Elektro (FTE)' ? 'selected' : '' }}>Fakultas Teknik Elektro (FTE)</option>
                                <option value="Fakultas Rekayasa Industri (FRI)" {{ old('fakultas', auth()->guard('mahasiswa')->user()->fakultas) == 'Fakultas Rekayasa Industri (FRI)' ? 'selected' : '' }}>Fakultas Rekayasa Industri (FRI)</option>
                                <option value="Fakultas Informatika (FIF)" {{ old('fakultas', auth()->guard('mahasiswa')->user()->fakultas) == 'Fakultas Informatika (FIF)' ? 'selected' : '' }}>Fakultas Informatika (FIF)</option>
                                <option value="Fakultas Ekonomi dan Bisnis (FEB)" {{ old('fakultas', auth()->guard('mahasiswa')->user()->fakultas) == 'Fakultas Ekonomi dan Bisnis (FEB)' ? 'selected' : '' }}>Fakultas Ekonomi dan Bisnis (FEB)</option>
                                <option value="Fakultas Komunikasi dan Ilmu Sosial (FKI)" {{ old('fakultas', auth()->guard('mahasiswa')->user()->fakultas) == 'Fakultas Komunikasi dan Ilmu Sosial (FKI)' ? 'selected' : '' }}>Fakultas Komunikasi dan Ilmu Sosial (FKI)</option>
                                <option value="Fakultas Industri Kreatif (FIK)" {{ old('fakultas', auth()->guard('mahasiswa')->user()->fakultas) == 'Fakultas Industri Kreatif (FIK)' ? 'selected' : '' }}>Fakultas Industri Kreatif (FIK)</option>
                                <option value="Fakultas Ilmu Terapan (FIT)" {{ old('fakultas', auth()->guard('mahasiswa')->user()->fakultas) == 'Fakultas Ilmu Terapan (FIT)' ? 'selected' : '' }}>Fakultas Ilmu Terapan (FIT)</option>
                            </select>
                            @error('fakultas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="program_studi" class="form-label">Program Studi</label>
                            <select class="form-control @error('program_studi') is-invalid @enderror" id="program_studi" name="program_studi" required>
                                <option value="">-- Pilih Program Studi --</option>
                            </select>
                            @error('program_studi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas" required>
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <select class="form-control @error('angkatan') is-invalid @enderror" id="angkatan" name="angkatan" required>
                                <option value="">-- Pilih Angkatan --</option>
                                @for ($year = date('Y'); $year > date('Y')-10; $year--)
                                    <option value="{{ $year }}" required>{{ $year }}</option>
                                @endfor
                            </select>
                            @error('angkatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', auth()->guard('mahasiswa')->user()->no_hp) }}" required pattern="[0-9]{8,15}" minlength="8" maxlength="15" placeholder="08xxxxxxxxxx">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>                        
                        <button type="submit" class="btn btn-danger w-100">Ganti Password</button>
                    </form>
                </div>
            </div>
            <div class="alert alert-warning mt-3">Anda wajib mengganti password sebelum dapat menggunakan sistem.</div>
        </div>
    </div>
</div>
<script>
const prodiByFakultas = {
    "Fakultas Teknik Elektro (FTE)": ["S1 Teknik Elektro", "S1 Teknik Telekomunikasi", "S1 Teknik Fisika", "S1 Teknik Komputer", "S1 Teknik Biomedis", "S1 Teknik Sistem Energi", "S1 Teknik Telekomunikasi (Jakarta)", "S2 Teknik Elektro", "S3 Teknik Elektro"],
    "Fakultas Rekayasa Industri (FRI)": ["S1 Teknik Industri", "S1 Sistem Informasi", "S1 Teknik Logistik", "S1 Manajemen Rekayasa", "S1 Sistem Informasi (Jakarta)", "S2 Teknik Industri", "S2 Sistem Informasi"],
    "Fakultas Informatika (FIF)": ["S1 Informatika", "S1 Teknologi Informasi", "S1 Informatika PJJ", "S1 Sains Data", "S1 Rekayasa Perangkat Lunak", "S1 Teknologi Informasi (Jakarta)", "S2 Informatika", "S2 Ilmu Forensik", "S3 Informatika"],
    "Fakultas Ekonomi dan Bisnis (FEB)": ["S1 Manajemen Bisnis Telekomunikasi & Informatika (MBTI)", "S1 Akuntansi", "S1 Leisure Management", "S1 Administrasi Bisnis", "S1 Bisnis Digital", "S2 Manajemen", "S2 Manajemen PJJ", "S2 Administrasi Bisnis"],
    "Fakultas Komunikasi dan Ilmu Sosial (FKI)": ["S1 Ilmu Komunikasi", "S1 Hubungan Masyarakat", "S1 Digital Content Brodcating", "S1 Psikologi", "S2 Ilmu Komunikasi"],
    "Fakultas Industri Kreatif (FIK)": ["S1 Desain Komunikasi Visual", "S1 Desian Produk", "S1 Desain Interior", "S1 Seni Rupa", "S1 Kriya", "S1 Film dan Animasi", "S1 Desain Komunikasi Visual (Jakarta)", "S2 Desain"],
    "Fakultas Ilmu Terapan (FIT)": ["D3 Teknik Telekomunikasi", "D3 Rekayasa Perangkat Lunak Aplikasi", "D3 Sistem Informasi", "D3 Sistem Informasi Akuntansi", "D3 Teknologi Komputer", "D3 Digital Marketing", "D3 Hospitality & Culinary Art", "D3 Teknik Telekomunikasi (Jakarat)", "S1 Terapan Digital Creative Multimedia", "S1 Terapan Sistem Informasi Kota Cerdas"]
};

function updateProdiDropdown() {
    const fakultas = document.getElementById('fakultas').value;
    const prodiSelect = document.getElementById('program_studi');
    prodiSelect.innerHTML = '<option value="">-- Pilih Program Studi --</option>';
    if (prodiByFakultas[fakultas]) {
        const selectedProdi = "{{ old('program_studi', auth()->guard('mahasiswa')->user()->program_studi) }}";
        prodiByFakultas[fakultas].forEach(function(prodi) {
            const selected = prodi === selectedProdi ? 'selected' : '';
            prodiSelect.innerHTML += `<option value="${prodi}" ${selected}>${prodi}</option>`;
        });
    }
}
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('fakultas').addEventListener('change', updateProdiDropdown);
    updateProdiDropdown();
});
</script>
@endsection 