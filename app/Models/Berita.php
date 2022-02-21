<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'beritas';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'judul',
        'kategori_id',
        'isi',
        'gambar',
        'tgl',
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

    public function Kat_Berita()
    {
        return $this->belongsTo(Kat_Berita::class, 'kategori_id', 'id')
            ->select('id', 'kategori', 'keterangan');
    }

    public function Komentar()
    {
        return $this->hasMany(Komentar::class, 'berita_id', 'id')
            ->select(
                'id',
                'berita_id',
                'nama',
                'email',
                'komentar'
            );
    }
}
