<x-card.collection :name="$collection->name" :img="$collection->thumbnail">
    <x-slot name="link">
        <a class="stretched-link" href="#" wire:click="showCollection({{$collection->id}})" data-bs-toggle="modal" data-bs-target="#CollectionModel"></a>
    </x-slot>
</x-card.collection>
