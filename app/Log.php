<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $fillable = ['user_id','barang_id','metode_pembayaran','status_barang','status_pembayaran','qty','tanggal_sewa','tanggal_kembali','harga_barang','denda', 'total','konfirmasi','hari_sewa','konfirmasi','konfirmasi_denda','bukti_pembayaran','kode_transaksi'];
    protected $dates = ['created_at', 'updated_at','tanggal_sewa','tanggal_kembali'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function barang()
    {
        return $this->belongsTo('App\Barang');
    }
}
