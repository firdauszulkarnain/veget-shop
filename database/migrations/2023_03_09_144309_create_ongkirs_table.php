<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOngkirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ongkirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kab_id')->constrained('kabupatens')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kec_id')->constrained('kecamatans')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('harga_ongkir', $precision = 10, $scale = 0);
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
        Schema::dropIfExists('ongkirs');
    }
}
