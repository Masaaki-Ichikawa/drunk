<x-app-layout>    
    <div id="recipe" class="pt-12 border-y border-gray-400 flex justify-around">
        <p class="text-xl">{{ $request->user()->name }}<a href="{{ route('profile.edit') }}"><i class="fa-solid fa-gear ml-1"></i></a></p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-xl">ログアウト</button>
        </form>
    </div>

    <div class="pt-6 pb-3 flex justify-end border border-b-gray-300">
        <div class="w-1/2 mr-4 flex justify-between">
            <p class="text-xl font-bold">レシピ</p>
            <a href="#comment" class="font-bold border border-gray-400 rounded px-2">コメント一覧</a>
        </div>
    </div>

    <div id="recipe">
        @if ($recipes === null)
            <h2 class="text-center mt-12">レシピが存在しません</h2>
        @else
            @foreach ($recipes as $recipe)
                <div class="w-full border-b border-gray-300">
                    <div class="w-11/12 mx-auto mt-1">

                        {{-- レシピ --}}
                        <div>
                            <a href="{{route('recipe_detail', ['recipe_id' => $recipe->id])}}" class="flex mt-2">
                                    <img class="mr-4 object-cover w-2/5 h-36" src="{{ asset($recipe->image_path) }}" alt="">
                                
                                <div class="w-1/2">
                                    <p class="font-bold text-2xl">{{ $recipe->name }}</p>
                                    <p class="txt-limit text-sm">{!! nl2br( $recipe->recipe) !!}</p>
                                    <p class="text-gray-500 text-xs">reciped by{{ $recipe->user->name }}</p>
                                </div>                       
                            </a>
                        </div>

                        <div class="flex justify-around mt-4 mb-3">
                            @if (!$recipe->isLikedBy(Auth::user()))
                                <span class="likes">
                                    <i class="fa-regular fa-thumbs-up text-xl like-toggle" data-recipe-id="{{ $recipe->id }}"></i>
                                <span class="like-counter">{{$recipe->likes_count}}</span>
                                </span><!-- /.likes -->
                            @else
                                <span class="likes">
                                    <i class="fa-regular fa-thumbs-up text-xl like-toggle liked" data-recipe-id="{{ $recipe->id }}"></i>
                                <span class="like-counter">{{$recipe->likes_count}}</span>
                                </span><!-- /.likes -->
                            @endif

                            <form action="{{ route('comment') }}" method="get">
                                <input type="hidden" name="user_id" value="{{ $recipe->user->id }}">
                                <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                                <button class="comment-btn">
                                    <i class="fa-regular fa-comment-dots text-xl"></i>
                                </button>
                            </form>   
                            
                            <a href="{{ route('recipe_edit', $recipe->id) }}"><i class="fa-solid fa-pencil"></i></a>       
                                    
                            <a href="{{ route('recipe_del', $recipe->id) }}" onclick="return delConf()"><i class="fa-regular fa-trash-can"></i></a>                  
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div id="comment" class="pb-3 pt-24 flex justify-end border-b border-gray-300">
        <div class="w-1/2 mr-4 flex justify-between">
            <p class="text-xl font-bold">コメント</p>
            <a href="#recipe" class="font-bold border border-gray-400 rounded px-2">レシピ一覧</a>
        </div>
    </div>

    <div>
        @if ($comments === null)
            <h2 class="text-center mt-12">コメントが存在しません</h2>
        @else
            @foreach ($comments as $comment)
                <div class="w-11/12 mx-auto mt-1 border-b border-gray-300">
                    <a href="{{route('recipe_detail', ['recipe_id' => $comment->recipe->id])}}" class="">
                        <p class="font-medium text-gray-500">{{ $comment->user->name }}</p>
                        <p class="ml-6">{!! nl2br( $comment->comment) !!}</p>
                    </a>
                    

                    <div class="flex justify-around mt-4 mb-3">
                        <a href="{{ route('comment_del', $comment->id) }}" onclick="return delConf()"><i class="fa-regular fa-trash-can"></i></a>                  
                    </div>
                </div>        
            @endforeach
        @endif
    </div>
</x-app-layout>