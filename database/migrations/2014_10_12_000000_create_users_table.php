<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */


    // ini migration untuk admin, dan serta untuk data pelanggan
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username'); //nama
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('nik')->nullable();
            $table->string('phone')->nullable(); //no tlp
            $table->string('id_card', 255)->nullable();
            $table->text('address')->nullable(); //alamat jika perlu

            //nik nama no hp



            $table->timestamp('email_verified_at')->nullable();
            $table->string('status')->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
