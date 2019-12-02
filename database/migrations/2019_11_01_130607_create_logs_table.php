<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('barang_id');
            $table->string('kode_transaksi');
            $table->integer('metode_pembayaran');
            $table->integer('status_barang');
            $table->integer('status_pembayaran');
            $table->string('bukti_pembayaran');
            $table->string('hari_sewa');
            $table->string('harga_barang');
            $table->string('konfirmasi');
            $table->string('qty');
            $table->string('total');
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
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
        Schema::dropIfExists('logs');
    }
}
