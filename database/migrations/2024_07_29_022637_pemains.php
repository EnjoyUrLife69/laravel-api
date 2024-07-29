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
        Schema::create('pemains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_pemain');
            $table->string('foto')->nullable();
            $table->date('tgl_lahir');
            $table->integer('harga_pasar');
            $table->enum('posisi', ['GK', 'DF', 'MF', 'FW']);
            $table->string('negara');
            $table->unsignedBigInteger('id_klub');
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
        Schema::dropIfExists('pemains');
    }
};
