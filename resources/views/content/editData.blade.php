@extends('layout.main')
@php
    $title = 'Edit - Informasi';
@endphp

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Edit Data Memorandum of Understanding</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="/update-informasi" enctype="multipart/form-data">
                @foreach ($dataMou as $r)
                    {{-- {{ csrf_field() }} --}}
                    @csrf
                    {{--  --}}

                    <div class="form-group">
                        <label for="tahun" class="col-form-label">Tahun: </label>
                        <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Cnth: 2002"
                            value="{{ $r->tahun }}" required>
                        <input type="hidden" class="form-control" id="id" name="id" placeholder="...."
                            value="{{ $r->id }}">
                    </div>
                    <div class="form-group">
                        <label for="dengansiapa" class="col-form-label">Bidang Kerjasama: </label>
                        <input type="text" class="form-control" id="dengansiapa" name="bidang_kerjasama"
                            value="{{ $r->bidang_kerjasama }}" placeholder="Cnth: Akademi Komunitas Negeri Pacitan...."
                            required>
                    </div>
                    <div class="form-group">
                        <label for="tentangapa" class="col-form-label">Judul MoU: </label>
                        <input type="text" class="form-control" id="tentangapa" name="judul_mou"
                            placeholder="Cnth: memabngun Indonesia Maju..." value="{{ $r->judul_mou }}" required>
                    </div>
                    <div class="form-group">
                        <label for="mulaitgl" class="col-form-label">Mulai Tanggal :</label>
                        <input type="date" class="form-control" id="mulaitgl" name="tgl_mulai"
                            value="{{ $r->tgl_mulai }}">
                    </div>
                    <div class="form-group">
                        <label for="sampaitgl" class="col-form-label">Sampai Tanggal :</label>
                        <input type="date" class="form-control" id="sampaitgl" name="tgl_selesai"
                            value="{{ $r->tgl_selesai }}">
                    </div>
                    <div class="form-group ">
                        <input type="hidden" class="form-control" id="status" name="status" value="Aktif">
                    </div>
                    <div class="form-group">
                        <label for="file" class="col-form-label"><b>File</b> : {{ $r->file_pdf }}</label>
                        <br>
                        <label for="filepdf" class="col-form-label">Upload File PDF :</label>
                        <input type="file" class="mt-1" name="file_pdf" id="filepdf" value="{{ $r->file_pdf }}">
                        <input type="hidden" class="mt-1" name="file_lama" id="filelama" value="{{ $r->file_pdf }}">
                    </div>
                    <div class="float-right">
                        <a href="/tabel-informasi" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                @endforeach
            </form>
        </div>
    </div>
    <br>
@endsection
