@extends('templates.app-auth')

@section('title')
    Mendaftar Akun
@endsection

@section('css-extends')
    <link rel="stylesheet" href="{{ asset('assets/node_modules/selectric/public/selectric.css') }}">
@endsection

@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="card card-primary">
                        <div class="card-header"><h4>Mendaftar Akun</h4></div>
                        <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
                        @endif
                        <form method="POST" action="{{ route('auth.registration') }}">
                            @csrf
                            <div class="form-divider">
                                Harap isikan alamat email yang aktif karena akan digunakan untuk login
                            </div>
                            <div class="form-group">
                                <label>Email*</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Password*</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Konfirmasi Password*</label>
                                    <input type="password" class="form-control @error('confirmation_password') is-invalid @enderror" name="confirmation_password">
                                    @error('confirmation_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <br>
                            <div class="form-divider">
                                Harap isikan alamat terbaru dan nomor telepon yang bisa dihubungi
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Nama lengkap*</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>NIK*</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}">
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Tanggal lahir*</label>
                                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}">
                                    @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Jenis kelamin*</label>
                                    <select class="form-control @error('gender_id') is-invalid @enderror" name="gender_id">
                                        <option value="" selected hidden>Pilih jenis kelamin</option> 
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}" @if(old('gender_id') == $gender->id) selected @endif>
                                                {{ $gender->gender }}
                                            </option> 
                                        @endforeach
                                    </select>
                                    @error('gender_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Nomor telepon*</label>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}">
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Nomor BPJS</label>
                                    <input type="text" class="form-control @error('bpjs_number') is-invalid @enderror" name="bpjs_number" value="{{ old('bpjs_number') }}">
                                    @error('bpjs_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat rumah*</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Daftar</button>
                            </div>
                            <div class="mt-4 text-center">
                                Sudah memiliki akun? <a href="{{ route('auth.login') }}">Login di sini</a>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection