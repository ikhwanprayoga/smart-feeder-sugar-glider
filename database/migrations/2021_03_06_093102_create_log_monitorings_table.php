<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogMonitoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_monitoring', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alat_id')->nullable();
            $table->integer('makanan');
            $table->integer('air');
            $table->integer('status_pakan')->nullable();
            $table->timestamps();

            $table->foreign('alat_id')->references('id')->on('alat')->onDelete('set null');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_monitoring');
    }
}
