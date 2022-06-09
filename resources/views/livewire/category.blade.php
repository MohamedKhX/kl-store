<div class="">
    @if($showCategory)
        <section class="animate__animated animate__fadeIn">
            <div class="container">
                <div class="row h-100">
                    <div class="col-lg-7 mx-auto text-center mb-6">
                        <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">{{ $category->name }}
                        </h5>
                    </div>
                    <div class="col-12">
                        <div class="row d-flex justify-content-center">
                            @foreach($category->products as $product)
                                <x-card.product :name="$product->name" :img="$product->thumbnail()" :price="$product->price()" :oldPrice="$product->oldPrice()">
                                    <x-slot name="link">
                                        <a class="stretched-link" href="#" wire:click="showProduct({{$product->id}})" data-bs-toggle="modal" data-bs-target="#singleProduct"></a>
                                    </x-slot>
                                </x-card.product>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
