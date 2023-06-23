<x-app-layout>    
    <div class="pb-2 pt-12 border-y border-gray-300 flex justify-around">
        <p class="font-semibold text-3xl">新規投稿</p>
    </div>

    <form class="mt-4 flex flex-col items-center" action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label class="text-xl" for="name">レシピ名</label>
        @if ($errors->has('name'))
            <p class="text-red-500">{{ $errors->first('name') }}</p>
        @endif
        <input class="w-11/12 border-gray-300 rounded" name="name" type="text" value="{{ old('name') }}">

        <label for="image" class="text-xl mt-6">画像選択</label>
        @if ($errors->has('image'))
        <p class="text-red-500">{{ $errors->first('image') }}</p>
        @endif
        <div class="w-11/12 m-auto">
            <div class="m-auto pt-6" id="preview"></div>
        </div>

        <input id="image" class="mt-6" name="image" type="file" onchange="imgPreView(event)">

        <label for="recipe" class="text-xl pt-8">レシピ</label>
        @if ($errors->has('recipe'))
            <p class="text-red-500">{{ $errors->first('recipe') }}</p>
        @endif
        <textarea id="recipe" class="w-11/12 border-gray-300 resize-none rounded" name="recipe" cols="30" rows="20">{{ old('recipe') }}</textarea>

        <p class="text-xl pt-8">ジャンル選択</p>
        @if ($errors->has('jenre_id'))
            <p class="text-red-500">{{ $errors->first('jenre_id') }}</p>
        @endif
        <div class="radiobox w-11/12 mx-auto flex flex-wrap">
            @foreach ($jenres as $jenre)
                <div class="mb-2">
                    <input type="radio" class="hidden peer" name="jenre_id" id="{{ $jenre->jenre }}" value="{{ $jenre->id }}" />
                    <label for="{{ $jenre->jenre }}" class="mx-1 p-1 border border-gray-300 rounded bg-white peer-checked:bg-fuchsia-500 peer-checked:text-gray-50 ">{{ $jenre->jenre }}</label>
                </div>
            @endforeach           
        </div>

        <button class="font-bold px-10 py-2 mt-10 bg-white border border-gray-300 rounded">投稿</button>
    </form>
   
</x-app-layout>