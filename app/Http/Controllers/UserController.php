<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //ユーザー削除確認ページ
    public function userDelConf(User $user)
    {
        return view('user_del_conf', ['user' => $user]);
    }


    //ユーザー削除実行
    public function userDel(User $user)
    {
        $user->delete();
        return redirect('user_mypage');
    }
}
