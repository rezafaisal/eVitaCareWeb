<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dm_monitoring_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->text('description');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dm_monitoring_statuses');
    }
};
