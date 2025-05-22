@extends('mahasiswa.layout')
@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Template Laporan</h3>
    <div class="card shadow">
        <div class="card-body">
            @if($templates->count() > 0)
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Dokumen</th>
                        <th class="text-center">Link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($templates as $i => $tpl)
                    <tr>
                        <td class="text-center">{{ $i+1 }}</td>
                        <td class="text-center">{{ $tpl->nama_dokumen }}</td>
                        <td class="text-center"><a href="{{ $tpl->template_dokumen }}" target="_blank" class="btn btn-primary btn-sm">Lihat/Download</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-info">Belum ada template laporan.</div>
            @endif
        </div>
    </div>
</div>
@endsection 