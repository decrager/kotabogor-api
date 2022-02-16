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
        'nama',
        'email',
        'komentar'
    ];
}
