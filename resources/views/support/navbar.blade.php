@php
$date = date('D, d M Y');
@endphp
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Data MOU</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item  {{ Request::is('/') ? 'active' : '' }}">
                <a href="{{ url('/') }}" class="nav-link px-2 link-dark  ">Dashboard</a>
            </li>
            @auth
                <li class="nav-item {{ Request::is('tabel-informasi') ? 'active' : '' }}">
                    <a href="{{ url('/tabel-informasi') }}" class="nav-link px-2 link-dark ">Tabel
                        Informasi MoU</a>
                </li>
            @endauth



        </ul>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#"> {{ $date }}</a>
            </li>

        </ul>
        @auth



            <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i> {{ auth()->user()->name }}
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="https://github.com/aldyryuza">Profil</a>

                    <form action="/logout" method="post">
                        @csrf

                        <button type="submit" class=" dropdown-item btn btn-outline-danger me-2"><i
                                class="fas fa-sign-out"></i>
                            Logout</button>
                    </form>

                </div>
            </div>
        @else
            <a class="btn btn-primary btn-sm me-2" href="{{ url('/login') }}"><i class="fas fa-sign-in"></i> Login</a>
        @endauth
    </div>
</nav>
