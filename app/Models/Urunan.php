<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urunan extends Model
{
    use HasFactory;

    protected $table = 'urunan';

    protected $fillable = [
        'nama',
        'nominal_dibutuhkan',
        'nominal_per_orang',
        'nominal_terkumpul',
    ];

    protected static function booted()
    {
        static::deleted(function ($urunan) {
            $urunan->urunan_user()->delete();
        });
    }

    public function urunan_user()
    {
        return $this->hasMany(UrunanUser::class, 'urunan_id', 'id');
    }
}
