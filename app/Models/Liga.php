<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liga extends Model
{
    use HasFactory;
    protected $fillable = ['nama_liga', 'negara'];

    public function klub()
    {
        return $this->hasMany(Klub::class, 'id_ligas');
    }
}
