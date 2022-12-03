@extends('layout.main')
@php
    $title = 'Login';
@endphp
@section('content')
    <main class="form-signin">
        <form action="/login" method="POST">
            @csrf
            <h1 class="h3 mb-5 fw-normal text-center">Please sign in</h1>
            <center><img class="mb-4" src="{{ asset('img/login.svg') }}" alt="" width="100%" height="80">
            </center>

            <div class="form-floating">
                <label for="floatingInput">Email address</label>

                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                    name="email" placeholder="name@example.com" value="{{ old('email') }}" autofocus required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <label for="floatingPassword">Password</label>
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password"
                    required>
            </div>

            <div class="checkbox mb-3">

            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

        </form>
        <div class="text-center">
            <p class="my-3">admin@admin.com</p>
            <p>admin</p>
        </div>
    </main>
@endsection

@section('script')
    @if (session()->has('loginErorr'))
        <script>
            toastr.error(`{{ session('loginErorr') }}`);
        </script>
    @endif
@endsection
