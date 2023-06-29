<x-app-layout>  
        @foreach ($recipe as $recipe_detail)
            <div class="pt-12 pb-2 flex flex-col items-center border-b-2 border-gray-300">
                <p class="font-bold text-3xl mt-4">{{ $recipe_detail->name }}</p>

                <img class="w-11/12 pt-6" src="{{ asset($recipe_detail->image_path) }}" alt="">

                <p for="recipe" class="w-11/12 text-lg pt-8 mx-6">{!! nl2br( $recipe_detail->recipe) !!}</p>

                <a class="font-bold text-md mt-8" href="{{ route('user_recipes', ['user_id' => $recipe_detail->user->id, 'user_name' => $recipe_detail->user->name]) }}">{{ $recipe_detail->user->name }}さんのレシピ一覧へ</a>
            </div>

            

            @foreach ($comments as $comment)
                <div class="w-11/12 mx-auto mt-1 border-b border-gray-300">
                    <div class="flex">
                        <a class="font-medium text-gray-500" href="{{ route('user_recipes', ['user_id' => $comment->user->id, 'user_name' => $comment->user->name]) }}">{{ $comment->user->name }}</a>
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