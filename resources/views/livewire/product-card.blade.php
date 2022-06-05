@if($rectangle === true)
    <x-card.rectangleProduct :name="$product->name" :price="$product->price()" :img="$product->thumbnail()">
        <x-slot name="link">
            <div style="cursor: pointer;" class="stretched-link" href="#" wire:click="showProduct({{$product->id}})" data-bs-toggle="modal" data-bs-target="#singleProduct"></div>
        </x-slot>
    </x-card.rectangleProduct>
@else
    <x-card.product :name="$product->name" :img="$product->thumbnail()" :price="$product->price()" oldPrice="50 LYD">
        <x-slot name="link">
            <div style="cursor: pointer" class="stretched-link" href="#" wire:click="showProduct({{$product->id}})" data-bs-toggle="modal" data-bs-target="#singleProduct"></div>
        </x-slot>
    </x-card.product>
@endif
