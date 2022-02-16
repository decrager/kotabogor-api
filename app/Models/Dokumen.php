<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'documents';
    protected $primarykey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'nama_doc',
        'link',
        'keterangan'
    ];
}
