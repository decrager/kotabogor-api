<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_opd extends Model
{
    use HasFactory;
    protected $table = 'data_opds';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'nama_opd',
        'foto_kantor',
        'alamat',
        'telp',
        'email',
        'website',
        'twitter_link',
        'ig_link',
        'facebook_link'
    ];
}
