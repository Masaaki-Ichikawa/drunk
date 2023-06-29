<x-app-layout>
    <div id="recipe" class="pt-12 border-y border-gray-400 flex justify-around">
        <p class="text-xl">{{ $request->user()->name }}<a href="{{ route('profile.edit') }}"><i class="fa-solid fa-gear ml-1"></i></a></p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-xl">ログアウト</button>
        </form>
    </div>

    <p id="tabcontrol" class="flex justify-around mt-8 mb-6">
        <a href="#admins" class="font-bold text-xl">管理者</a>
        <a href="#users" class="font-bold text-xl">ユーザー</a>
    </p>

    <div id="tabbody">
        {{-- 管理者一覧 --}}
        <div id="admins" class="tab">
            @foreach ($users_admin as $admin)
            <div class="w-full border-b border-gray-300">
                {{-- アカウント名、時間 --}}
                <div class="w-11/12 mx-auto mt-1">
                    <div class="flex">
                        <a class="text-xl" href="">{{ $admin->name }}</a>
                        {{-- <a class="text-sm mt-1 pl-1" href="">{{ $admin->created_at }}</a> --}}
                    </div>

                    {{-- ユーザー --}}
                    <div class="ml-4 flex justify-between">
                        <div>
                            <p>メール：{{ $admin->email }}</p>
                            <p>権限：{{ $admin->role }}</p>
                        </div>
                            
                        <div class="my-2 flex justify-between">
                            <a class="text-red-600" href="{{ route('user_del', $admin->id) }}" onclick="return delConf()">削除</a>
                        </div>                
                    </div>                       
                </div>
            </div>
            @endforeach
        </div>

        {{-- ユーザー一覧 --}}
        <div id="users" class="tab">
            @foreach ($users_user as $user)
            <div class="w-full border-b border-gray-300">
                {{-- アカウント名、時間 --}}
                <div class="w-11/12 mx-auto mt-1">
                    <div class="flex">
                        <a class="text-xl" href="">{{ $user->name }}</a>
                        {{-- <a class="text-sm mt-1 pl-1" href="">{{ $user->created_at }}</a> --}}
                    </div>

                    {{-- ユーザー --}}
                    <div class="ml-4 flex justify-between">
                        <div>
                            <p>メール：{{ $admin->email }}</p>
                            <p>権限：{{ $admin->role }}</p>
                        </div>
                            
                        <div class="my-2 flex justify-between">
                            <a class="text-red-600" href="{{ route('user_del', $admin->id) }}" onclick="return delConf()">削除</a>
                        </div>                
                    </div>  
                </div>
            </div>
            @endforeach
        </div>
    </div>

    
</x-app-layout>
