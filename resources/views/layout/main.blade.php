<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ asset('img/Lambang-AK_15-juni-2017_edit.png') }}">

    {{-- JS --}}
    <script src="{{ asset('js/Jquery.3.6.js') }}"></script>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    {{-- Font Awesome --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <script src="https://kit.fontawesome.com/a7f0d4dd4e.js" crossorigin="anonymous"></script>

    {{-- Bootbox.js --}}
    <script src="{{ asset('bootbox/bootbox.min.js') }}"></script>
    <script src="{{ asset('bootbox/bootbox.locales.min.js') }}"></script>

    {{-- CSS Datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <title>{{ $title }}</title>
</head>

<body>

    @include('support.navbar')
    <div class="container mt-5">
        @yield('content')
    </div>

</body>

</html>
