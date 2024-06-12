<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\User;
use App\Models\Keranjang;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanans';
    protected $guards = [];
    protected $fillable=['tanggal_ambil','jam_ambil','qty','total_harga'];
    protected $attributes = [
        'status' => 'Belum Terverifikasi', // Status default
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function keranjang() {
    //     return $this->belongsTo(Keranjang::class);
    // }

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function pembayaran() {
        return $this->belongsTo(Pembayaran::class);
    }
}
