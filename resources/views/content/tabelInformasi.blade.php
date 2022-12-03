@extends('layout.main')
@php
    $title = 'Tabel Informasi';
@endphp
@section('content')
    <div class="table-responsive">
        <div class="card">
            <div class="card-header">
                <h4 class="my-4">Tabel Data Keseluruhan
                    <button class="btn btn-success btn-sm mx-sm-2 float-right tambah-informasi" data-toggle="modal"
                        data-target="#tambah-informasi">Tambah <i class="fas fa-plus"></i>
                    </button>
                </h4>


            </div>
            <div class="card-body">
                <p class="font-weight-light">List Data Tabel Memorandum of Understanding</p>
                <table id="data-mou" class="table table-hover table-responsive-md table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Opsi</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Judul MoU</th>
                            <th scope="col">Bidang Kerjasama</th>
                            {{-- <th scope="col">Masa Berlaku</th> --}}
                            <th scope="col">Tanggal Mulai</th>
                            <th scope="col">Tanggal Selesai</th>
                            <th scope="col">Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            
                            $date = date('Y-m-d');
                        @endphp
                        @foreach ($dataMou as $r)
                            @php
                                
                                if ($r->status != 'Expired') {
                                    if ($date > $r->tgl_selesai) {
                                        DB::table('data_mous')
                                            ->where('id', $r->id)
                                            ->update([
                                                'status' => 'Expired',
                                            ]);
                                
                                        $r->status = 'Expired';
                                    }
                                }
                            @endphp

                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    <a href="data-edit/{{ $r->id }}"class="btn btn-warning btn-sm">Edit</a>

                                    <form action="/hapus-informasi/{{ $r->id }}" method="post" class="d-inline"
                                        onsubmit="return confirm('Apakah Anda Yakin Mengahus Data Ini ?')">
                                        @method('delete')
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $r->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                                <td>{{ $r->tahun }}</td>
                                <td><a href="doc/{{ $r->file_pdf }}" target="blank">{{ $r->judul_mou }}</a></td>
                                <td>{{ $r->bidang_kerjasama }}</td>
                                <td>{{ Carbon\Carbon::parse($r->tgl_mulai)->isoFormat('D MMMM Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($r->tgl_selesai)->isoFormat('D MMMM Y') }}</td>
                                <td>
                                    <span
                                        class=" {{ $r->status === 'Aktif' ? 'badge-success' : 'badge-danger' }} badge-pill">{{ $r->status }}
                                    </span>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambah-informasi" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Informasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/tambah-informasi" enctype="multipart/form-data">

                        {{-- {{ csrf_field() }} --}}
                        @csrf
                        {{--  --}}

                        <div class="form-group">
                            <label for="tahun" class="col-form-label">Tahun: </label>
                            <input type="number" class="form-control" id="tahun" name="tahun"
                                placeholder="Cnth: 2002" required>
                        </div>
                        <div class="form-group">
                            <label for="dengansiapa" class="col-form-label">Bidang Kerjasama: </label>
                            <input type="text" class="form-control" id="dengansiapa" name="bidang_kerjasama" required
                                placeholder="Cnth: Akademi Komunitas Negeri Pacitan....">
                        </div>
                        <div class="form-group">
                            <label for="tentangapa" class="col-form-label">Judul MoU: </label>
                            <input type="text" class="form-control" id="tentangapa" name="judul_mou"
                                placeholder="Cnth: memabngun Indonesia Maju..." required>
                        </div>
                        <div class="form-group">
                            <label for="mulaitgl" class="col-form-label">Mulai Tanggal :</label>
                            <input type="date" class="form-control" id="mulaitgl" name="tgl_mulai">
                        </div>
                        <div class="form-group">
                            <label for="sampaitgl" class="col-form-label">Sampai Tanggal :</label>
                            <input type="date" class="form-control" id="sampaitgl" name="tgl_selesai">
                        </div>
                        <div class="form-group ">
                            <input type="hidden" class="form-control" id="status" name="status" value="Aktif">
                        </div>
                        <div class="form-group">
                            <label for="filepdf" class="col-form-label">Upload File PDF :</label>
                            <input type="file" class="mt-1" name="file_pdf" id="filepdf">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>








@section('script')
    {{-- Datatable --}}
    <script>
        $(document).ready(function() {
            $('#data-mou').DataTable();
        });
    </script>
    @if (session()->has('success'))
        <script>
            toastr.success(`{{ session('success') }}`);
        </script>
    @endif
    @if (count($errors) > 0)
        <script>
            toastr.error(`{{ $errors->first() }}`);
        </script>
    @endif
@endsection
@endsection
