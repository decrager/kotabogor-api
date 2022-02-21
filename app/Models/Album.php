<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $table = 'albums';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'judul',
        'tgl',
        'cover',
        'user_id'
    ];

    public function Pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'user_id', 'id')
            ->select(
                'id',
                'nama',
                'email',
                'telp',
                'username',
                'role',
                'foto',
            );
    }

    public function Foto()
    {
        return $this->hasMany(Foto::class, 'album_id', 'id');
    }
}
