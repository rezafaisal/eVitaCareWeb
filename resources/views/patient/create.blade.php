@extends('templates.app', [
    'title' => 'Manajemen Pasien',
    'titlePage' => 'Halaman Manajemen Data Pasien',
    'sectionTitle' => "Manajemen Pasien",
    'sectionSubTitle' => 'Memanajemen data-data keseluruhan Pasien'
])

@section('title')
    Edit Pasien
@endsection

@section('content')
    @if(Session::has('error'))
        <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
    @endif
    <div class="card col-lg-7 col-md-7">
        <div class="card-header">
            <h4>Edit Pasien</h4>
        </div>
        <form action="{{ URLHelper::has('edit') ? route('patient.update', ['id' => $patient->id]) : '' }}" method="POST">
            @csrf
            @if(URLHelper::has('edit'))
                @method('PUT')
            @endif

            <div class="card-body">
                <div class="row">
                    <div class="col form-group">
                        <label>ID Pasien*</label>
                        <input type="text" class="form-control" value="{{ old('id') ?? $patient->id ?? '' }}" name="id">
                    </div>
                    <div class="col form-group">
                        <label>Nama Pasien*</label>
                        <input type="text" class="form-control" value="{{ old('name') ?? $patient->name ?? '' }}" name="name">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label>Jenis kelamin*</label>
                        <select class="form-control selectric">
                            @foreach ($genders as $gender)
                                <option @if($gender->id == ($patient->dm_gender_id ?? '')) selected @endif>
                                    {{ $gender->gender }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="birth_date">Tanggal lahir*</label>
                        <input id="birth_date" name="birth_date" type="date" class="form-control" value="{{ old('birth_date') ?? $patient->birth_date ?? '' }}" name="birth_date">
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <label>NIK*</label>
                        <input type="text" class="form-control" name="nik" value="{{ old('nik') ?? $patient->nik ?? '' }}">
                    </div>
                    <div class="col form-group">
                        <label>Nomor BPJS*</label>
                        <input type="text" class="form-control" name="bpjs_number" value="{{ old('bpjs_number') ?? $patient->bpjs_number ?? '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <label>Email*</label>
                        <input type="text" class="form-control" name="email" value="{{ old('email') ?? $patient->email ?? '' }}">
                    </div>
                    <div class="col form-group">
                        <label>Nomor telepon*</label>
                        <input type="text" class="form-control" name="" value="{{ old('phone_number') ?? $patient->phone_number ?? '' }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Alamat*</label>
                    <textarea class="form-control" id="address" name="address" rows="3">{{ old('address') ?? $patient->address ?? '' }}</textarea>
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