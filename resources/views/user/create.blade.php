@extends('templates.app', [
    'title' => 'Manajemen Akun',
    'titlePage' => 'Halaman Manajemen Data Akun',
    'sectionTitle' => "Manajemen Akun",
    'sectionSubTitle' => 'Memanajemen data-data keseluruhan Akun'
])

@section('title')
    Tambah User
@endsection

@section('content')
    @if(Session::has('error'))
        <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
    @endif
    <div class="card col-lg-7 col-md-7">
        <div class="card-header">
            <h4>{{ URLHelper::has('edit') ? "Edit" : "Tambah" }} User</h4>
        </div>
        <form action="{{ URLHelper::has('edit') ? route('user.update', ['id' => $user->id]) : route('user.store') }}" method="POST">
            @csrf
            @if (URLHelper::has('edit'))
                @method('PUT')
            @endif

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
                <div class="form-group">
                    <label>Status*</label>
                    <select class="form-control" name="status">
                        @foreach ($user_statuses as $status)
                            <option value="{{ $status->id }}" @if($status->id == ($user->dm_user_status_id ?? '')) selected @endif>
                                {{ $status->status }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="d-block">Role*</label>
                    @foreach ($user_roles as $role)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="role-{{ $role->id }}" name="role-{{ $role->id }}" 
                            @if(in_array($role->id, isset($user) ? $user->user_role->pluck('dm_role_id')->toArray() : []))
                                checked
                            @endif>
                            <label class="form-check-label" for="role-{{ $role->id }}">
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary px-3">
                    <i class="fas fa-save mr-1"></i>
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection