<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $table = 'photos';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'album_id',
        'judul',
        'foto',
        'keterangan'
    ];

    public function Album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'id')
            ->select(
                'id',
                'judul',
                'tgl',
                'cover',
                'user_id'
            );
    }
}
