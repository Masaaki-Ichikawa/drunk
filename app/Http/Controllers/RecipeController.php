<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Jenre;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    //一覧表示、ジャンル別表示 
    public function showRecipes(Request $request) {
               
        if (isset($request->jenre_id)) {
            $recipes = Recipe::with('user')->where('jenre_id', $request->jenre_id)->latest()->get();
        } else {
            $recipes = Recipe::with('user')->latest()->get();
        }

        $jenres = Jenre::get();
        return view('dashboard', ['recipes' => $recipes, 'jenres' => $jenres]);
    }

    //レシピアップロード処理
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

    //マイページレシピ
    public function showMyRecipes(Request $request) {
        $recipes = Recipe::with('user')->where('user_id', $request->user()->id)->latest()->get();

        return view('user_mypage', ['recipes' => $recipes, 'request' => $request]);
    }


    ////ほかのユーザーの投稿一覧
    public function showUserRecipes(Request $request) 
    {
        // dd($request);
        $user_recipes = Recipe::with('user')->where('user_id', $request->user_id)->latest()->get();
        return view('user_recipes', ['user_recipes' => $user_recipes, 'request' => $request]);
    }
    
    
    /**
     * レシピ詳細
     *
     * @param Request $request
     * @return void
     */
    public function recipeDetail(Request $request)
    {
        $recipe = Recipe::with('user')->where('id', $request->recipe_id)->get();
        $comments = Comment::with('user')->where('recipe_id', $request->recipe_id)->latest()->get();
        return view('recipe_detail', ['recipe' => $recipe, 'comments' => $comments]);
    }
}
