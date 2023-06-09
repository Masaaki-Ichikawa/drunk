<?php

namespace App\Http\Controllers;

use App\Models\Jenre;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    public function showRecipes(Request $request) {
        //一覧表示、ジャンル別表示        
        if (isset($request->jenre_id)) {
            $recipes = Recipe::with('user')->where('jenre_id', $request->jenre_id)->latest()->get();
        } else {
            $recipes = Recipe::with('user')->latest()->get();
        }

        $jenres = Jenre::get();
        return view('dashboard', ['recipes' => $recipes, 'jenres' => $jenres]);
    }

    public function uploadRecipe(Request $request) { 
        //ディレクトリ名
        $dir = 'images';

        //アップロードされた画像ファイル名を取得
        $image_name = $request->file('image')->getClientOriginalName();

        //imagesディレクトリに画像を保存
        $request->file('image')->storeAs('public/'. $dir, $image_name);

        $recipe = new Recipe();
        $recipe->name = $request->name;
        $recipe->recipe = $request->recipe;
        $recipe->image_path = 'storage/' . $dir . '/' . $image_name;
        $recipe->jenre_id = $request->jenre_id;
        $recipe->user_id = $request->user()->id;
        $recipe->save();

        return redirect('dashboard');
    }

    public function showMyRecipes(Request $request) {
            $recipes = Recipe::with('user')->where('user_id', $request->user()->id)->latest()->get();

        return view('user_mypage', ['recipes' => $recipes]);
    }
}
