@extends('templates.app', [
    'title' => 'Manajemen Pasien',
    'titlePage' => 'Halaman Manajemen Data Pasien',
    'sectionTitle' => "Manajemen Pasien",
    'sectionSubTitle' => 'Memanajemen data-data keseluruhan Pasien'
])

@section('title')
    Pasien
@endsection

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
    @elseif(Session::has('error'))
        <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
    @endif
    <section class="section">
        <div class="section-header">
            <h1>Pasien</h1>
        </div>
        <div class="section-body">          
            <div class="card">
                <div class="card-header">
                    <h4>Data pasien</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered w-100" id="datatable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 15px">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Nomor Telepon</th>
                                    <th class="text-center">Tanggal Lahir</th>
                                    <th class="text-center">Nomor BPJS</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $index => $value)
                                    <tr>
                                        <td class="text-center align-middle">{{ $index + 1 }}</td>
                                        <td class="align-middle">{{ $value->name }}</td>
                                        <td class="align-middle">{{ $value->dm_gender->gender }}</td>
                                        <td class="align-middle">{{ $value->email }}</td>
                                        <td class="align-middle">{{ $value->phone_number }}</td>
                                        <td class="align-middle">{{ $value->birth_date }}</td>
                                        <td class="align-middle">{{ $value->bpjs_number }}</td>
                                        <td class="align-middle">{{ $value->address }}</td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex">
                                                <div><a href="{{ route('patient.detail', ['id' => $value->id]) }}" class="btn btn-icon btn-outline-primary">
                                                    <i class="fas fa-info"></i></a>
                                                </div>
                                                <div><a href="{{ route('patient.edit', ['id' => $value->id]) }}" class="btn btn-icon btn-outline-secondary ml-2">
                                                    <i class="fas fa-edit"></i></a>
                                                </div>
                                                <div><a href="{{ route('patient.delete', ['id' => $value->id]) }}" class="btn btn-icon btn-outline-danger ml-2">
                                                    <i class="fas fa-trash"></i></a>
                                                </div>                                        
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection