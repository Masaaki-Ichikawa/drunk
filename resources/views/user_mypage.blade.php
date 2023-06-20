<x-app-layout>    
    <div id="recipe" class="pt-12 border-y border-gray-400 flex justify-around">
        <p class="text-xl">{{ $request->user()->name }}<a href="{{ route('profile.edit') }}"><i class="fa-solid fa-gear ml-1"></i></a></p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-xl">ログアウト</button>
        </form>
    </div>

    <div class="py-6 flex justify-end">
        <div class="w-1/2 mr-4 flex justify-between">
            <p class="text-xl">レシピ</p>
            <a href="#comment" class="border border-gray-400 rounded px-2">コメント一覧</a>
        </div>
    </div>

    <div id="recipe">
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
                            <img class="w-1/3 mr-4  max-h-1/3" src="{{ asset($recipe->image_path) }}" alt="">
                            <div class="mx-auto">
                                <p class="text-lg text-center">{{ $recipe->name }}</p>
                                <p class="txt-limit">{!! nl2br( $recipe->recipe) !!}</p>
                                <form action="{{route('recipe_detail')}}" method="get">
                                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                                    <button class="text-blue-500 mx-auto">レシピ詳細へ</button>
                                </form>
                            </div>
                            <input type="hidden" name="id" value="{{ $recipe->id }}">                        
                        </div>
                    </div>

                    <div class="flex justify-around mt-4 mb-3">
                        @if (!$recipe->isLikedBy(Auth::user()))
                            <span class="likes">
                                <i class="fa-regular fa-thumbs-up text-xl like-toggle" data-recipe-id="{{ $recipe->id }}"></i>
                            <span class="like-counter">{{$recipe->likes_count}}</span>
                            </span><!-- /.likes -->
                        @else
                            <span class="likes">
                                <i class="fa-solid fa-thumbs-up text-xl heart like-toggle liked" data-recipe-id="{{ $recipe->id }}"></i>
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
                                
                        <a href="{{ route('recipe_del_conf', $recipe->id) }}"><i class="fa-regular fa-trash-can"></i></a>                  
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="comment" class="pb-6 pt-24 flex justify-end">
        <div class="w-1/2 mr-4 flex justify-between">
            <p class="text-xl">コメント</p>
            <a href="#recipe" class="border border-gray-400 rounded px-2">レシピ一覧</a>
        </div>
    </div>

    <div>
        @foreach ($comments as $comment)
            <div class="w-11/12 mx-auto mt-1 border-b border-gray-300">
                <div class="flex">
                    <a class="text-lg" href="{{ route('user_recipes', ['user_id' => $comment->user->id, 'user_name' => $comment->user->name]) }}">{{ $comment->user->name }}</a>
                    <a class="text-sm mt-1 pl-1" href="{{ route('user_recipes', ['user_id' => $comment->user->id, 'user_name' => $comment->user->name]) }}">{{ $comment->created_at }}</a>
                </div>
                <p class="ml-6">{!! nl2br( $comment->comment) !!}</p>

                <div class="flex justify-around mt-4 mb-3">
                    <a href="{{ route('comment_del_conf', $comment->id) }}"><i class="fa-regular fa-trash-can"></i></a>                  
                </div>
            </div>        
        @endforeach
    </div>
</x-app-layout>