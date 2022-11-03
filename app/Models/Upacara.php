<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upacara extends Model
{
    use HasFactory;

    protected $table = 'upacara';

    protected $fillable = [
        'nama',
        'tanggal_mulai',
        'tanggal_selesai',
        'total_dana_punia',
        'total_kas_keluar',
        'total_sesari',
        'keterangan',
        'status',
    ];

    protected static function booted()
    {
        static::deleting(function ($upacara) {
            $upacara->dana_punia()->delete();
        });
    }

    public function dana_punia()
    {
        return $this->hasMany(DanaPunia::class, 'upacara_id', 'id');
    }
}
