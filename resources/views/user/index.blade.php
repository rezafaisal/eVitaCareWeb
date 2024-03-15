@extends('templates.app', [
    'title' => 'Manajemen Akun',
    'titlePage' => 'Halaman Manajemen Data Akun',
    'sectionTitle' => "Manajemen Akun",
    'sectionSubTitle' => 'Memanajemen data-data keseluruhan Akun'
])

@section('title')
    User
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>User</h1>
    </div>
    <div class="section-body">
        <div class="card">
            @if(Session::has('success'))
                <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
            @endif
            <div class="card-header">
                <h4>Data user</h4>
                <a href="{{ route('user.create') }}" class="btn btn-icon icon-left btn-success"><i class="fas fa-plus"></i> Tambah data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table-user">
                        <thead>
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor telepon</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 
                                user
                                - nip
                                - name
                                - email
                                - phone_number
                                - role diambil dari user_role(user_id)
                                - dm_user_status_id -> dm_user_status(status)
                                - created_at
                            -->
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->nip }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>
                                        @foreach ($user->user_role as $user_role)
                                            <div class="badge badge-light mb-2">{{ $user_role->dm_role->name }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="badge badge-success">{{ $user->dm_user_status->status }}</div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div><a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-icon btn-outline-secondary ml-2">
                                                <i class="fas fa-edit"></i></a>
                                            </div>
                                            <div><a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-icon btn-outline-danger ml-2">
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