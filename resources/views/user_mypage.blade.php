<x-app-layout>    
    <div class="pt-12 border-y border-gray-400 flex justify-around">
        <p class="text-xl">アカウント名<a href="{{ route('profile.edit') }}"><i class="fa-solid fa-gear"></i></a></p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-xl">ログアウト</button>
        </form>
    </div>

    @foreach ($recipes as $recipe)
            <div class="w-full border-b border-gray-300">
                <div class="w-11/12 mx-auto">
                    <div class="flex">
                        <a class="text-xl" href="">{{ $recipe->user->name }}</a>
                        <a class="text-sm mt-1 pl-1" href="">{{ $recipe->created_at }}</a>
                    </div>
                    <a href="" class="flex">
                        <img class="w-1/3" src="{{ asset($recipe->image_path) }}" alt="">
                        <div class="mx-auto">
                            <p class="text-lg">{{ $recipe->name }}</p>
                            <p>{{ $recipe->recipe }}</p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
</x-app-layout>