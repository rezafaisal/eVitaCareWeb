@extends('templates.app', [
    'title' => 'Manajemen Status',
    'titlePage' => 'Halaman Manajemen Data Status',
    'sectionTitle' => "Manajemen Status",
    'sectionSubTitle' => 'Memanajemen data-data keseluruhan Status'
])

@section('content')
    @if(Session::has('error'))
        <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
    @endif
    <div class="card col-lg-7 col-md-7s">
        <div class="card-header">
            <h4>{{ URLHelper::has('edit') ? "Edit" : "Tambah" }} Status Pemantauan</h4>
        </div>
        <form action="{{ URLHelper::has('edit') ? route('status.update', ['id' => $status->id]) : route('status.store') }}" method="POST">
            @csrf
            @if(URLHelper::has('edit'))
                @method('PUT')
            @endif

            <div class="card-body">
                <div class="form-group">
                    <label>Nama status pemantauan*</label>
                    <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" placeholder="Masukkan Nama Status" value="{{ old('status') ?? $status->status ?? '' }}">
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Masukkan Deskripsi Status" value="{{ old('description') ?? $status->description ?? '' }}">
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