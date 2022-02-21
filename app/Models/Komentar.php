<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $table = 'komentars';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'berita_id',
        'nama',
        'email',
        'komentar'
    ];

    public function Berita()
    {
        return $this->belongsTo(Berita::class, 'berita_id', 'id')
            ->select(
                'id',
                'judul',
                'kategori_id',
                'isi',
                'gambar',
                'tgl',
                'user_id'
            );
    }
}
