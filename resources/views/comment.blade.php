<x-app-layout>
    <div class="mt-12">
        <div class="w-3/4 mx-auto">
            <form class="bg-gray-50 rounded-md border-slate-800" action="{{ route('comment_upload') }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $value->user()->id }}">
                <input type="hidden" name="recipe_id" value="{{ $value->recipe_id }}">
                <textarea class="bg-gray-50 resize-none h-full w-full border-none rounded-md" name="comment" id="" cols="30" rows="10" placeholder="コメントを追加(200文字以内)"></textarea>
                
                <div class="flex items-center">
                    <button class="mx-auto">追加</button>
                </div>
            </form>
        </div>        
    </div>
</x-app-layout>
