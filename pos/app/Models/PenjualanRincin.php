<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanRincin extends Model
{
    use HasFactory;

    protected $table = 'penjualan_rinci';
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(DaftarProduk::class, 'daftar_produk_id');
    }
}
