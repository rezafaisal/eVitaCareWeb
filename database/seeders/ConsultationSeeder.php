<?php

namespace Database\Seeders;

use App\Models\Consultation;
use Illuminate\Database\Seeder;

class ConsultationSeeder extends Seeder
{
    public function run()
    {
        $consultations = [
            [
                'home_care_patient_id' => 1,
                'message' => 'Halo Dokter',
            ],
            [
                'home_care_patient_id' => 1,
                'user_responded_id' => 2,
                'message' => 'Halo Saya dr. Ikhsan, ada yang bisa dibantu?',
            ],
            [
                'home_care_patient_id' => 1,
                'user_responded_id' => 3,
                'message' => 'Halo Dokter dr. Fatmawati, ada yang bisa dibantu juga?',
            ],
        ];

        foreach($consultations as $consultation){
            Consultation::create($consultation);
        }
    }
}
