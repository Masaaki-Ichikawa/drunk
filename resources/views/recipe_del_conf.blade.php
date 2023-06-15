<x-app-layout>    
    <div class="mt-12 flex justify-center">
        <div class="mt-48 w-48 inline-block mx-auto">
            <p class="mx-auto text-center">本当に削除しますか？</p>
            <div class="mt-4 flex justify-around">
                <a class="w-14 border rounded border-gray-300 text-center" href="{{ route('recipe_del', $recipe->id) }}">はい</a>
                <a class="w-14 border rounded border-gray-300 text-center" href="{{ route('user_mypage') }}">いいえ</a>
            </div>
        </div>        
    </div>
</x-app-layout>