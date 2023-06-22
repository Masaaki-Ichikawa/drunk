<x-app-layout>
    <div id="recipe" class="pt-12 border-y border-gray-400 flex justify-around">
        <p class="text-xl">{{ $request->user()->name }}<a href="{{ route('profile.edit') }}"><i class="fa-solid fa-gear ml-1"></i></a></p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-xl">ログアウト</button>
        </form>
    </div>

    <div class="py-6 flex justify-end">
        <div class="w-1/2 mr-4 flex justify-between">
            <p class="font-bold text-2xl">管理者</p>
            <a href="#user" class="px-2">ユーザー</a>
        </div>
    </div>
    
    @foreach ($users_admin as $admin)
    <div class="w-full border-b border-gray-300">
        {{-- アカウント名、時間 --}}
        <div class="w-11/12 mx-auto mt-1">
            <div class="flex">
                <a class="text-xl" href="">{{ $admin->name }}</a>
                {{-- <a class="text-sm mt-1 pl-1" href="">{{ $admin->created_at }}</a> --}}
            </div>

            {{-- ユーザー --}}
            <div class="ml-4">
                    <p>メール：{{ $admin->email }}</p>
                    <p>権限：{{ $admin->role }}</p>
                <div class="my-2 flex justify-between">
                    <a class="px-1 bg-white border border-gray-300 rounded" href="{{ route('user_recipes', ['user_id' => $admin->id, 'user_name' => $admin->name]) }}">投稿一覧</a>
                    <a class="text-red-600" href="{{ route('user_del', $admin->id) }}" onclick="return delConf()">削除</a>
                </div>                
            </div>
                
        </div>
    </div>
    @endforeach

    <div id="user" class="pb-6 pt-24 flex justify-end">
        <div class="w-1/2 mr-4 flex justify-between">
            <p class="font-bold text-2xl">ユーザー</p>
            <a href="#recipe" class="px-2">管理者</a>
        </div>
    </div>

    @foreach ($users_user as $user)
    <div class="w-full border-b border-gray-300">
        {{-- アカウント名、時間 --}}
        <div class="w-11/12 mx-auto mt-1">
            <div class="flex">
                <a class="text-xl" href="">{{ $user->name }}</a>
                {{-- <a class="text-sm mt-1 pl-1" href="">{{ $user->created_at }}</a> --}}
            </div>

            {{-- ユーザー --}}
            <div class="ml-4">
                    <p>メール：{{ $user->email }}</p>
                    <p>権限：{{ $user->role }}</p>
                <div class="my-2 flex justify-between">
                    <a class="px-1 bg-white border border-gray-300 rounded" href="{{ route('user_recipes', ['user_id' => $user->id, 'user_name' => $user->name]) }}">投稿一覧</a>
                    <a class="text-red-600" href="{{ route('user_del', $user->id) }}" onclick="return delConf()">削除</a>
                </div>                
            </div>
                
        </div>
    </div>
    @endforeach
</x-app-layout>