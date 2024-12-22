<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=['name','slug','icon'];

    public function siswas()
    {
        return $this->hasMany(siswa::class);
    }

    public function ustads()
    {
        return $this->hasMany(ustad::class);
    }
}
