<x-app-layout>
    <div id="recipe" class="pt-12 border-y border-gray-400 flex justify-around">
        <p class="text-xl">{{ $request->user()->name }}<a href="{{ route('profile.edit') }}"><i class="fa-solid fa-gear ml-1"></i></a></p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-xl">ログアウト</button>
        </form>
    </div>

    @foreach ($users as $user)
    <div class="w-full border-b border-gray-300">
        {{-- アカウント名、時間 --}}
        <div class="w-11/12 mx-auto mt-1">
            <div class="flex">
                <a class="text-xl" href="">{{ $user->name }}</a>
                <a class="text-sm mt-1 pl-1" href="">{{ $user->created_at }}</a>
            </div>

            {{-- ユーザー --}}
            <div class="ml-4 flex justify-between">
                <div>
                    <p>メール：{{ $user->email }}</p>
                    <a href="{{ route('user_recipes', ['user_id' => $user->id, 'user_name' => $user->name]) }}">投稿一覧</a>
                </div>
                <a href="{{ route('user_del_conf', $user->id) }}"><i class="fa-regular fa-trash-can"></i></a>
            </div>
                
        </div>
    </div>
    @endforeach
</x-app-layout>