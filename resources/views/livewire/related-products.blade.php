<div>
    @if($relatedProducts->count())
        <div class="container">
            <h5 class="{{arRight()}}">{{ __('product.related_products') }}</h5>
            <div id="relatedProductsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($relatedProducts as $productsChunk)
                        <div class="carousel-item {{ $loop->first ? 'active' : null }}">
                            <div class="d-flex ">
                                <div class="row">
                                    @foreach($productsChunk as $product)
                                        <div class="col-6 col-lg-3">
                                            <x-card.product :name="$product->name" :img="$product->thumbnail()" :price="$product->price()" oldPrice="{{ $product->oldPrice() }}">
                                                <x-slot name="link">
                                                    <a style="cursor: pointer; outline: none;"
                                                       class="stretched-link"
                                                       href="#productSection"
                                                       wire:click="showProduct({{$product->id}})"
                                                       x-data
                                                       @click="window.location.href = `{{ url('') }}/product/{{ $product->id }}/{{$product->getFirstColor()->id}}`"
                                                    >
                                                    </a>
                                                </x-slot>
                                            </x-card.product>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#relatedProductsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#relatedProductsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    @endif
</div>

