<x-app-layout>  
    {{-- {{ dd($recipe); }} --}}

    <div class="pt-12 pb-2 border-b-2 border-gray-300 flex justify-around">
        <p class="font-semibold text-3xl">レシピ詳細</p>
    </div>
        @foreach ($recipe as $recipe_detail)
            <div class="pb-4 flex flex-col items-center border-b-2 border-gray-300">
                <p>{{ $recipe_detail->user->name }}</p>
                <p class="text-3xl mt-4">{{ $recipe_detail->name }}</p>

                <img class="w-1/2 h-1/2 pt-6" src="{{ asset($recipe_detail->image_path) }}" alt="">

                <p for="recipe" class="text-xl text-gray-500 pt-8 mx-6">{!! nl2br( $recipe_detail->recipe) !!}</p>
            </div>

            @foreach ($comments as $comment)
                <div class="w-11/12 mx-auto mt-1 border-b border-gray-300">
                    <div class="flex">
                        <a class="text-lg" href="{{ route('user_recipes', ['user_id' => $comment->user->id, 'user_name' => $comment->user->name]) }}">{{ $comment->user->name }}</a>
                        <a class="text-sm mt-1 pl-1" href="{{ route('user_recipes', ['user_id' => $comment->user->id, 'user_name' => $comment->user->name]) }}">{{ $comment->created_at }}</a>
                    </div>
                    <p class="ml-6">{!! nl2br( $comment->comment) !!}</p>
                </div>
            @endforeach

            <form class="flex justify-center mt-4" action="{{ route('comment') }}" method="get">
                <input type="hidden" name="user_id" value="{{ $recipe_detail->user->id }}">
                <input type="hidden" name="recipe_id" value="{{ $recipe_detail->id }}">
                <button class="comment-btn mx-auto">
                    <i class="fa-regular fa-comment-dots text-xl"></i>
                    コメントを追加
                </button>
            </form>
        @endforeach
        
        
</x-app-layout>