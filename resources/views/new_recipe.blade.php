<x-app-layout>    
    <div class="pt-12 border-y border-gray-400 flex justify-around">
        <p class="font-semibold text-3xl">新規投稿</p>
    </div>

    <form class="flex flex-col items-center" action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label class="text-xl" for="name">レシピ名</label>
        @if ($errors->has('name'))
            <p class="text-red-500">{{ $errors->first('name') }}</p>
        @endif
        <input class="border-gray-300 rounded" name="name" type="text" value="{{ old('name') }}">

        <label for="image" class="text-xl mt-6">画像選択</label>
        @if ($errors->has('image'))
        <p class="text-red-500">{{ $errors->first('image') }}</p>
        @endif
        <div class="w-1/2 h-1/2 pt-6" id="preview"></div>

        <input id="image" class="mt-6" name="image" type="file" onchange="imgPreView(event)">

        <label for="recipe" class="text-xl pt-8">レシピ</label>
        @if ($errors->has('recipe'))
            <p class="text-red-500">{{ $errors->first('recipe') }}</p>
        @endif
        <textarea id="recipe" class="border-gray-300 resize-none rounded" name="recipe" cols="30" rows="20">{{ old('recipe') }}</textarea>

        <p class="text-xl pt-8">ジャンル選択</p>
        @if ($errors->has('jenre_id'))
            <p class="text-red-500">{{ $errors->first('jenre_id') }}</p>
        @endif
        <div class="radiobox flex">
            @foreach ($jenres as $jenre)
                <div>
                    <input type="radio" class="hidden peer" name="jenre_id" id="{{ $jenre->jenre }}" value="{{ $jenre->id }}" />
                    <label for="{{ $jenre->jenre }}" class="mx-1 p-1 border border-gray-300 rounded peer-checked:bg-green-500 peer-checked:text-gray-50 ">{{ $jenre->jenre }}</label>
                </div>
            @endforeach           
        </div>

        <button class="px-10 py-2 mt-10 border border-gray-500 rounded">投稿</button>
    </form>
   
</x-app-layout>