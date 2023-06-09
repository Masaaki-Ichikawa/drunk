<x-app-layout>
    <div class="mt-10">
        @foreach ($recipes as $recipe)
            <div>
                <p>{{ $recipe->user->name }}</p>
                <p>{{ $recipe->created_at }}</p>
                <img class="w-1/4" src="{{ asset($recipe->image_path) }}" alt="">
                <p>{{ $recipe->name }}</p>
                <p>{{ $recipe->recipe }}</p>
                <p class="hidden">{{ $recipe->jenre_id }}</p>
                
            </div>
        @endforeach
    </div>
    
    
</x-app-layout>
