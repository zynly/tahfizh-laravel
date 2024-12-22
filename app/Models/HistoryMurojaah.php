<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class HistoryMurojaah extends Model
{
    use HasFactory;
    protected $fillable=['murojaah_id', 'surat_id', 'ayatke', 'tgl_murojaah', 'nilai', 'keterangan'];

    public function murojaah()
    {
        return $this->belongsTo(Murojaah::class);
    }

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }

    public function siswa()
    {
        return $this->hasOneThrough(Siswa::class, Murojaah::class, 'id', 'id', 'murojaah_id', 'siswa_id');
    }

    public function ustad()
    {
        return $this->hasOneThrough(Ustad::class, Murojaah::class, 'id', 'id', 'murojaah_id', 'ustad_id');
    }
}
