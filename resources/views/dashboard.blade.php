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
                        <a class="text-xl" href="">{{ $recipe->user->name }}</a>
                        <a class="text-sm mt-1 pl-1" href="">{{ $recipe->created_at }}</a>
                    </div>

                    {{-- レシピ --}}
                    <a href="" class="flex mt-2">
                        <img class="w-1/3" src="{{ asset($recipe->image_path) }}" alt="">
                        <div class="mx-auto">
                            <p class="text-lg">{{ $recipe->name }}</p>
                            <p>{{ $recipe->recipe }}</p>
                        </div>
                    </a>

                    <div class="flex justify-around mt-4 mb-3">
                        <a href="">
                            <i class="fa-regular fa-thumbs-up text-xl"></i>
                        </a>

                        <a href="">
                            <i class="fa-regular fa-comment-dots text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
