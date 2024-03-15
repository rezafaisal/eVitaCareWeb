@extends('templates.app')

@section('title')
    Pasien Home Care
@endsection

@section('content')
    <section class="section">
        <div class="section-header"><h1>Pasien Home Care</h1></div>
        <div class="section-body">
            @if (Session::has('success'))
                <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger mb-2">{{ Session::get('error') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="order-table">
                            <thead>
                                <tr>
                                    
                                </tr>
                                <tr>
                                    <th class="text-center alig-middle" rowspan="2">No.</th>
                                    <th class="text-center alig-middle" rowspan="2">Nama</th>
                                    <th class="text-center alig-middle" rowspan="2">Jenis Kelamin</th>
                                    <th class="text-center alig-middle" rowspan="2">Usia</th>
                                    <th class="text-center alig-middle" colspan="3">Tanggal</th>
                                    <th class="text-center alig-middle" rowspan="2">Status Pemantauan</th>
                                    <th class="text-center alig-middle" rowspan="2">DPJP</th>
                                    <th class="text-center alig-middle" rowspan="2" style="width: 250px">Aksi</th>
                                </tr>
                                <tr>
                                    <th class="text-center alig-middle">Pendaftaran</th>
                                    <th class="text-center alig-middle">Mulai</th>
                                    <th class="text-center alig-middle">Selesai</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th id="no">No.</th>
                                    <th id="name">Nama</th>
                                    <th>
                                        <div class="form-group mb-0" style="width: 100%">
                                            <select class="form-control select2 category-select" name="gender" id="gender-form">
                                                <option value="SEMUA">Semua</option>
                                                @foreach ($genders as $gender)
                                                    <option value="{{ $gender->id }}">
                                                        {{ $gender->gender }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th id="age">Usia</th>
                                    <th id="registration_date">Tanggal Pendaftaran</th>
                                    <th id="begin_date">Tanggal Mulai</th>
                                    <th id="final_date">Tanggal Selesai</th>
                                    <th>
                                        <div class="form-group mb-0" style="width: 100%">
                                            <select class="form-control select2 category-select" name="status" id="status-form">
                                                <option value="SEMUA">Semua</option>
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status->id }}">
                                                        {{ $status->status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th id="dpjp">DPJP</th>
                                    <th id="action">Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modal-extends')
    <div class="modal fade" tabindex="-1" role="dialog" id="status-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ganti status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close-status">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-0" style="width: 100%">
                        <select class="form-control select2 category-select" id="status-change-form">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">
                                    {{ $status->status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-status-form-submit">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="dpjp-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ganti DPJP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close-dpjp">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-0" style="width: 100%">
                        <select class="form-control select2 category-select" id="dpjp-change-form">
                            @foreach ($dpjp as $data)
                                <option value="{{ $data->id }}">
                                    {{ $data->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn-dpjp-form-submit">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-extends')
    <script src="{{ asset('js/home_care_patient.js') }}"></script>
@endsection