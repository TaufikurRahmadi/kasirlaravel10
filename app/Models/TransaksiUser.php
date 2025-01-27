<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiUser extends Model
{
    use HasFactory;

    protected $table = 'transaksi_users'; // Nama tabel (jika berbeda dari nama model)

    protected $fillable = [
        'id',
        'user_id',
        'transaksi_id',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke model Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
