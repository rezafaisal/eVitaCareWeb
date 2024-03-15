@extends('templates.app', [
    'title' => 'Laporan',
    'titlePage' => 'Laporan',
    'sectionTitle' => "Laporan",
    'sectionSubTitle' => 'Laporan'
])

@section('title')
    Laporan
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <!-- count(home_care_patient) bulan ini -->
                <div class="d-flex justify-content-center col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-statistic-2">
                            <div class="card-stats">
                                <div class="card-stats-title">Jumlah pasien <i>home care</i></div>
                            </div>
                            <div class="card-icon shadow-primary bg-primary"><i class="fas fa-procedures"></i></div>
                            <div class="card-wrap">
                                <div class="card-body">{{ $home_care_patient_count }}</div>
                                <div class="card-header"><h4>Pasien <i>home care</i></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!--
                    count(home_care_patient) bulan ini
                    dalam pemantauan: home_care_patient(dm_monitoring_status(id) = 1)
                    selesai pemantauan: home_care_patient(dm_monitoring_status(id) = 2)
                -->
                <div class="d-flex justify-content-center col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title">Berdasarkan status pemantauan</div>
                        </div>
                        <div class="row text-center">
                            <div class="col-6"><div class="card-body">{{ $in_monitoring_count }}</div><div class="card-header"><h4>dalam<br>pemantauan</h4></div></div>
                            <div class="col-6"><div class="card-body">{{ $done_monitoring_count }}</div><div class="card-header"><h4>selesai<br>pemantauan</h4></div></div>
                        </div>
                    </div>
                </div>
        
                <!--
                    count(home_care_patient) bulan ini
                    laki-laki: home_care_patient(dm_gender(id) = 1)
                    perempuan: home_care_patient(dm_gender(id) = 2)
                -->
                <div class="d-flex justify-content-center col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title">Berdasarkan jenis kelamin</div>
                        </div>
                        <div class="row text-center">
                            <div class="col-6"><div class="card-body"><i class="fas fa-male"></i> {{ $male_count }}</div><div class="card-header"><h4>laki-laki</h4></div></div>
                            <div class="col-6"><div class="card-body"><i class="fas fa-female"></i> {{ $female_count }}</div><div class="card-header"><h4>perempuan</h4></div></div>
                        </div>
                    </div>
                </div>
            </div> 
            
            <div class="card">
                <div class="card-header"><h4>Statistik</h4></div>
                <div class="card-body">
                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                        <label>Pilih rentang waktu</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text"><i class="fas fa-calendar"></i></div></div>
                            <input type="text" class="form-control" id="daterange-cus">
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-8"><canvas id="chartJumlahPasienHomeCare"></canvas></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css-extends')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-timepicker/css/bootstrap-timepicker.css') }}">
@endsection

@section('js-extends')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"></script> 
    <script src="{{ asset('vendor/chart.js/dist/Chart.min.js') }}"></script>    
    <script>
        window.onload = function() {
            function setGraphicData(months, values){
                var ctx = document.getElementById("chartJumlahPasienHomeCare").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Jumlah pasien home care',
                            data: values,
                            borderWidth: 2,
                            backgroundColor: '#6777ef',
                            borderColor: '#6777ef',
                            borderWidth: 2.5,
                            pointBackgroundColor: '#ffffff',
                            pointRadius: 4
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    drawBorder: false,
                                    color: '#f2f2f2',
                                },
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: 10
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    display: true
                                },
                                gridLines: {
                                    display: false
                                }
                            }]
                        },
                    }
                });
            }

            setGraphicData([], []);

            $('#daterange-cus').daterangepicker({
                locale: {format: 'DD-MM-YYYY'},
                drops: 'down',
                opens: 'right'
            }, async function(start, end, label){
                start = start.format('YYYY-MM-DD');
                end = end.format('YYYY-MM-DD');

                const response = await fetch(
                    `${window.location.href}/graphic/${start}|${end}`,
                    { 
                        method: "GET", 
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }
                );
        
                var { months, values } = await response.json();
                setGraphicData(months, values);
            });
        }
    </script>
@endsection