<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=['user_id','kelas_id','is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function murojaah()
    {
        return $this->hasOne(Murojaah::class);
    }

    // Event deleting untuk menghapus data murojaah terkait
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($siswa) {
            // Hapus data di tabel murojaahs yang terkait dengan siswa_id
            $siswa->murojaah()->delete();
        });
    }
}
