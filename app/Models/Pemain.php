<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Klub;

class Pemain extends Model
{
    use HasFactory;
    protected $fillable = ['nama_pemain', 'posisi', 'foto' , 'tgl_lahir' , 'harga_pasar' , 'id_klub'];

    public function Klub()
    {
        return $this->belongsTo(Klub::class, 'id_klub');
    }
}
