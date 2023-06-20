<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;


class LikeController extends Controller
{
    //いいね
    public function like(Request $request)
{
    $user_id = Auth::user()->id; //1.ログインユーザーのid取得
    $recipe_id = $request->recipe_id; //2.投稿idの取得
    $already_liked = Like::where('user_id', $user_id)->where('recipe_id', $recipe_id)->first(); //3.

    if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
        $like = new Like; //4.Likeクラスのインスタンスを作成
        $like->recipe_id = $recipe_id; //Likeインスタンスにrecipe_id,user_idをセット
        $like->user_id = $user_id;
        $like->save();
    } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
        Like::where('recipe_id', $recipe_id)->where('user_id', $user_id)->delete();
    }
    //5.この投稿の最新の総いいね数を取得
    $recipe_likes_count = Recipe::withCount('likes')->findOrFail($recipe_id)->likes_count;
    $param = [
        'recipe_likes_count' => $recipe_likes_count,
    ];
    return response()->json($param); //6.JSONデータをjQueryに返す
}

}
