@section('title')
    Dashboard
@endsection

@section('content')
    <section class="section">
        <div class="section-header"><h1>Dashboard</h1></div>
        <div class="section-body">
        <div class="row">
            @foreach ($vital_signs as $vital_sign)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card-patient">
                        <div class="card-header">
                            <a href="{{ route('home_care_patient.detail', ['id' => $vital_sign->home_care_patient->id]) }}" class="name">
                                {{ $vital_sign->home_care_patient->patient->name }}    
                            </a>
                            <div class="detail">
                                <div class="consultation">
                                    <!--
                                        kalau ada pesan baru, muncul class "beep"
                                        kalau sudah ada user (role dokter, perawat) yang merespon, class "beep" hilang
                                        
                                        <div class="btn btn-icon btn-outline-light beep">
                                    -->
                                    <div class="btn btn-icon btn-outline-light"><i class="fas fa-comment"></i></div>
                                </div>
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
                            <div class="respiratory-rate mt-2">
                                <span>RR</span>
                                <div class="values">
                                    <span class="value">{{ $vital_sign->respiratory_rate }}</span> <!-- respiratory_rate -->
                                    <span class="unit">rpm</span>
                                </div>
                            </div>
                            <div class="oxygen-saturation mt-2">
                                <span>SpO&#8322</span>
                                <div class="values">
                                    <span class="value">{{ $vital_sign->oxygen_saturation }}</span> <!-- oxygen_saturation -->
                                    <span class="unit">%</span>
                                </div>
                            </div>
                            <div class="temperature mt-2">
                                <span>Temp.</span>
                                <div class="values">
                                    <span class="value">{{ $vital_sign->temperature }}</span> <!-- temperature -->
                                    <span class="unit">&deg;C</span>
                                </div>
                            </div>
                            <div class="blood-pressure mt-2">
                                <span>BP</span>
                                <div class="values">
                                    <span class="value">{{ $vital_sign->systolic_blood_pressure }}</span> <!-- systolic_blood_pressure -->
                                    <span class="value">/</span>
                                    <span class="value">{{ $vital_sign->diastolic_blood_pressure }}</span> <!-- diastolic_blood_pressure -->
                                    <span class="unit">mmHg</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </section>
@endsection