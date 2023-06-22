<x-app-layout>
    <form class="mt-24 w-11/12 mx-auto flex flex-col items-center" action="{{ route('jenre_addition') }}">
        @csrf
        @error('jenre')
            <p class="text-red-500">{{ $message }}</p>
        @enderror
        <input class="w-full border border-gray-300 rounded" type="text" name="jenre" placeholder="ジャンル名" value="{{ old('jenre') }}">
        <button class="text-xl px-3 py- mt-6 mx-auto bg-white border border-gray-300 rounded">追加</button>
    </form>

    <div class="w-11/12 mx-auto py-2 mt-12 border border-gray-300 rounded bg-white">
        <h2 class="w-11/12 mx-auto mb-6 text-center">登録済みジャンル</h2>
        <div class="w-1/2 mx-auto">
            @foreach ($jenres as $jenre)
                <div class="mb-2 flex justify-between">
                    <p class="">{{ $jenre->jenre }} </p>

                    <a class="text-red-500" href="{{ route('jenre_del', $jenre->id) }}" onclick="return delConf()">削除</a>
                </div>
            @endforeach           
        </div>
    </div>
    
    
</x-app-layout>