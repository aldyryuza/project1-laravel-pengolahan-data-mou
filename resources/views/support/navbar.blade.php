<header
    class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    {{-- <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
            <use xlink:href="#bootstrap"></use>
        </svg>
    </a> --}}
    <a class="navbar-brand col-md-3  " href="{{ url('/') }}">
        <img src="img/logo.png" width="100">

    </a>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{ url('/') }}"
                class="nav-link px-2 link-dark  {{ Request::is('/') ? 'text-dark' : '' }}">Dashboard</a></li>
        {{-- unutk membatasi user --}}
        @auth
            <li><a href="{{ url('/tabel-informasi') }}"
                    class="nav-link px-2 link-dark {{ Request::is('tabel-informasi') ? 'text-dark' : '' }}">Tabel
                    Informasi</a></li>
        @endauth

    </ul>

    @auth
        <div class="col-md-3 text-end">
            {{-- <button type="button" class="btn btn-outline-primary me-2"> <i class="fas fa-sign-in"></i> Login</button> --}}

            {{-- <button type="button" class="btn btn-primary">Sign-up</button> --}}
            <div class="dropdown">
                <button class="btn btn-outline-secondary-sm dropdown-toggle" type="button" id="dropdownMenu2"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    {{ auth()->user()->name }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                    <form action="/logout" method="post">
                        @csrf

                        <button type="submit" class=" dropdown-item btn btn-outline-danger me-2"><i
                                class="fas fa-sign-out"></i>
                            Logout</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-3 text-end">
            {{-- <button type="button" class="btn btn-outline-primary me-2"> <i class="fas fa-sign-in"></i> Login</button> --}}
            <a class="btn btn-primary me-2" href="{{ url('/login') }}"><i class="fas fa-sign-in"></i> Login</a>
            {{-- <button type="button" class="btn btn-primary">Sign-up</button> --}}
        </div>
    @endauth
</header>
