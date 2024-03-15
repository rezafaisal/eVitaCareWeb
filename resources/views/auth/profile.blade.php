@extends('templates.app')

@section('title')
    Profil
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Profil</h1>
    </div>
    <div class="section-body">
        @if (Session::has('success'))
            <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
        @endif
        <ul class="nav nav-tabs" id="tabsProfil" role="tablist">
            <li class="nav-item">
                <a class="nav-link ml-4 {{ Session::has('is_change_password') ? '' : 'active' }}" id="detailProfilTab" data-toggle="tab" href="#detailProfilContent"
                    role="tab" aria-controls="detail-profil" aria-selected="true">Detail Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Session::has('is_change_password') ? 'active' : '' }}" id="ubahPasswordTab" data-toggle="tab" href="#ubahPasswordContent" role="tab"
                    aria-controls="ubah-password" aria-selected="false">Ubah Password</a>
            </li>
        </ul>
        <div class="tab-content tab-bordered" id="tabPaneProfil">
            <div class="tab-pane fade {{ Session::has('is_change_password') ? '' : 'show active' }}" id="detailProfilContent" role="tabpanel"
                aria-labelledby="ubahPasswordTab">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="text-primary">{{ Auth::user()->name }}</h6>
                    <a href="{{ route('edit-profile') }}" class="btn btn-icon icon-left btn-outline-secondary"><i
                            class="fas fa-edit"></i> Edit</a>
                </div>
                <div class="d-flex flex-wrap justify-content-start">
                    <div class="font-weight-bold">
                        <div>NIP</div>
                        <div>Role</div>
                        <div>Email</div>
                        <div>No. telepon</div>
                    </div>
                    <div class="col ml-2">
                        <div>{{ Auth::user()->nip }}</div>
                        <div>
                            @foreach (Auth::user()->user_role as $user_role)
                                {{ $user_role->dm_role->name }},
                            @endforeach
                        </div>
                        <div>{{ Auth::user()->email }}</div>
                        <div>{{ Auth::user()->phone_number }}</div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade {{ Session::has('is_change_password') ? 'show active' : '' }}" id="ubahPasswordContent" role="tabpanel" aria-labelledby="ubahPasswordTab">
                <form method="POST" class="col-lg-6" action="{{ route('update-password') }}">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="old_password">Password lama*</label>
                        <input id="old_password" name="old_password" type="password" class="form-control" tabindex="1">
                    </div>

                    <div class="form-group">
                        <label for="new_password">Password baru*</label>
                        <input id="new_password" name="new_password" type="password" class="form-control" tabindex="2">
                    </div>

                    <div class="form-group">
                        <label for="c_password">Ketik ulang password baru*</label>
                        <input id="c_password" name="c_password" type="password" class="form-control" tabindex="2">
                    </div>

                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-lg" tabindex="4">
                            Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection