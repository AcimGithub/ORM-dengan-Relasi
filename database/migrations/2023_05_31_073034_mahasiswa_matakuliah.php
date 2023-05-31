<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_id');
            $table->unsignedBigInteger('matakuliah_id');
            $table->integer('nilai');
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('Nim')->on('mahasiswas');
            $table->foreign('matakuliah_id')->references('id')->on('matakuliah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
