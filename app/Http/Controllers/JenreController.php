<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenreRequest;
use Illuminate\Http\Request;
use App\Models\Jenre;
use Illuminate\Support\Facades\Auth;

class JenreController extends Controller
{
    public function getJenre() {
        if (Auth::user()->role === 'user') {
            $jenres = Jenre::all();
            return view('new_recipe', ['jenres' => $jenres]);
        } elseif (Auth::user()->role === 'admin') {
            return view('setting');
        }
        
    }


    //ジャンル追加入力画面
    public function jenreAdditionForm (Jenre $jenre)
    {
        $jenres = $jenre->get();
        // dd($jenres);
        return view('jenre_addition_form', ['jenres' => $jenres]);
    }
    
    
    //ジャンル追加
    public function jenreAddition(Jenre $jenre, JenreRequest $request) 
    {
        $jenre->fill($request->validated())->save();
        return redirect('jenre_addition_form');
    }


    //ジャンル削除
    public function jenreDel(Jenre $jenre) 
    {
        $jenre->delete();
        return redirect('jenre_addition_form');
    }
}
