<x-app-layout>    
    <div class="pt-12 border-y border-gray-400 flex justify-around">
        <p class="text-xl">アカウント名<a href="{{ route('profile.edit') }}"><i class="fa-solid fa-gear"></i></a></p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-xl">ログアウト</button>
        </form>
    </div>
</x-app-layout>