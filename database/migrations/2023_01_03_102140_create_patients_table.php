<?php

use App\Models\DmGender;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20)->unique();
            $table->string('name');
            $table->date('birth_date');
            $table->string('bpjs_number', 20);
            $table->string('phone_number', 20);
            $table->text('address');
            $table->string('email')->unique();
            $table->string('password');

            $table->foreignIdFor(DmGender::class)->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
};