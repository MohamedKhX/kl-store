<div>
    <livewire:single-product-model />
    <section>
        <div class="container">
            <div class="row h-100">
                <div class="col-lg-7 mx-auto text-center mb-6">
                    <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">Best Sellers</h5>
                </div>
                <div class="col-12">
                    <div class="row">
                        @foreach($products as $product)
                            <livewire:product-card :product="$product"/>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
