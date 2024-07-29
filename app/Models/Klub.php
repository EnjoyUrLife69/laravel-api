<?php

namespace App\Models;
use App\Models\Fan;
use App\Models\Liga;
use App\Models\Pemain;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klub extends Model
{
    use HasFactory;
    protected $fillable = [ 'nama_klub' , 'logo' , 'id_liga' ];

    public function liga()
    {
        return $this->belongsTo(Liga::class , 'id_liga');
    }

    public function pemain()
    {
        return $this->hasMany(Pemain::class , 'id_klub');
    }

    public function fan()
    {
        return $this->belongToMany(Fa ::class , 'fan_klub' , 'id_klub' , 'id_fan');
    }
}
