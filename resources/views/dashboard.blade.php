<x-app-layout>
    <div class="mt-10">
        {{-- ジャンルボタン --}}
        <div class="pb-2 border-b border-gray-400">
            <div class="w-11/12 mx-auto flex flex-wrap">
                @foreach ($jenres as $jenre)
                    <form class="mb-2" action="{{ route('dashboard') }}" method="get">
                        @csrf
                        <input type="hidden" name="jenre_id" id="{{ $jenre->jenre }}" value="{{ $jenre->id }}" />
                        <button class="mx-1 px-1 border border-gray-300 rounded">{{ $jenre->jenre }}</button>
                    </form>
                @endforeach
                <form class="mb-2" action="{{ route('dashboard') }}" method="get">
                    <input type="radio" class="hidden peer" name="jenre_id" id="all" value="all" />
                    <button class="mx-1 px-1 border border-gray-300 rounded">すべて</button>
                </form>
            </div>
        </div>

        {{-- レシピ --}}
        @foreach ($recipes as $recipe)
            <div class="w-full border-b border-gray-300">
                {{-- アカウント名、時間 --}}
                <div class="w-11/12 mx-auto mt-1">
                    <div class="flex">
                        <a class="text-xl" href="{{ route('user_recipes', ['user_id' => $recipe->user->id, 'user_name' => $recipe->user->name]) }}">{{ $recipe->user->name }}</a>
                        <a class="text-sm mt-1 pl-1" href="{{ route('user_recipes', ['user_id' => $recipe->user->id, 'user_name' => $recipe->user->name]) }}">{{ $recipe->created_at }}</a>
                    </div>

                    {{-- レシピ --}}
                    <div  class="flex mt-2">
                        <img class="w-1/3 mr-4" src="{{ asset($recipe->image_path) }}" alt="">
                        <div class="mx-auto">
                            <p class="text-lg text-center">{{ $recipe->name }}</p>
                            <p class="txt-limit">{{ $recipe->recipe }}</p>
                            {{-- <a class="text-blue-500 mx-auto" href={{route('recipe_detail', $recipe->id)}}>レシピ詳細へ</a> --}}
                            <form action="{{route('recipe_detail')}}" method="get">
                                <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                                <button class="text-blue-500 mx-auto">レシピ詳細へ</button>
                            </form>
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
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
