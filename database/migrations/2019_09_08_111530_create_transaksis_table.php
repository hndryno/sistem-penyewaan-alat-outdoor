<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('kode_transaksi');
            $table->unsignedInteger('barang_id');
            $table->integer('metode_pembayaran')->default(0);
            $table->integer('status_barang')->default(0);
            $table->integer('status_pembayaran')->default(0);
            $table->string('bukti_pembayaran')->default('bukti kosong');
            $table->string('hari_sewa');
            $table->string('harga_barang');
            $table->string('konfirmasi');
            $table->string('qty');
            $table->string('total');
            $table->boolean('pengembalian_barang')->default(0);
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->timestamps();
            $table->foreign('user_id')->on('users')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('barang_id')->on('barangs')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
