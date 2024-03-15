@extends('templates.app', [
    'title' => 'Manajemen Status',
    'titlePage' => 'Halaman Manajemen Data Status',
    'sectionTitle' => "Manajemen Status",
    'sectionSubTitle' => 'Memanajemen data-data keseluruhan status'
])

@section('page-header-actions')
  <a href="{{ route('status.create') }}" class="btn btn-primary">
    <i class="fas fa-plus mr-1"></i>
    Tambah Status
    </a>
@endsection

@section('title')
    Master
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
                    <h4 class="col">Data Status Pemantauan</h4>
                    <div class="col-3">
                        <a href="{{ route('status.create') }}" class="btn btn-primary float-right px-3">
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
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statuses as $index => $status)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $status->status }}</td>
                                        <td>{!! $status->description !!}</td>
                                        <td class="text-center">
                                            <a href="{{ route('status.edit', ['id' => $status->id]) }}" class="btn btn-primary">
                                                Edit
                                            </a>
                                            <a href="{{ route('status.delete', ['id' => $status->id]) }}" class="btn btn-danger btn-delete">
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

@section('js-extends')
    <script>
        const deleteButton = document.getElementsByClassName('btn-delete');
        for(var element of deleteButton){
            element.addEventListener('click', function(event){
                event.preventDefault();

                confirmAlert(
                    "Konfirmasi Hapus",
                    "Yakin ingin Menghapus Status?",
                    function(){
                        window.location = event.target.href;
                    }
                )
            });
        }
    </script>
@endsection