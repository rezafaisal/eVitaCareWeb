@extends('templates.app', [
    'title' => 'Manajemen Jenis Kelamin',
    'titlePage' => 'Halaman Manajemen Data Jenis Kelamin',
    'sectionTitle' => "Manajemen Jenis Kelamin",
    'sectionSubTitle' => 'Memanajemen data-data keseluruhan jenis kelamin'
])

@section('title')
    Master
@endsection

@section('page-header-actions')
  <a href="{{ route('gender.create') }}" class="btn btn-primary">
    <i class="fas fa-plus mr-1"></i>
    Tambah Jenis Kelamin
  </a>
@endsection

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
    @elseif(Session::has('error'))
        <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
    @endif
    <section class="section">
        <div class="section-header">
            <h1>Master</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header row">
                    <h4 class="col">Data Jenis Kelamin</h4>
                    <div class="col-3">
                        <a href="{{ route('gender.create') }}" class="btn btn-primary float-right px-3">
                            <i class="fas fa-plus mr-1"></i>
                            Tambah data
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered w-100" id="datatable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 15px">No</th>
                                    <th>Nama</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($genders as $index => $gender)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $gender->gender }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('gender.edit', ['id' => $gender->id]) }}" class="btn btn-primary">
                                                Edit
                                            </a>
                                            <a href="{{ route('gender.delete', ['id' => $gender->id]) }}" class="btn btn-danger btn-delete">
                                                Hapus
                                            </a>
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