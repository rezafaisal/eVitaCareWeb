<?php

use App\Models\DmUserStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nip', 20);
            $table->string('phone_number', 20);
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignIdFor(DmUserStatus::class)->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
