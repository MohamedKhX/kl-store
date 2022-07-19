<div>
    <div class="d-flex justify-content-center">
        <p class="text-center fs-1">
            {{ $category->description }}
        </p>
    </div>
    <div class="row h-100 align-items-center g-2 d-flex justify-content-center">
        @foreach($products as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <x-card.product :name="$product->product->name" :img="$product->images[0]" :price="$product->priceWithCurrency()" oldPrice="{{ $product->oldPrice() }}" :outer_description="$product->product->outer_description">
                    <x-slot name="link">
                        <div style="cursor: pointer" class="stretched-link" href="#" wire:click="showProduct({{$product->product->id}}, {{$product->id}})" data-bs-toggle="modal" data-bs-target="#singleProduct"></div>
                    </x-slot>
                </x-card.product>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        @if($toShow < $productsCount)
            <button class="btn btn-dark" wire:click="showMore">
                <div wire:loading.class="spinner-border spinner-border-sm" wire:target="showMore" class="" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <span>
                    {{__('elements.view_more')}}
                </span>
            </button>
        @endif
    </div>
</div>

