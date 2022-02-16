<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $table = 'videos';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'judul',
        'cover',
        'link',
        'keterangan',
        'user_id'
    ];

    public function Pengguna(){
        return $this->belongsTo(Pengguna::class, 'user_id', 'id');
    }
}
