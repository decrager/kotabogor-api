<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner_Link extends Model
{
    use HasFactory;
    protected $table = 'banner_links';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'judul',
        'gambar',
        'link',
        'status'
    ];
}
