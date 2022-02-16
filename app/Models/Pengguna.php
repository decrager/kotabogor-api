<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;
    protected $table = 'penggunas';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'nama',
        'email',
        'telp',
        'username',
        'password',
        'role',
        'foto'
    ];

    public function Agenda(){
        return $this->hasMany(Agenda::class, 'user_id', 'id');
    }

    public function Album(){
        return $this->hasMany(Album::class, 'user_id', 'id');
    }

    public function Banner_Announce(){
        return $this->hasMany(Banner_Announce::class, 'user_id', 'id');
    }

    public function Berita(){
        return $this->hasMany(Berita::class, 'user_id', 'id');
    }

    public function Statis(){
        return $this->hasMany(Statis::class, 'user_id', 'id');
    }

    public function Video(){
        return $this->hasMany(Video::class, 'user_id', 'id');
    }
}
