<?php

namespace Database\Seeders;

use App\Models\HomeCarePatient;
use App\Models\Patient;
use App\Models\VitalSign;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run()
    {
        $patients= [
            [
                'id' => 1,
                'nik' => '4444444444444444',
                'name' => 'Shira Nour Rizana',
                'birth_date' => '1998-01-06',
                'bpjs_number' => '0000000000',
                'phone_number' => '087812134466',
                'address' => 'Komplek Bumi Cahaya Bintang, Banjarbaru',
                'email' => 'rizana@gmail.com',
                'password' => bcrypt("123"),
                'dm_gender_id' => 'P',
            ],[
                'id' => 2,
                'nik' => '6666666666666666',
                'name' => 'Muhammad Ihsan',
                'birth_date' => '1990-06-29',
                'bpjs_number' => '00000000001',
                'phone_number' => '087812134466',
                'address' => 'Jalan Intansari II, Banjarbaru',
                'email' => 'ihsan@gmail.com',
                'password' => bcrypt("123"),
                'dm_gender_id' => 'L',
            ],[
                'id' => 3,
                'nik' => '5555555555555555',
                'name' => 'Miharza',
                'birth_date' => '1967-06-05',
                'bpjs_number' => '00000000002',
                'phone_number' => '087812134477',
                'address' => 'Jalan Dahlina Raya, Banjarbaru',
                'email' => 'miharza@gmail.com',
                'password' => bcrypt("123"),
                'dm_gender_id' => 'L',
            ],
        ];

        foreach($patients as $patient){
            Patient::create($patient);
        }

        $home_care_patients= [
            [
                'id' => 1,
                'patient_id' => 1,
                'doctor_dpjp_id' => 2,
                'dm_monitoring_status_id' => 2,
                'registration_date' => '2023-08-07 07:00:00',
                'monitoring_start_date' => '2023-08-21 07:30:00',
                'monitoring_end_date' => NULL,
                'enrolled_by' => 3,
                'discharged_by' => NULL,
            ],[
                'id' => 2,
                'patient_id' => 2,
                'doctor_dpjp_id' => 2,
                'dm_monitoring_status_id' => 2,
                'registration_date' => '2023-08-07 08:00:00',
                'monitoring_start_date' => '2023-08-08 07:40:00',
                'monitoring_end_date' => NULL,
                'enrolled_by' => 3,
                'discharged_by' => NULL,
            ],[
                'id' => 3,
                'patient_id' => 3,
                'doctor_dpjp_id' => 2,
                'dm_monitoring_status_id' => 2,
                'registration_date' => '2023-08-07 09:00:00',
                'monitoring_start_date' => '2023-08-08 08:00:00',
                'monitoring_end_date' => NULL,
                'enrolled_by' => 3,
                'discharged_by' => NULL,
            ],
        ];

        foreach($home_care_patients as $home_care_patient){
            HomeCarePatient::create($home_care_patient);
        }

        $vital_signs= [
            [
                'id' => 1,
                'home_care_patient_id' => 1,
                'time_acquired' => '2023-03-21 12:00:00',
                'respiratory_rate' => 8,
                'oxygen_saturation' => 91,
                'temperature' => 39.1,
                'systolic_blood_pressure' => 112,
                'diastolic_blood_pressure' => 76,
                'heart_rate' => 52,
                'additional_oxygen' => 0,
                'dm_level_of_consciousness_id' => 1,
                'news_score' => 5,
            ],[
                'id' => 2,
                'home_care_patient_id' => 2,
                'time_acquired' => '2023-03-21 12:00:00',
                'respiratory_rate' => 27,
                'oxygen_saturation' => 99,
                'temperature' => 38.1,
                'systolic_blood_pressure' => 120,
                'diastolic_blood_pressure' => 80,
                'heart_rate' => 109,
                'additional_oxygen' => 0,
                'dm_level_of_consciousness_id' => 1,
                'news_score' => 0,
            ],[
                'id' => 3,
                'home_care_patient_id' => 3,
                'time_acquired' => '2023-03-21 12:00:00',
                'respiratory_rate' => 22,
                'oxygen_saturation' => 93,
                'temperature' => 36.9,
                'systolic_blood_pressure' => 119,
                'diastolic_blood_pressure' => 79,
                'heart_rate' => 77,
                'additional_oxygen' => 0,
                'dm_level_of_consciousness_id' => 1,
                'news_score' => 1,
            ],
        ];

        foreach($vital_signs as $vital_sign){
            VitalSign::create($vital_sign);
        }
    }
}
