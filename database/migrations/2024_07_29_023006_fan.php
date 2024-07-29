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
         Schema::create('fans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fans');
            $table->timestamps();
        });

        Schema::create('fans_klub', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_fans');
            $table->unsignedBigInteger('id_klub');
            $table->foreign('id_fans')->references('id')->on('fans')->onDelete('cascade');
            $table->foreign('id_klub')->references('id')->on('klubs')->onDelete('cascade');
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
        //
    }
};
