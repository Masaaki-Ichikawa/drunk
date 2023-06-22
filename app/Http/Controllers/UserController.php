<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    //管理者登録
    public function adminRegister(Request $request) 
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = 'admin';
        $user->save();

        return redirect('user_mypage');
    }


    //ユーザー削除実行
    public function userDel(User $user)
    {
        $user->delete();
        return redirect('user_mypage');
    }


    
}
