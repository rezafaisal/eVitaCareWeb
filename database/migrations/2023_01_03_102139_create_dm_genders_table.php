<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dm_genders', function (Blueprint $table) {
            $table->string('id', 1)->primary()->index();
            $table->string('gender', 20);
        });
    }

    public function down()
    {
        Schema::dropIfExists('dm_genders');
    }
};
