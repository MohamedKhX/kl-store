<x-card.category :name="$category->name" :img="$category->thumbnail">
    <x-slot name="link">
        <a class="stretched-link" href="#" wire:click="showCategory({{$category->id}})"
           data-bs-toggle="modal" data-bs-target="#CategoryModel"
        ></a>
    </x-slot>
</x-card.category>
