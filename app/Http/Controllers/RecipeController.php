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
    public function uploadRecipe(Request $request) 
    { 
        //ディレクトリ名
        $dir = 'images';

        

        //バリデーション
        $request->validate([
            'name' => 'required|max:30',
            'recipe' => 'required | max:300',
            'image' => 'required',
            'jenre_id' => 'required',
        ], [
            'name.required' => 'レシピ名は必須です30文字以内で入力してください。', 
            'name.max' => 'レシピ名は30文字以内で入力してください。',
            'recipe.required' => 'レシピは必須です500文字以内で入力してください。',
            'recipe.max' => 'レシピは500文字以内で入力してください。',
            'jenre_id.required' => 'ジャンルは選択必須です。',
            'image.required' => '画像は必須です。'
        ]);

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

    //レシピ編集画面
    public function recipeEdit(Recipe $recipe) 
    {
        $jenres = Jenre::all();
        return view('recipe_edit', ['recipe' => $recipe, 'jenres' => $jenres]);
    }


    //レシピ編集アップロード処理
    public function recipeEditUp(Request $request, Recipe $recipe) 
    {
        //ディレクトリ名
        $dir = 'images';

        

        //バリデーション
        $request->validate([
            'name' => 'required|max:30',
            'recipe' => 'required | max:300',
            'image' => 'required',
            'jenre_id' => 'required',
        ], [
            'name.required' => 'レシピ名は必須です30文字以内で入力してください。', 
            'name.max' => 'レシピ名は30文字以内で入力してください。',
            'recipe.required' => 'レシピは必須です500文字以内で入力してください。',
            'recipe.max' => 'レシピは500文字以内で入力してください。',
            'jenre_id.required' => 'ジャンルは選択必須です。',
            'image.required' => '画像は必須です。'
        ]);

        //アップロードされた画像ファイル名を取得
        $image_name = $request->file('image')->getClientOriginalName();

        //imagesディレクトリに画像を保存
        $request->file('image')->storeAs('public/'. $dir, $image_name);

        $recipe->where('id', $request->id)->update([
            'name' => $request->name,
            'recipe' => $request->recipe,
            'image_path' => 'storage/' . $dir . '/' . $image_name,
            'jenre_id' => $request->jenre_id
        ]);
        

        return redirect('dashboard');
    }


    //レシピ削除確認画面
    public function recipeDelConf(Recipe $recipe)
    {
        return view('recipe_del_conf', ['recipe' => $recipe]);
    }

    //レシピ削除実行
    public function recipeDel(Recipe $recipe) 
    {
        $recipe->delete();
        return redirect('user_mypage');
    }
}
