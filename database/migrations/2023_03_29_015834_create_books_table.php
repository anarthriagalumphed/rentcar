<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    //ini migration untuk mobil
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_code')->nullable()->default('plw-'); //kode mobil?, plat?
            $table->string('nopol')->nullable()->default('AB ');
            $table->string('title'); //merk
            $table->string('tahun_keluar')->nullable(); //tahun keluar
            $table->decimal('price')->nullable()->default(0); //harga sewa permobil
            $table->string('pendapatan')->nullable(); //pendapatan perbulan
            $table->string('durasi_sewa')->nullable(); //durasi sewa perbulan
            $table->text('keterangan')->nullable(); //keterangan?
            $table->string('status')->default('in stock');
            $table->timestamps();

            //nama mobil, tahun keluar, pendapatan perbulan, durasi sewa sebulan, 




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
