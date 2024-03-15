@extends('templates.app', [
    'title' => 'Manajemen Role',
    'titlePage' => 'Halaman Manajemen Data Role',
    'sectionTitle' => "Manajemen Role",
    'sectionSubTitle' => 'Memanajemen data-data keseluruhan Role'
])

@section('content')
    @if(Session::has('error'))
        <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
    @endif
    <div class="card col-lg-7 col-md-7">
        <div class="card-header">
            <h4>{{ URLHelper::has('edit') ? "Edit" : "Tambah" }} Role</h4>
        </div>
        <form action="{{ URLHelper::has('edit') ? route('roles.update', ['id' => $role->id]) : route('roles.store') }}" method="POST">
            @csrf
            @if(URLHelper::has('edit'))
                @method('PUT')
            @endif

            <div class="card-body">
                    <div class="form-group">
                        <label>Nama role*</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Role" value="{{ old('name') ?? $role->name ?? '' }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Masukkan Deskripsi Role" value="{{ old('description') ?? $role->description ?? '' }}">
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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