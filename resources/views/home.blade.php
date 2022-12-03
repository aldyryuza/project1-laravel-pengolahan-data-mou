@extends('layout.main')
@php
    $title = 'Dashboard';
@endphp
@section('content')
    <br>
    <div class="text-dark">
        <figure class="text-center">
            <blockquote class="blockquote">
                <h3>Pengolahan Data Dokumen MoU </h3>
                <p>Aplikasi Pengolahan Data Dokumen MoU berbentuk tabel</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                Selamat Mencoba <cite title="Source Title">Aplikasi Ini </cite>
            </figcaption>
        </figure>
        <br>
        <br>
        <br>
        <div class="text-center">
            <img src="img/Lambang-AK_15-juni-2017_edit.png">
        </div>
        <br><br><br><br><br>
        <figure class="text-center">
            <blockquote class="blockquote">
                <p>Developer this aplication's</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                By : <cite title="Source Title"> <a href="https://github.com/aldyryuza" target="blank">Agung Aldi
                        Prasetya</a></cite>
            </figcaption>
        </figure>
    </div>
    <br><br>
@endsection

@section('script')
    @if (session()->has('success'))
        <script>
            toastr.success(`{{ session('success') }}`);
        </script>
    @endif
@endsection
