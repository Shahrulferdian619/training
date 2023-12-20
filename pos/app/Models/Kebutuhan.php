<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kebutuhan extends Model
{
    use HasFactory;

    protected $table = 'kebutuhan';
    protected $guarded = [];

    public function kebutuhanRinci ()
    {
        return $this->hasMany(KebutuhanRinci::class, 'kebutuhan_id');
    }
}
