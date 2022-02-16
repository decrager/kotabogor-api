<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link_Info extends Model
{
    use HasFactory;
    protected $table = 'link_infos';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'judul',
        'keterangan',
        'link',
        'gambar'
    ];
}
