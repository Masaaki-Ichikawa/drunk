<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenre extends Model
{
    use HasFactory;

    protected $table = 'jenres';
    public $timestamps = false;

    protected $fillable = [
        'jenre'
    ];
}
