@extends('templates.app')

@section('title')
    Pendaftaran
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pendaftaran</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-light" style="letter-spacing: 0.4px;">
                        Pastikan data Anda benar dan paling baru.<br>Jika ada data yang berubah, harap perbarui <a href="profil-pasien.html">di sini</a>.
                    </div>
                    <div>
                        <label class="form-divider text-primary">
                            <h6>Informasi pribadi</h6>
                        </label>

                        <div class="mb-2 d-flex flex-wrap justify-content-start">
                            <div class="font-weight-bold">
                                <div>Nama lengkap</div>
                                <div>Tanggal lahir</div>
                                <div>Jenis kelamin</div>
                                <div>NIK</div>
                                <div>Nomor BPJS</div>
                                <div>Alamat rumah</div>
                            </div>
                            <div class="col ml-2">
                                <div>{{ $user->name }}</div>
                                <div>{{ $user->birth_date }}</div>
                                <div>{{ $user->dm_gender->gender }}</div>
                                <div>{{ $user->nik }}</div>
                                <div>{{ $user->bpjs_number }}</div>
                                <div class="text-wrap">{{ $user->address }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="form-divider text-primary">
                            <h6>Kontak yang aktif dan bisa dihubungi</h6>
                        </label>
                        <div class="mb-2 d-flex flex-wrap justify-content-lg-start">
                            <div class="font-weight-bold">
                                <div>Email</div>
                                <div>Nomor telepon</div>
                            </div>
                            <div class="ml-2 col">
                                <div>{{ $user->email }}</div>
                                <div>{{ $user->phone_number }}</div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('home_care_register.registration') }}" method="POST">
                        @csrf
                        <div class="form-group mt-4">
                            <label class="form-divider text-primary"><h6>Dokter yang telah menyarankan program home care</h6></label>
                            <select class="form-control select2 category-select @error('doctor_id') is-invalid @enderror" name="doctor_id">
                                <option value="" selected hidden>Pilih dokter</option>
                                @foreach ($doctors as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('doctor_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
        
                        <button type="submit" class="btn btn-primary float-right">
                            Daftar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection