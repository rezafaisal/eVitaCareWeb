<?php

use App\Models\HomeCarePatient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(HomeCarePatient::class)->constrained();

            $table->UnsignedBigInteger('user_responded_id')->nullable();
            $table->foreign('user_responded_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultations');
    }
};
