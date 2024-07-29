<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klubs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_club');
            $table->string('logo')->nullable();
            $table->unsignedBigInteger('id_liga');
            $table->foreign('id_liga')->references('id')->on('ligas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('klubs');
    }
};
