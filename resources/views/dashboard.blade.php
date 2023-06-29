<x-app-layout>
    <div class="mt-10">
        {{-- ジャンルボタン --}}
        <div class="pb-2 border-b border-gray-400">
            <div class="w-11/12 mx-auto">
                    <form action="{{ route('dashboard') }}" method="get">
                        @csrf
                        <div class="flex justify-between mb-4">
                            <input class="h-8 w-9/12 border rounded" type="text" name="keyword" placeholder="レシピ名" value="@if (isset($request->keyword)){{ $request->keyword }}@endif">
                            <button class="w-2/12 font-bold border border-gray-300 rounded bg-white">検索</button>
                        </div>

                        <div class="mx-auto flex flex-wrap">
                            @if ($request === null || $request->jenre_id === null)
                                @foreach ($jenres as $jenre)
                                <div class="mb-2">
                                    <input type="radio" class="hidden" name="jenre_id" id="{{ $jenre->jenre }}" value="{{ $jenre->id }}" />
                                    <label for="{{ $jenre->jenre }}" class="jenre-btn mx-1 p-1 border border-gray-300 rounded">{{ $jenre->jenre }}</label>
                                </div>
                                @endforeach
                                <div class="mb-2">
                                    <input type="radio" class="hidden" name="jenre_id" id="all" value="" checked />
                                    <label for="all" class="jenre-btn jenre-active mx-1 p-1 border border-gray-300 rounded">すべて</label>
                                </div>
                            @else
                                @foreach ($jenres as $jenre)
                                    @if ($request->jenre_id == $jenre->id)
                                        <div class="mb-2">
                                            <input type="radio" class="hidden" name="jenre_id" id="{{ $jenre->jenre }}" value="{{ $jenre->id }}" checked />
                                            <label for="{{ $jenre->jenre }}" class="jenre-btn jenre-active mx-1 p-1 border border-gray-300 rounded">{{ $jenre->jenre }}</label>
                                        </div>
                                    @else
                                        <div class="mb-2">
                                            <input type="radio" class="hidden" name="jenre_id" id="{{ $jenre->jenre }}" value="{{ $jenre->id }}" />
                                            <label for="{{ $jenre->jenre }}" class="jenre-btn mx-1 p-1 border border-gray-300 rounded">{{ $jenre->jenre }}</label>
                                        </div>
                                    @endif
                                @endforeach
                                
                                <div class="mb-2">
                                    <input type="radio" class="hidden" name="jenre_id" id="all" value=""/>
                                    <label for="all" class="jenre-btn mx-1 p-1 border border-gray-300 rounded">すべて</label>
                                </div>
                            @endif
                        </div>
                    </form>
                
                
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
