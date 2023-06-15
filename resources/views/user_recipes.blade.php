<x-app-layout>    
    <div class="pt-12 border-y border-gray-400 flex justify-around">
        <p class="text-2xl">{{ $request->user_name }}</p>
    </div>

    @foreach ($user_recipes as $user_recipe)
        <div class="w-full pb-4 border-b border-gray-300">
            {{-- アカウント名、時間 --}}
            <div class="w-11/12 mx-auto mt-1">
                <div class="flex">
                    <a class="text-xl" href="">{{ $user_recipe->user->name }}</a>
                    <a class="text-sm mt-1 pl-1" href="">{{ $user_recipe->created_at }}</a>
                </div>

                {{-- レシピ --}}
                <div  class="flex mt-2">
                    <img class="w-1/3 mr-4  max-h-1/3" src="{{ asset($user_recipe->image_path) }}" alt="">
                    <div class="mx-auto">
                        <p class="text-lg text-center">{{ $user_recipe->name }}</p>
                        <p class="txt-limit">{!! nl2br( $user_recipe->recipe) !!}</p>
                        <form action="{{route('recipe_detail')}}" method="get">
                            <input type="hidden" name="recipe_id" value="{{ $user_recipe->id }}">
                            <button class="text-blue-500 mx-auto">レシピ詳細へ</button>
                        </form>
                    </div>
                    <input type="hidden" name="id" value="{{ $user_recipe->id }}">                        
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>