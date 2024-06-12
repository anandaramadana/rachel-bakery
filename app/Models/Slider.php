<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'sliders';
    protected $guards = [];
    protected $fillable=['nama_slide','gambar'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
