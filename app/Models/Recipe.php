<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recipe extends Model
{
    protected $table = 'recipes';

    use HasFactory;

    protected $fillable = [
        'name', 
        'recipe', 
        'image_path', 
        'jenre_id', 
        'user_id'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function jenre() {
        return $this->belongsTo(Jenre::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

}
