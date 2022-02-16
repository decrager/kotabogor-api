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
        'nama_kepalaopd',
        'foto_kepalaopd',
        'alamat',
        'telp',
        'email',
        'website',
        'twitter_alamat',
        'twitter_link',
        'ig_alamat',
        'ig_link',
        'facebook_alamat',
        'facebook_link'
    ];
}
