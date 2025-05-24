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
                        <button type="submit" class="btn btn-danger w-100">Ganti Password</button>
                    </form>
                </div>
            </div>
            <div class="alert alert-warning mt-3">Anda wajib mengganti password sebelum dapat menggunakan sistem.</div>
        </div>
    </div>
</div>
@endsection 