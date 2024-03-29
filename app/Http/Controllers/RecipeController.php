<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Jenre;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    //一覧表示、ジャンル別表示 
    public function showRecipes(Request $request) {
        // dd($request);
        if (isset($request->keyword) && isset($request->jenre_id)) {
            //レシピが存在するか
            if (Recipe::where('name', 'LIKE', "%{$request->keyword}%")->where('jenre_id', $request->jenre_id)->exists()) {
                $recipes = Recipe::withCount('likes')->with('user')->where('name', 'LIKE', "%{$request->keyword}%")->where('jenre_id', $request->jenre_id)->latest()->get();
            }else {
                $recipes = null;
            }
            $jenres = Jenre::get();
            return view('dashboard', ['recipes' => $recipes, 'jenres' => $jenres, 'request' => $request]); 
        }
        //キーワードだけ設定されているとき
        if (isset($request->keyword)) {
            //レシピが存在するか
            if (Recipe::where('name', 'LIKE', "%{$request->keyword}%")->exists()) {
                $recipes = Recipe::withCount('likes')->with('user')->where('name', 'LIKE', "%{$request->keyword}%")->latest()->get();
            }else {
                $recipes = null;
            }
            $jenres = Jenre::get();
            return view('dashboard', ['recipes' => $recipes, 'jenres' => $jenres, 'request' => $request]);  
        //ジャンルだけ選択されているとき
        } elseif (isset($request->jenre_id)) {
            //レシピが存在するか
            if (Recipe::where('jenre_id', $request->jenre_id)->exists()) {
                $recipes = Recipe::withCount('likes')->with('user')->where('jenre_id', $request->jenre_id)->latest()->get();
            }else {
                $recipes = null;
            }
            $jenres = Jenre::get();
            return view('dashboard', ['recipes' => $recipes, 'jenres' => $jenres, 'request' => $request]);     
        //ジャンル選択,キーワードもないとき
        } else {
            $recipes = Recipe::withCount('likes')->with('user')->latest()->get();
            $request = null;
            $jenres = Jenre::get();
            return view('dashboard', ['recipes' => $recipes, 'jenres' => $jenres, 'request' => $request]);
        }
       
    }

    //レシピアップロード処理
    public function uploadRecipe(Request $request) 
    { 
        //ディレクトリ名
        $dir = 'images';

        

        //バリデーション
        $request->validate([
            'name' => 'required|max:30',
            'recipe' => 'required | max:500',
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
    public function showMypage(Request $request) {
        if ($request->user()->role === 'user') {
            if (Recipe::where('user_id', $request->user()->id)->exists()) {
                $recipes = Recipe::withCount('likes')->with('user')->where('user_id', $request->user()->id)->latest()->get();
            }else {
                $recipes = null;
            }

            if (Comment::where('user_id', $request->user()->id)->exists()) {
                $comments = Comment::with('user')->where('user_id', $request->user()->id)->latest()->get();
            }else {
                $comments = null;
            }
            
            if (Like::where('user_id', $request->user()->id)->exists()) {
                $likes = Like::where('user_id', $request->user()->id)->latest()->get();
            } else {
                $likes = null;
            }

            return view('user_mypage', ['recipes' => $recipes, 'comments' => $comments, 'request' => $request, 'likes' => $likes]);
        } elseif ($request->user()->role === 'admin') {
            $users_user = User::where('role', 'user')->latest()->get();
            $users_admin = User::where('role', 'admin')->latest()->get();
            return view('admin_mypage', ['users_user' => $users_user, 'users_admin' => $users_admin, 'request' => $request]);
        }
        
    }


    //ほかのユーザーの投稿一覧
    public function showUserRecipes(Request $request) 
    {
        if (Recipe::where('user_id', $request->user_id)->exists()) {
            $user_recipes = Recipe::withCount('likes')->with('user')->where('user_id', $request->user_id)->latest()->get();
        }else {
            $user_recipes = null;
        }
        
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
            'recipe' => 'required | max:500',
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


    //レシピ削除実行
    public function recipeDel(Recipe $recipe) 
    {
        // dd(Auth::user()->role);
        $recipe->delete();

        if (Auth::user()->role === 'user') {
            return redirect('user_mypage');
        } else {
            return redirect('dashboard');
        }
        
    }


    //いいねランキングページ
    public function rank(Request $request) 
    {
        if (isset($request->jenre_id)) {
            if (Recipe::where('jenre_id', $request->jenre_id)->exists()) {
                $recipes = Recipe::withCount('likes')->with('user')->where('jenre_id', $request->jenre_id)->orderBy('likes_count', 'desc')->orderBy('created_at', 'desc')->get();
            }else {
                $recipes = null;
            }
        } else {
            $recipes = Recipe::withCount('likes')->with('user')->orderBy('likes_count', 'desc')->orderBy('created_at', 'desc')->get();
            $request = null;
        }

        $jenres = Jenre::get();
        return view('rank', ['recipes' => $recipes, 'jenres' => $jenres, 'request' => $request]);
    }
}
