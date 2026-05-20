<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('jabatan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
};