<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dm_user_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status', 255);
            $table->text('description');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dm_user_statuses');
    }
};
