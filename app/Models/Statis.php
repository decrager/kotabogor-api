<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statis extends Model
{
    use HasFactory;
    protected $table = 'statis';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'judul',
        'kategori_id',
        'isi',
        'file',
        'tgl',
        'status',
        'user_id'
    ];

    public function Kat_Statis()
    {
        return $this->belongsTo(Kat_Statis::class, 'kategori_id', 'id')
            ->select('id', 'kategori', 'keterangan');
    }

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
}
