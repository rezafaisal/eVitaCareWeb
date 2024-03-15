<?php

use App\Models\DmRole;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DmRole::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
};
