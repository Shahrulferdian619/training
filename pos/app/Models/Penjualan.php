<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    // protected $guarded = [];
    protected $fillable = [
        'nomer_penjualan',
        'tanggal',
        'keterangan',
        'metode_pembayaran',
        'grantotal',
    ];

    public function penjualanRinci()
    {
        return $this->hasMany(PenjualanRincin::class, 'penjualan_id');
    }
}
