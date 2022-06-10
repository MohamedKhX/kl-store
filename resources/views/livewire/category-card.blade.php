<x-card.category :name="$category->name" :img="$category->thumbnail">
    <x-slot name="link">
        <a style="cursor: pointer; outline: none;" class="stretched-link" href="{{ route('categories.show', $category->slug) }}"></a>
    </x-slot>
</x-card.category>
