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

    public function Pengguna(){
        return $this->belongsTo(Pengguna::class, 'user_id', 'id');
    }

    public function Kat_Berita(){
        return $this->belongsTo(Kat_Berita::class, 'kategori_id', 'id');
    }
}
