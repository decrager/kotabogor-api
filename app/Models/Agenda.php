<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $table = 'agendas';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'hari',
        'tgl',
        'waktu',
        'lokasi',
        'kegiatan',
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
}
