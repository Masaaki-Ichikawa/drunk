<x-app-layout>
    <div id="recipe" class="pt-12 border-y border-gray-400 flex justify-around">
        <p class="text-xl">{{ $request->user()->name }}<a href="{{ route('profile.edit') }}"><i class="fa-solid fa-gear ml-1"></i></a></p>

        <a class="px-1 mb-1 bg-white border border-gray-300 rounded" href="{{ route('register_admin_form') }}">管理者を追加</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-xl">ログアウト</button>
        </form>
    </div>

    <div class="my-4 flex justify-center">
        <p class="font-bold text-2xl">管理者</p>
    </div>
    
    @foreach ($users_admin as $admin)
    <div class="w-full border-b border-gray-300">
        {{-- アカウント名、時間 --}}
        <div class="w-11/12 mx-auto mt-1">
            <div class="flex">
                <a class="text-xl" href="">{{ $admin->name }}</a>
                <a class="text-sm mt-1 pl-1" href="">{{ $admin->created_at }}</a>
            </div>

            {{-- ユーザー --}}
            <div class="ml-4">
                    <p>メール：{{ $admin->email }}</p>
                    <p>権限：{{ $admin->role }}</p>
                <div class="my-2 flex justify-between">
                    <a class="px-1 bg-white border border-gray-300 rounded" href="{{ route('user_recipes', ['user_id' => $admin->id, 'user_name' => $admin->name]) }}">投稿一覧</a>
                    <a class="text-red-600" href="{{ route('user_del_conf', $admin->id) }}">削除</a>
                </div>                
            </div>
                
        </div>
    </div>
    @endforeach

    <div class="my-4 flex justify-center">
        <p class="font-bold text-2xl">ユーザー</p>
    </div>

    @foreach ($users_user as $user)
    <div class="w-full border-b border-gray-300">
        {{-- アカウント名、時間 --}}
        <div class="w-11/12 mx-auto mt-1">
            <div class="flex">
                <a class="text-xl" href="">{{ $user->name }}</a>
                <a class="text-sm mt-1 pl-1" href="">{{ $user->created_at }}</a>
            </div>

            {{-- ユーザー --}}
            <div class="ml-4">
                    <p>メール：{{ $user->email }}</p>
                    <p>権限：{{ $user->role }}</p>
                <div class="my-2 flex justify-between">
                    <a class="px-1 bg-white border border-gray-300 rounded" href="{{ route('user_recipes', ['user_id' => $user->id, 'user_name' => $user->name]) }}">投稿一覧</a>
                    <a class="text-red-600" href="{{ route('user_del_conf', $user->id) }}">削除</a>
                </div>                
            </div>
                
        </div>
    </div>
    @endforeach
</x-app-layout>