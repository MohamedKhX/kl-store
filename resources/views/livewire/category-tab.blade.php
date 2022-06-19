<div>
    <div class="d-flex justify-content-center">
        <p class="text-center fs-1">
            {{ $category->description }}
        </p>
    </div>
    <div class="row h-100 align-items-center g-2 d-flex justify-content-center">
        @foreach($products as $product)
            @if($product->colors->count())
                <div class="col-6 col-md-4 col-lg-3">
                    <x-card.product :name="$product->name" :img="$product->thumbnail()" :price="$product->price()" oldPrice="{{ $product->oldPrice() }}">
                        <x-slot name="link">
                            <div style="cursor: pointer" class="stretched-link" href="#" wire:click="showProduct({{$product->id}})" data-bs-toggle="modal" data-bs-target="#singleProduct"></div>
                        </x-slot>
                    </x-card.product>
                </div>
            @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        @if($toShow < $productsCount)
            <button class="btn btn-dark" wire:click="showMore">
                <div wire:loading.class="spinner-border spinner-border-sm" wire:target="showMore" class="" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <span>
                View more
                </span>
            </button>
        @endif
    </div>
</div>

