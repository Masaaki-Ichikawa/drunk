<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function commentForm(Request $request) {
        // dd($request);
        return view('comment', ['value' => $request]);
    }

    public function uploadComment(Request $request) {
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->recipe_id = $request->recipe_id;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->route('recipe_detail', ['recipe_id' => $request->recipe_id]);
    }
}
