@extends('templates.app-auth')

@section('title')
    Login
@endsection
    
@section('content')
    <section class="section">
    <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
        <div class="p-4 m-3">
            <img src="{{ asset('assets/img/evitacare-icon.png') }}" alt="logo" width="80" class="rounded-circle mb-5 mt-2">
            <h4 class="text-dark font-weight-bold">Login ke eVitaCare</h4>

            @if(Session::has('success'))
                <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
            @endif

            <form method="POST" action="{{ route('auth.verify') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <a href="#" class="float-left" tabindex="4" style="margin-top: 8px;  margin-bottom: 16px;">Lupa password?</a>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Login
                </button>
            </div>
            </form>

            <div class="mt-5 text-muted text-center">
            Belum punya akun? <a href="{{ route('auth.register') }}">Daftar di sini</a>
            </div>
        </div>
        </div>

        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
                data-background="../assets/img/evitacare-bg.jpg">
                <div class="absolute-bottom-left index-2">
                    <div class="text-white p-5 pb-2">
                        <div class="mb-5 pb-3">
                            <h1 class="mb-2 display-4 font-weight-bold">Selamat datang</h1>
                            <h5 class="font-weight-normal text-muted-transparent">di aplikasi web eVitaCare</h5>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </section>
@endsection