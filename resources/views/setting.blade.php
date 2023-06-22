<x-app-layout>
    <div class="pt-24 flex flex-col items-center">
        <a class="text-2xl px-2 py-1 my-1 bg-white border border-gray-300 rounded" href="{{ route('register_admin_form') }}">管理者を追加</a>
        <a class="text-2xl px-2 py-1 my-1 bg-white border border-gray-300 rounded" href="{{ route('jenre_addition_form') }}">ジャンル追加</a>
        {{-- <a class="px-1 mb-1 bg-white border border-gray-300 rounded" href="">タグ追加</a> --}}
    </div>    
</x-app-layout>