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
                            @foreach($category->products->take(8) as $product)
                                <livewire:product-card :product="$product">
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-5">
                        <a class="btn btn-lg btn-dark" href="{{ route('categories.show', $category->slug) }}">
                            {{ __('elements.view_all') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
