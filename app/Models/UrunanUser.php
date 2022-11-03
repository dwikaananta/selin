<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrunanUser extends Model
{
    use HasFactory;

    protected $table = 'urunan_user';

    protected $fillable = [
        'urunan_id',
        'user_id',
        'nominal',
        'tanggal',
    ];

    protected static function booted()
    {
        static::created(function($urunan_user) {
            update_urunan($urunan_user);
        });

        static::updated(function($urunan_user) {
            update_urunan($urunan_user);
        });

        static::deleted(function($urunan_user) {
            update_urunan($urunan_user);
        });

        function update_urunan($urunan_user)
        {
            $urunan = Urunan::find($urunan_user->urunan_id);
            $nominal_terkumpul = UrunanUser::where('urunan_id', $urunan_user->urunan_id)->sum('nominal');

            if ($urunan) {
                $urunan->update(['nominal_terkumpul' => $nominal_terkumpul]);
            }
        }
    }

    public function urunan()
    {
        return $this->belongsTo(Urunan::class, 'urunan_id', 'id');
    }
}
