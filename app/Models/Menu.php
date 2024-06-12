<?php

namespace App\Models;

use App\Models\Kategori;
use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $guards = [];
    protected $fillable=['id','kategori_id','nama_kue','deskripsi','harga','gambar'];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
