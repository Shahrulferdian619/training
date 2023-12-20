<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarProduk extends Model
{
    use HasFactory;

    protected $table = 'daftar_produk';
    protected $guarded = [];

    public function kategori (){
        return $this->belongsTo(KategoriProduk::class, 'kategori_produk_id');
    }

    public function penjualanRinci ()
    {
        return $this->hasMany(PenjualanRincin::class, 'daftar_produk_id');
    }
}
