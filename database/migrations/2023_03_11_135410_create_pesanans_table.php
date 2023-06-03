<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade')->onUpdate('cascade');
            $table->string('no_pesanan')->nullable();
            $table->integer('status');
            $table->decimal('subtotal', $precision = 10, $scale = 0)->nullable();
            $table->decimal('ongkir', $precision = 10, $scale = 0)->nullable();
            $table->decimal('total', $precision = 10, $scale = 0)->nullable();
            $table->date('tgl_pesan')->nullable();
            $table->integer('tipe_pembayaran')->nullable();
            $table->date('tgl_bayar')->nullable();
            $table->string('bukti_bayar')->nullable();
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
        Schema::dropIfExists('pesanans');
    }
}
