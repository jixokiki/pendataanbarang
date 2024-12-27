<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['barang_id', 'user_id','statusPemesanan'];

    // Relasi ke tabel Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}