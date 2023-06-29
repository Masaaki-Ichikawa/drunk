<x-app-layout>
    <div class="mt-10">
        {{-- ジャンルボタン --}}
        <div class="pb-2 border-b border-gray-400">
            <h1 class="font-bold text-xl text-center mb-4">ランキング</h1>
            <div class="w-11/12 mx-auto flex flex-wrap">
                @if ($request === null)
                    @foreach ($jenres as $jenre)
                        <form class="mb-2" action="{{ route('rank') }}" method="get">
                            @csrf
                            <input type="hidden" name="jenre_id" id="{{ $jenre->jenre }}" value="{{ $jenre->id }}" />
                            <button class="mx-1 px-1 border border-gray-300 rounded bg-white">{{ $jenre->jenre }}</button>
                        </form>
                    @endforeach
                        <form class="mb-2" action="{{ route('rank') }}" method="get">
                            <input type="radio" class="hidden peer" name="jenre_id" id="all" value="all" />
                            <button class="mx-1 px-1 border border-gray-300 rounded bg-fuchsia-500 text-gray-50">すべて</button>
                        </form>
                @else
                    @foreach ($jenres as $jenre)
                        <form class="mb-2" action="{{ route('rank') }}" method="get">
                            @csrf
                            @if ($request->jenre_id == $jenre->id)
                                <input type="hidden" name="jenre_id" id="{{ $jenre->jenre }}" value="{{ $jenre->id }}" />
                                <button class="mx-1 px-1 border border-gray-300 rounded bg-fuchsia-500 text-gray-50">{{ $jenre->jenre }}</button>
                            @else
                                <input type="hidden" name="jenre_id" id="{{ $jenre->jenre }}" value="{{ $jenre->id }}" />
                                <button class="mx-1 px-1 border border-gray-300 rounded bg-white">{{ $jenre->jenre }}</button>
                            @endif
                            
                        </form>
                    @endforeach
                        <form class="mb-2" action="{{ route('rank') }}" method="get">
                            <input type="radio" class="hidden peer" name="jenre_id" id="all" value="all" />
                            <button class="mx-1 px-1 border border-gray-300 rounded bg-white">すべて</button>
                        </form>                    
                @endif
            </div>
        </div>


        {{-- レシピ --}}
        @if ($recipes === null)
            <h2 class="text-center mt-12">レシピが存在しません</h2>
        @else
            @foreach ($recipes as $recipe)
                <div class="w-full border-b border-gray-300">
                    <div class="w-11/12 mx-auto mt-1">
                        
                        {{-- レシピ --}}
                        <a href="{{route('recipe_detail', ['recipe_id' => $recipe->id])}}" class="flex mt-2">
                                <img class="mr-4 object-cover w-2/5 h-36" src="{{ asset($recipe->image_path) }}" alt="">
                            
                            <div class="w-1/2">
                                <p class="font-bold text-2xl">{{ $recipe->name }}</p>
                                <p class="txt-limit text-sm">{!! nl2br( $recipe->recipe) !!}</p>
                                <p class="text-gray-500 text-xs">reciped by{{ $recipe->user->name }}</p>
                            </div>                       
                        </a>
                        

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
                        </div>
                    </div>
                </div>
            @endforeach
            
        @endif
    </div>
</x-app-layout>
