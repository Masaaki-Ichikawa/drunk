<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //コメントページ表示
    public function commentForm(Request $request) {
        // dd($request);
        return view('comment', ['value' => $request]);
    }

    //コメント投稿実行
    public function uploadComment(Request $request) {
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->recipe_id = $request->recipe_id;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->route('recipe_detail', ['recipe_id' => $request->recipe_id]);
    }

    //コメント削除確認
    public function commentDelConf(Comment $comment)
    {
        return view('comment_del_conf', ['comment' => $comment]);
    }


    //コメント削除実行
    public function commentDel(Comment $comment) 
    {
        $comment->delete();
        return redirect('user_mypage');
    }

}
