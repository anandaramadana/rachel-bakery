<?php

namespace App\Models;

use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = 'keranjangs';
    protected $guards = [];
    protected $fillable=['qty','harga','total_harga'];

    // public function pemesanan()
    // {
    //     return $this->hasMany(Pemesanan::class);
    // }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
