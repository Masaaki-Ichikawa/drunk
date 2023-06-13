<x-app-layout>    
    <div class="pt-12 border-y border-gray-400 flex justify-around">
        <p class="text-xl">{{ $request->user()->name }}<a href="{{ route('profile.edit') }}"><i class="fa-solid fa-gear ml-1"></i></a></p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-xl">ログアウト</button>
        </form>
    </div>

    @foreach ($recipes as $recipe)
        <div class="w-full border-b border-gray-300">
            {{-- アカウント名、時間 --}}
            <div class="w-11/12 mx-auto mt-1">
                <div class="flex">
                    <a class="text-xl" href="">{{ $recipe->user->name }}</a>
                    <a class="text-sm mt-1 pl-1" href="">{{ $recipe->created_at }}</a>
                </div>

                {{-- レシピ --}}
                <div>
                    <div  class="flex mt-2">
                        <img class="w-1/3 mr-4" src="{{ asset($recipe->image_path) }}" alt="">
                        <div class="mx-auto">
                            <p class="text-lg text-center">{{ $recipe->name }}</p>
                            <p class="txt-limit">{{ $recipe->recipe }}</p>
                            <form action="{{route('recipe_detail')}}" method="get">
                                <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                                <button class="text-blue-500 mx-auto">レシピ詳細へ</button>
                            </form>
                        </div>
                        <input type="hidden" name="id" value="{{ $recipe->id }}">                        
                    </div>
                </div>

                <div class="flex justify-around mt-4 mb-3">
                    <a href="">
                        <i class="fa-regular fa-thumbs-up text-xl"></i>
                    </a>

                    <form action="{{ route('comment') }}" method="get">
                        <input type="hidden" name="user_id" value="{{ $recipe->user->id }}">
                        <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                        <button class="comment-btn">
                            <i class="fa-regular fa-comment-dots text-xl"></i>
                        </button>
                    </form>   
                    
                    <a href=""><i class="fa-solid fa-pencil"></i></a>       
                               
                    <a href=""><i class="fa-regular fa-trash-can"></i></a>                  
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>