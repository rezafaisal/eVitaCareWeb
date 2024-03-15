@extends('templates.app')

@section('meta-extends')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    Detail Pasien Home Care
@endsection

@section('content')
<section class="section">
    <div class="section-body">
        <div class="card mb-3">
            <div class="card-header">
                <h4>{{ $home_care_patient->patient->name }}</h4>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex flex-wrap justify-content-start">
                            <div class="font-weight-bold">
                                <div>ID Pasien</div>
                                <div>NIK</div>
                                <div>Tanggal lahir</div>
                                <div>Jenis kelamin</div>
                            </div>
                            <div class="col ml-2">
                                <div>{{ $home_care_patient->patient->id }}</div>
                                <div>{{ $home_care_patient->patient->nik }}</div>
                                <div>{{ $home_care_patient->patient->birth_date }}</div>
                                <div>{{ $home_care_patient->patient->dm_gender->gender }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex flex-wrap justify-content-start">
                            <div class="font-weight-bold">
                                <div>Email</div>
                                <div>Nomor telepon</div>
                                <div>Nomor BPJS</div>
                                <div>Alamat</div>
                            </div>
                            <div class="col ml-2">
                                <div>{{ $home_care_patient->patient->email }}</div>
                                <div>{{ $home_care_patient->patient->phone_number }}</div>
                                <div>{{ $home_care_patient->patient->bpjs_number }}</div>
                                <div class="text-wrap">
                                    {{ $home_care_patient->patient->address }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-light" style="letter-spacing: 0.4px;">
            Skor NEWS pasien beresiko rendah sehingga frekuensi pengukuran vital sign setiap 6 jam sekali
        </div>

        <ul class="nav nav-tabs" id="tabsDetailPasienHomeCare" role="tablist">
            <li class="nav-item">
                <a class="nav-link ml-4 active" id="dataTerkiniTab" data-toggle="tab" href="#dataTerkiniContent" role="tab" aria-controls="data-terkini" aria-selected="true">Data Terkini</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="dataHistorisTab" data-toggle="tab" href="#dataHistorisContent" role="tab" aria-controls="data-historis" aria-selected="false">Data Historis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="konsultasiTab" data-toggle="tab" href="#konsultasiContent" role="tab" aria-controls="konsultasi" aria-selected="false">Konsultasi</a>
            </li>
        </ul>
        <div class="tab-content tab-bordered" id="tabPaneDetailPasienHomeCare">
            <div class="tab-pane fade show active" id="dataTerkiniContent" role="tabpanel" aria-labelledby="dataTerkiniTab">
                <div class="col-lg-7">
                    @php
                        $vital_sign = $home_care_patient->vital_sign->sortByDesc('time_acquired')->first();
                    @endphp
                    <h6>Terakhir diperbarui: {{ $vital_sign->time_acquired }}</h6>
                    <div class="card-patient" style="margin-bottom: 24px;">
                        <div class="card-header">
                            <div class="name">{{ $home_care_patient->patient->name }}</div> <!-- home_care_patient(patient_id) -> patient(name) -->
                            <div class="detail">
                                <div class="news-score">
                                    <!-- 
                                    vital_sign(home_care_patient_id) time_acquired terbaru
                                    
                                    vital_sign(news_score)
                                    news_score 0   = -- (tidak ada resiko) -> btn-secondary
                                    news_score 1-4 = Low  -> btn-success
                                    news_score 5-6 = Medium -> btn-warning
                                    news_score >=7 = High -> btn-danger
                                    -->
                                    
                                    <div class="btn
                                        @if($vital_sign->news_score == 0)
                                            btn-secondary
                                        @elseif ($vital_sign->news_score >= 1 && $vital_sign->news_score <= 4)
                                            btn-success
                                        @elseif ($vital_sign->news_score >= 5 && $vital_sign->news_score <= 6)
                                            btn-warning
                                        @elseif ($vital_sign->news_score >= 7)
                                            btn-danger
                                        @endif
                                    ">

                                    <span>{{ $vital_sign->news_score }}</span>
                                        @if($vital_sign->news_score == 0)
                                            (No risk)
                                        @elseif ($vital_sign->news_score >= 1 && $vital_sign->news_score <= 4)
                                            (Low)
                                        @elseif ($vital_sign->news_score >= 5 && $vital_sign->news_score <= 6)
                                            (Medium)
                                        @elseif ($vital_sign->news_score >= 7)
                                            (High)
                                        @endif
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- vital_sign(home_care_patient_id) time_acquired terbaru  -->
                            <div class="heart-rate mt-2">
                            <span>HR</span>
                            <div class="values">
                                <span class="value">{{ $vital_sign->heart_rate }}</span> <!-- heart_rate -->
                                <span class="unit">bpm</span>
                            </div>
                            </div>
                            <div class="respiratory-rate ml-2 mt-2">
                            <span>RR</span>
                            <div class="values">
                                <span class="value">{{ $vital_sign->respiratory_rate }}</span> <!-- respiratory_rate -->
                                <span class="unit">rpm</span>
                            </div>
                            </div>
                            <div class="oxygen-saturation ml-2 mt-2">
                            <span>SpO&#8322</span>
                            <div class="values">
                                <span class="value">{{ $vital_sign->oxygen_saturation }}</span> <!-- oxygen_saturation -->
                                <span class="unit">%</span>
                            </div>
                            </div>
                            <div class="temperature ml-2 mt-2">
                            <span>Temp.</span>
                            <div class="values">
                                <span class="value">{{ $vital_sign->temperature }}</span> <!-- temperature -->
                                <span class="unit">&deg;C</span>
                            </div>
                            </div>
                            <div class="blood-pressure ml-2 mt-2">
                            <span>BP</span>
                            <div class="values">
                                <span class="value">{{ $vital_sign->systolic_blood_pressure }}/{{ $vital_sign->diastolic_blood_pressure }}</span> <!-- blood_pressure -->
                                <span class="unit">mmHg</span>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <div class="card-patient">
                            <div class="card-header-2">
                                <div class="name">Level of Consciousness</div>
                            </div>
                            <div class="card-body-2">
                                <div class="values">
                                <span class="value text-white">{{ $vital_sign->dm_level_of_consciousness->consciousness }}</span> <!-- dm_level_of_consciousness_id _> dm_level_of_consciousness(consciousness) -->
                                </div>
                            </div>
                        </div>
        
                        <div class="card-patient ml-4">
                            <div class="card-header-2">
                                <div class="name">Additional Oxygen</div> <!-- additional_oxygen -->
                            </div>
                            <div class="card-body-2">
                                <div class="values">
                                <span class="value text-white">{{ $vital_sign->additional_oxygen ? "Yes" : "No" }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="dataHistorisContent" role="tabpanel" aria-labelledby="dataHistorisTab">
                <div class="table-responsive">
                    <table class="table" id="table-vital-sign">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>RR</th>
                                <th>SpO&#8322</th>
                                <th>Temp.</th>
                                <th>BP</th>
                                <th>HR</th>
                                <th>Additional Oxygen</th>
                                <th>Level of Consciousness</th>
                                <th>NEWS Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 
                                home_care_patient(id) -> vital_sign(home_care_patient_id)
                                vital_sign
                                - time_acquired (date)
                                - time_acquired (time)
                                - respiratory_rate
                                - oxygen_saturation
                                - temperature
                                - blood_pressure
                                - heart_rate
                                - additional_oxygen
                                - dm_level_of_consciousness_id -> dm_level_of_consciousness(consciousness)
                                - news_score
                            - -->
                            @foreach ($home_care_patient->vital_sign->sortByDesc('time_acquired') as $vital_sign)
                                <tr>
                                    <td>{{ explode(" ", $vital_sign->time_acquired)[0] }}</td>
                                    <td>{{ explode(" ", $vital_sign->time_acquired)[1] }}</td>
                                    <td><span>{{ $vital_sign->respiratory_rate }}</span> rpm</td>
                                    <td><span>{{ $vital_sign->oxygen_saturation }}</span> %</td>
                                    <td><span>{{ $vital_sign->temperature }}</span> &deg;C</td>
                                    <td><span>{{ $vital_sign->systolic_blood_pressure }}/{{ $vital_sign->diastolic_blood_pressure }}</span> mmHg</td>
                                    <td><span>{{ $vital_sign->heart_rate }}</span> bpm</td>
                                    <td><span>{{ $vital_sign->additional_oxygen ? "Yes" : "No" }}</span></td>
                                    <td><span>{{ $vital_sign->dm_level_of_consciousness->consciousness }}</span></td>
                                    <td><span>{{ $vital_sign->news_score }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="konsultasiContent" role="tabpanel" aria-labelledby="konsultasiTab">
                <div class="card chat-box" id="consultationChatbox">
                    <div class="card-body chat-content">
                    </div>
                    <div class="card-footer chat-form">
                        <form id="chat-form">
                            <input type="text" class="form-control" placeholder="Ketikkan pesan di sini" id="message-form">
                            <button class="btn btn-primary" type="submit">
                                <i class="far fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js-extends')
    <script>
        $(document).ready(function(){
            async function refreshChat(){
                const response = await fetch(
                    `${window.location.href}/get-chat`,
                    { 
                        method: "GET", 
                        headers: {'Content-Type': 'application/json'}
                    }
                );

                var chatBox = document.getElementsByClassName('chat-item');
                while(chatBox[0]){
                    chatBox[0].parentNode.removeChild(chatBox[0]);
                }

                var chats = (await response.json()).chats;
                for(var i = 0; i < chats.length; i++) {
                    var type = 'text';
                    if(chats[i].typing != undefined) type = 'typing';
                    $.chatCtrl('#consultationChatbox', {
                        text: chats[i].text,
                        picture: chats[i].picture,
                        position: chats[i].position,
                        type: type
                    });
                }
            }

            setInterval(async function(){
                refreshChat();
            }, 5000);

            $("#chat-form").submit(async function(evt) {
                evt.preventDefault();
                var message = $("#message-form").val();
                const response = await fetch(
                    `${window.location.href}/send-chat`,
                    {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({message: message})
                    }
                );

                if((await response.json()).success){
                    $("#message-form").val("");
                    refreshChat();
                }
            });
        });
    </script>
@endsection
