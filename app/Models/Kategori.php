<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';
    protected $guards = [];
    protected $fillable=['id','nama_kategori','deskripsi','gambar'];

    public function menu()
    {
        return $this->hasMany(Menu::class, 'kategori_id');
    }
}
