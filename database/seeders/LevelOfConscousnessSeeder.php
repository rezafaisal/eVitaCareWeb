<?php

namespace Database\Seeders;

use App\Models\DmLevelOfConsciousness;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelOfConscousnessSeeder extends Seeder
{
    public function run()
    {
        DmLevelOfConsciousness::create([
            'id' => 1,
            'consciousness' => 'Alert',
            'score' => 0,
        ]);
          
        DmLevelOfConsciousness::create([
            'id' => 2,
            'consciousness' => 'Voice',
            'score' => 3,
        ]);
          
        DmLevelOfConsciousness::create([
            'id' => 3,
            'consciousness' => 'Pain',
            'score' => 3,
        ]);
          
        DmLevelOfConsciousness::create([
            'id' => 4,
            'consciousness' => 'Unresponsive',
            'score' => 3,
        ]);
    }
}
