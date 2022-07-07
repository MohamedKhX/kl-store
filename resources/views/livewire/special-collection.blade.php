<section class="py-0">
    <div class="container">
        <div class="row h-100">
            <div class="col-lg-7 mx-auto text-center mb-6">
                <h5 class="fs-3 fs-lg-5 lh-sm mb-3">{{ $collection->name }}</h5>
            </div>
            <div class="col-12">
                <div class="carousel slide" id="{{ $collection->name . 'Carousel' }}" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <div class="row h-100 align-items-center g-2 d-flex justify-content-center">
                                @foreach($products as $product)
                                    <div class="col-6 col-lg-3">
                                        <x-card.product :name="$product->name" :img="$product->thumbnail()" :price="$product->price()" oldPrice="{{ $product->oldPrice() }}">
                                            <x-slot name="link">
                                                <div style="cursor: pointer" class="stretched-link" href="#" wire:click="showProduct({{$product->id}})" data-bs-toggle="modal" data-bs-target="#singleProduct"></div>
                                            </x-slot>
                                        </x-card.product>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($productsCount >= $toShow)
                <div class="col-12 d-flex justify-content-center mt-5">
                    <a class="btn btn-lg btn-dark">
                        {{ __('elements.view_more') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
