<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_penerima');
            $table->string('notelp_penerima');
            $table->string('email');
            $table->foreignId('kab_id')->constrained('kabupatens')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kec_id')->constrained('kecamatans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('alamat_penerima');
            $table->date('tgl_pengiriman');
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('pengirimans');
    }
}
