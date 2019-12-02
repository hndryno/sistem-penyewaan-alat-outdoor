<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';
    protected $fillable = ['kategori_id','nama_alat','gambar','stock','harga','keterangan'];

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }

    public function transaksi()
    {
        return $this->hasMany('App\Transaksi','barang__id');
    }

    public function log()
    {
        return $this->hasMany('App\Log','barang_id');
    }
}
