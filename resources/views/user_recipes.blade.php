<x-app-layout>    
    <div class="pt-12 border-y border-gray-400 flex justify-around">
        <p class="text-2xl">{{ $request->user_name }}さんのレシピ</p>
    </div>

    @if ($user_recipes === null)
        <h2 class="text-center mt-12">レシピが存在しません</h2>
    @else
        @foreach ($user_recipes as $user_recipe)
            <div class="w-full pb-4 border-b border-gray-300">
                <div class="w-11/12 mx-auto mt-1">
                    {{-- レシピ --}}
                    <div>
                        <a href="{{route('recipe_detail', ['recipe_id' => $user_recipe->id])}}" class="flex mt-2">
                                <img class="mr-4 object-cover w-2/5 h-36" src="{{ asset($user_recipe->image_path) }}" alt="">
                            
                            <div class="w-1/2">
                                <p class="font-bold text-2xl">{{ $user_recipe->name }}</p>
                                <p class="txt-limit text-sm">{!! nl2br( $user_recipe->recipe) !!}</p>
                                <p class="text-gray-500 text-xs">reciped by{{ $user_recipe->user->name }}</p>
                            </div>                       
                        </a>
                        <div class="flex justify-around mt-4 mb-3">
                            @if (!$user_recipe->isLikedBy(Auth::user()))
                                <span class="likes">
                                    <i class="fa-regular fa-thumbs-up text-xl like-toggle" data-recipe-id="{{ $user_recipe->id }}"></i>
                                <span class="like-counter">{{$user_recipe->likes_count}}</span>
                                </span><!-- /.likes -->
                            @else
                                <span class="likes">
                                    <i class="fa-solid fa-thumbs-up text-xl like-toggle liked" data-recipe-id="{{ $user_recipe->id }}"></i>
                                <span class="like-counter">{{$user_recipe->likes_count}}</span>
                                </span><!-- /.likes -->
                            @endif

                            <form action="{{ route('comment') }}" method="get">
                                <input type="hidden" name="user_id" value="{{ $user_recipe->user->id }}">
                                <input type="hidden" name="recipe_id" value="{{ $user_recipe->id }}">
                                <button class="comment-btn">
                                    <i class="fa-regular fa-comment-dots text-xl"></i>
                                </button>
                            </form>                     
                        </div>        
                    </div>                
                </div>
            </div>
        @endforeach
    @endif
</x-app-layout>