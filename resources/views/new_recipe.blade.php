<x-app-layout>    
    <div class="pt-12 border-y border-gray-400 flex justify-around">
        <p class="font-semibold text-3xl">新規投稿</p>
    </div>

    <form class="flex flex-col items-center" action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label class="text-xl" for="name">レシピ名</label>
        <input class="border-gray-300 rounded" name="name" type="text">

        <label for="image" class="text-xl mt-6">画像選択</label>

        <div class="w-1/2 h-1/2 pt-6" id="preview"></div>

        <input id="image" class="mt-6" name="image" type="file" onchange="preview(this);">

        <label for="recipe" class="text-xl pt-8">レシピ説明</label>
        <textarea id="recipe" class="border-gray-300 resize-none rounded" name="recipe" cols="30" rows="20"></textarea>

        <p class="text-xl pt-8">ジャンル選択</p>
        <div class="radiobox flex">
            @foreach ($jenres as $jenre)
                <div>
                    <input type="radio" class="hidden peer" name="jenre_id" id="{{ $jenre->name }}" value="{{ $jenre->id }}" />
                    <label for="{{ $jenre->name }}" class="mx-1 p-1 border border-gray-300 rounded peer-checked:bg-green-500 peer-checked:text-gray-50 ">{{ $jenre->name }}</label>
                </div>
            @endforeach           
        </div>

        <button class="px-10 py-2 mt-10 border border-gray-500 rounded">投稿</button>
    </form>
   
</x-app-layout>