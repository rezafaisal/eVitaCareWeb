@extends('templates.app', [
    'title' => 'Manajemen Pasien',
    'titlePage' => 'Halaman Manajemen Data Pasien',
    'sectionTitle' => "Manajemen Pasien",
    'sectionSubTitle' => 'Memanajemen data-data keseluruhan Pasien'
])

@section('title')
    Detail Pasien
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>{{ $patient->name }}</h4>
            <a href="{{ route('patient.edit', ['id' => $patient->id]) }}" class="btn btn-icon icon-left btn-outline-secondary"><i
                class="fas fa-edit"></i> Edit</a>
        </div>
        <form action="#" method="POST">

            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-start">
                    <div class="font-weight-bold">
                        <div>ID pasien</div>
                        <div>Jenis kelamin</div>
                        <div>Tanggal lahir</div>
                        <div>NIK</div>
                        <div>No. BPJS</div>
                        <div>Email</div>
                        <div>No. telepon</div>
                        <div>Alamat</div>
                    </div>
                    <div class="col ml-2">
                        <div>{{ $patient->id }}</div>
                        <div>{{ $patient->dm_gender->gender }}</div>
                        <div>{{ $patient->birth_date }}</div>
                        <div>{{ $patient->nik }}</div>
                        <div>{{ $patient->bpjs_number }}</div>
                        <div>{{ $patient->email }}</div>
                        <div>{{ $patient->phone_number }}</div>
                        <div>{{ $patient->address }}</div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection