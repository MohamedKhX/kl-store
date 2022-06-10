@props(['product', 'deleteButton' => true])

<div class="col-12 col-md-6 col-lg-4 mt-5">
    <div class="card">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <a class="d-block blur-shadow-image">
                <img src="{{ $product->thumbnail() }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
            </a>
            <div class="colored-shadow" style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);"></div>
        </div>
        <div class="card-body text-center mt-6">
            <div class="d-flex justify-content-center mt-n6 mx-auto">
                @if($deleteButton)
                    <a class="btn btn-link text-primary ms-auto border-0"
                       data-bs-toggle="modal" data-bs-target="#DeleteModal"
                       onclick="productToDelete({{ json_encode($product) }})"
                    >
                        <i class="material-icons text-lg">delete</i>
                    </a>

                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-link text-info me-auto border-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                        <i class="material-icons text-lg">edit</i>
                    </a>
                @else
                    <a  href="{{ route('admin.products.edit', $product->id) }}"
                        class="btn btn-link text-info border-0 d-flex justify-content-center"
                        data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Edit">
                        <i class="material-icons text-lg">edit</i>
                    </a>
                @endif

            </div>
            <h5 class="font-weight-normal mt-0">
                <a href="javascript:;">{{ $product->name }}</a>
            </h5>
            <p class="mb-0">
                {{ $product->description }}
            </p>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer d-flex justify-content-between">
            <p class="font-weight-normal my-auto">{{ $product->price() }}</p>
            <p class="font-weight-normal my-auto">{{ $product->views }} views</p>
        </div>
    </div>


</div>
