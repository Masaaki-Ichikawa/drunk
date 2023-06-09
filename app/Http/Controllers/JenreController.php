<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenre;

class JenreController extends Controller
{
    public function getJenre() {
        $jenres = Jenre::all();
        return view('new_recipe', ['jenres' => $jenres]);
    }    
}
