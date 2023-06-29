<x-app-layout>     
    <div class="pt-12 pb-4 border-y border-gray-400 flex justify-around">
        <p class="font-semibold text-3xl">レシピ編集</p>
    </div>

    <form class="mt-10 flex flex-col items-center" action="{{ route('recipe_edit_upload', ['id' => $recipe->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <label class="text-xl" for="name">レシピ名</label>
        @if ($errors->has('name'))
            <p class="text-red-500">{{ $errors->first('name') }}</p>
        @endif
        <input class="w-11/12 border-gray-300 rounded" name="name" type="text" value="{{ old('name', $recipe->name) }}">

        <label for="image" class="text-xl mt-6">画像選択</label>
        @if ($errors->has('image'))
        <p class="text-red-500">{{ $errors->first('image') }}</p>
        @endif
        
        <img class="w-11/12" src="{{ asset($recipe->image_path) }}" alt="">
        <p class="pt-6 text-4xl">↓</p>

        <div class="w-11/12 pt-6" id="preview_edit"></div>

        <input id="image" class="mt-6" name="image" type="file" onchange="imgPreView_detail(event)">

        <label for="recipe" class="text-xl pt-8">レシピ</label>
        @if ($errors->has('recipe'))
            <p class="text-red-500">{{ $errors->first('recipe') }}</p>
        @endif
        <textarea id="recipe" class="w-11/12 border-gray-300 resize-none rounded" name="recipe" cols="30" rows="20">{{ old('recipe', $recipe->recipe) }}</textarea>

        <p class="text-xl pt-8">ジャンル選択</p>
        @if ($errors->has('jenre_id'))
            <p class="text-red-500">{{ $errors->first('jenre_id') }}</p>
        @endif
        <div class="radiobox w-11/12 mx-auto flex flex-wrap">
            @foreach ($jenres as $jenre)
                <div class="mb-2">
                    <input type="radio" class="hidden peer" name="jenre_id" id="{{ $jenre->jenre }}" value="{{ $jenre->id }}" {{ old('jenre_id', $recipe->jenre->id) ==  $jenre->id ? 'checked' : ''}} />
                    <label for="{{ $jenre->jenre }}" class="mx-1 p-1 border border-gray-300 rounded bg-white peer-checked:bg-fuchsia-500 peer-checked:text-gray-50 ">{{ $jenre->jenre }}</label>
                </div>
            @endforeach           
        </div>

        <button class="font-bold px-10 py-2 mt-10 border border-gray-500 rounded">投稿</button>
    </form>
</x-app-layout>