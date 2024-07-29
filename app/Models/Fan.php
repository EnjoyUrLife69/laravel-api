<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    use HasFactory;
    protected $fillable = ['nama_fans'];

    public function klub()
    {
        return $this->belongsToMany(klub::class , 'fan_klub' , 'id_fan' , 'id_klub');
    }
}
