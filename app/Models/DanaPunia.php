<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanaPunia extends Model
{
    use HasFactory;

    protected $table = 'dana_punia';

    protected $fillable = [
        'user_id',
        'upacara_id',
        'nominal',
        'tanggal',
        'nama',
        'alamat',
        'no_hp',
    ];

    protected static function booted()
    {
        static::created(function ($dana_punia) {
            update_upacara($dana_punia);
        });

        static::updated(function ($dana_punia) {
            update_upacara($dana_punia);
        });

        static::deleted(function ($dana_punia) {
            update_upacara($dana_punia);
        });

        function update_upacara($dana_punia)
        {
            $upacara = Upacara::find($dana_punia->upacara_id);
            $total_dana_punia = DanaPunia::where('upacara_id', $dana_punia->upacara_id)->sum('nominal');

            if ($upacara) {
                $upacara->update(['total_dana_punia' => $total_dana_punia]);
            }
        }
    }

    public function upacara()
    {
        return $this->belongsTo(Upacara::class, 'upacara_id', 'id');
    }
}
