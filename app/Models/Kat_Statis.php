<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kat_Statis extends Model
{
    use HasFactory;
    protected $table = 'kat_statis';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'kategori',
        'keterangan'
    ];

    public function Statis(){
        return $this->hasMany(Statis::class, 'kategori_id', 'id');
    }
}
