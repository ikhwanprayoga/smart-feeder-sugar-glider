<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendalisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendali', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alat_id')->nullable();
            $table->time('waktu');
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
        Schema::dropIfExists('kendali');
    }
}
