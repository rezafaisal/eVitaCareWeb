@extends('templates.app', [
    'title' => 'Manajemen Jenis Kelamin',
    'titlePage' => 'Halaman Manajemen Data Jenis Kelamin',
    'sectionTitle' => "Manajemen Jenis Kelamin",
    'sectionSubTitle' => 'Memanajemen data-data keseluruhan jenis kelamin'
])

@section('content')
    @if(Session::has('error'))
        <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
    @endif
    <div class="card col-lg-7 col-md-7">
        <div class="card-header">
            <h4>{{ URLHelper::has('edit') ? "Edit" : "Tambah" }} Jenis Kelamin</h4>
        </div>
        <form action="{{ URLHelper::has('edit') ? route('gender.update', ['id' => $gender->id]) : route('gender.store') }}" method="POST">
            @csrf
            @if(URLHelper::has('edit'))
                @method('PUT')
            @endif

            <div class="card-body">
                <div class="form-group ">
                    <label>Kode jenis kelamin*</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" placeholder="Masukkan Kode Jenis Kelamin" value="{{ old('id') ?? $gender->id ?? '' }}">
                    @error('id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama jenis kelamin*</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Nama Jenis Kelamin" value="{{ old('name') ?? $gender->gender ?? '' }}">
                    @error('name')
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