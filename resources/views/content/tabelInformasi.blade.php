@extends('layout.main')
@php
$title = 'Tabel Informasi';
@endphp
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="table-responsive">
        <h3 class="my-4">Data MoU</h3>
        <p class="font-weight-light">Data seluruh MoU Kampus</p>
        <button class="btn btn-outline-success btn-sm mx-sm-2 float-right tambah-informasi" data-toggle="modal"
            data-target="#tambah-informasi">Tambah <i class="fas fa-plus"></i></button>
        <table id="data-mou" class="table table-hover ">
            <thead>
                <tr>
                    <th scope="col">No</th>
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
                        <td>{{ $r->tahun }}</td>
                        <td><a href="doc/{{ $r->file_pdf }}" target="blank">{{ $r->judul_mou }}</a></td>
                        <td>{{ $r->bidang_kerjasama }}</td>
                        {{-- <td>1 Tahun</td> --}}
                        <td>{{ Carbon\Carbon::parse($r->tgl_mulai)->isoFormat('D MMMM Y') }}</td>
                        <td>{{ Carbon\Carbon::parse($r->tgl_selesai)->isoFormat('D MMMM Y') }}</td>
                        <td>
                            <span
                                class=" {{ $r->status === 'Aktif' ? 'badge-success' : 'badge-danger' }} badge-pill">{{ $r->status }}</span>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>

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
                            <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Cnth: 2002"
                                required>
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




    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

    {{-- Datatable --}}
    <script>
        $(document).ready(function() {
            $('#data-mou').DataTable();
        });

        // $(document).ready(function() {
        //     $('#panen').DataTable();
        // });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('.tambah-informasi').on('click', function() {
                bootbox.confirm({
                    size: "large",
                    title: "Tambah Informasi",
                    message: `<form action="">
                                    <div class="form-group row">
                                        <label for="dengansiapa" class="col-sm-2 col-form-label">Dengan Siapa: </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="dengansiapa" required
                                                placeholder="Cnth: Akademi Komunitas Negeri Pacitan....">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tentangapa" class="col-sm-2 col-form-label">Tentang Apa : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="tentangapa" placeholder="Cnth: memabngun Indonesia Maju..." required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mulaitgl" class="col-sm-2 col-form-label">Mulai Tanggal :</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="mulaitgl">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sampaitgl" class="col-sm-2 col-form-label">Sampai Tanggal :</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="sampaitgl">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="filepdf" class="col-sm-2 col-form-label">Upload File PDF :</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="mt-1" id="filepdf">
                                        </div>
                                    </div>

                    </form>`,
                    buttons: {
                        cancel: {
                            label: '<i class="fa fa-times"></i> Cancel'
                        },
                        confirm: {
                            label: '<i class="fa fa-check"></i> Confirm'
                        }
                    },
                    callback: function(result) {
                        console.log('This was logged in the callback: ' + result);
                    }
                });
            });



        });
    </script> --}}
@endsection
