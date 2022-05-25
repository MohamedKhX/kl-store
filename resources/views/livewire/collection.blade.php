<div>
    <section>
        <div class="container">
            <div class="row h-100">
                <div class="col-lg-7 mx-auto text-center mb-6">
                    <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">{{ $collection->name }}</h5>
                </div>
                <div class="col-12">
                    <div class="row d-flex justify-content-center">
                        @foreach($products as $product)
                            <livewire:product-card :product="$product" from-wish-model="collection"/>
                        @endforeach
                    </div>
                </div>
            </div>
            {{--<div class="d-flex justify-content-center mt-5">
                <button wire:click="loadMore" class="btn btn-dark">View more</button>
            </div>--}}
        </div>
    </section>
</div>
