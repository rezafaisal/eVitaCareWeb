<?php

use App\Models\DmLevelOfConsciousness;
use App\Models\HomeCarePatient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(HomeCarePatient::class)->constrained();
            $table->dateTime('time_acquired');
            $table->float('respiratory_rate');
            $table->float('oxygen_saturation');
            $table->float('temperature');
            $table->float('systolic_blood_pressure');
            $table->float('diastolic_blood_pressure');
            $table->float('heart_rate');
            $table->boolean('additional_oxygen');
            $table->foreignIdFor(DmLevelOfConsciousness::class)->constrained();
            $table->integer('news_score');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vital_signs');
    }
};
