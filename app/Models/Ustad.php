<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ustad extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=['user_id','phone_number','is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
