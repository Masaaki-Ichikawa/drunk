<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    public function showRecipes() {
        $recipes = Recipe::with('user')->latest()->get();
        // dd($recipes);
        return view('dashboard', ['recipes' => $recipes]);
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

}
