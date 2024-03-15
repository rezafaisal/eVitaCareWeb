@extends('templates.app')

@section('title')
    Profile
@endsection

@section('content')
    <section class="section">
        <div class="section-header"><h1>Edit Profile</h1></div>
        <div class="section-body">
            @if (Session::has('success'))
            <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
            @endif
            <div class="card">
                <form action="{{ route('update-profile') }}" method="post">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col form-group">
                                <label>Nama*</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') ?? $user->name ?? '' }}">
                            </div>
                            <div class="col form-group">
                                <label>NIP*</label>
                                <input type="text" class="form-control" name="nip" value="{{ old('nip') ?? $user->nip ?? '' }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label>Nomor telepon</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('nip') ?? $user->nip ?? '' }}">
                            </div>
                            <div class="col form-group">
                                <label>Email*</label>
                                <input type="text" class="form-control" name="email" value="{{ old('email') ?? $user->email ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary px-3" type="submit">
                            <i class="fas fa-save mr-1"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection