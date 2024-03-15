<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dm_level_of_consciousnesses', function (Blueprint $table) {
            $table->id();
            $table->string('consciousness', 255);
            $table->integer('score');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dm_level_of_consciousnesses');
    }
};
