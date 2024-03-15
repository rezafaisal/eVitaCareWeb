<?php

use App\Models\DmMonitoringStatus;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('home_care_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class)->constrained();
            $table->foreignIdFor(DmMonitoringStatus::class)->constrained();
            $table->dateTime('registration_date');
            $table->dateTime('monitoring_start_date')->nullable();
            $table->dateTime('monitoring_end_date')->nullable();

            $table->UnsignedBigInteger('doctor_dpjp_id')->nullable();
            $table->foreign('doctor_dpjp_id')->references('id')->on('users')->onDelete('cascade');

            $table->UnsignedBigInteger('enrolled_by')->nullable();
            $table->foreign('enrolled_by')->references('id')->on('users')->onDelete('cascade');

            $table->UnsignedBigInteger('discharged_by')->nullable();
            $table->foreign('discharged_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_care_patients');
    }
};
