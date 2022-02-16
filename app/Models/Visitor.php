<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $table = 'visitors';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'tgl',
        'total_visit'
    ];
}
