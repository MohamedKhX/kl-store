<div class="">
    @if($showCollection)
        <section class="animate__animated animate__fadeIn">
            <div class="container-fluid">
                <div class="h-100">
                    <div class="mx-auto text-center mb-6">
                        <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">{{ $collection->name }}</h5>
                    </div>
                    <div class="row d-flex justify-content-center">
                        @foreach($collection->products as $product)
                            <livewire:product-card :product="$product" from-wish-model="collection"/>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
