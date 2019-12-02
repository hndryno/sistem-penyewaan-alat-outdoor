<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $fillable = ['user_id','barang_id','status','qty','tanggal_sewa','tanggal_kembali','harga_barang','denda', 'total','konfirmasi','hari_sewa','kode_transaksi'];
    protected $dates = ['created_at', 'updated_at', 's_lastrun','tanggal_sewa','tanggal_kembali'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function barang()
    {
        return $this->belongsTo('App\Barang');
    }
}
