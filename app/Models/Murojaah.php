<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Murojaah extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=['siswa_id','ustad_id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function ustad()
    {
        return $this->belongsTo(Ustad::class);
    }

    public function history()
    {
        return $this->hasMany(HistoryMurojaah::class);
    }
}
