<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DmGender;
use App\Models\DmMonitoringStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DmGender::create(['id' => 'L', 'gender' => 'Laki-laki']);
        DmGender::create(['id' => 'P', 'gender' => 'Perempuan']);

        DmMonitoringStatus::create([
            'id' => 1,
            'status' => 'Mendaftar',
            'description' => 'Data pendaftaran belum diperiksa oleh Dokter/Perawat'
        ]);

        DmMonitoringStatus::create([
            'id' => 2,
            'status' => 'Monitoring',
            'description' => 'Pasien dalam masa pemantauan'
        ]);

        DmMonitoringStatus::create([
            'id' => 3,
            'status' => 'Selesai',
            'description' => 'Masa pemantauan pasien sudah selesai.</br>Pasien juga bisa mendaftar home care kembali'
        ]);
        
        $this->call([
            UserSeeder::class,
            LevelOfConscousnessSeeder::class,
            PatientSeeder::class,
            ConsultationSeeder::class
        ]);
    }
}
