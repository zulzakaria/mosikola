<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    public $table = 'lokasi';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nama_lokasi'
    ];
}
