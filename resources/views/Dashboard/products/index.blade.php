<x-layout.Dashboard.main>

    <!-- Create a product Model -->
    <div class="modal fade" id="product" tabindex="-1" role="dialog" aria-labelledby="productLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="productLabel">Create a new product</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Which way you want to create the product?
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin.products.create') }}" type="button" class="btn bg-gradient-primary">Custom</a>
                    <a href="{{ route('admin.products.scrap') }}" type="button" class="btn bg-gradient-info">Scrap product</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Create a product Model -->

    {{-- Start Delete Model --}}
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="DeleteModalLabel">Are you sure you want to delete the product?</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="text-danger">Note: it will be deleted forever</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteForm" method="POST" action="{{ route('admin.products.destroy', 1) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" hidden>
                    </form>
                    <button onclick="deleteProduct()" type="button" class="btn bg-gradient-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Delete Model --}}

    <div class="container mt-6">
        <div class="d-flex justify-content-center justify-content-lg-end">
            <button class="btn btn-success w-75 w-lg-25"  data-bs-toggle="modal" data-bs-target="#product">Create a Product</button>
        </div>
        <div>
            <h2>Products : </h2>
        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="col-12 col-md-6 col-lg-4 mt-5">
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <a class="d-block blur-shadow-image">
                                <img src="{{ $product->thumbnail() }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                            </a>
                            <div class="colored-shadow" style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);"></div>
                        </div>
                        <div class="card-body text-center mt-6">
                            <div class="d-flex mt-n6 mx-auto">
                                <a class="btn btn-link text-primary ms-auto border-0"
                                   data-bs-toggle="modal" data-bs-target="#DeleteModal"
                                   onclick="productToDelete({{ json_encode($product) }})"
                                >
                                    <i class="material-icons text-lg">delete</i>
                                </a>
                                <button class="btn btn-link text-info me-auto border-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                    <i class="material-icons text-lg">edit</i>
                                </button>
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
                            <p class="font-weight-normal my-auto">{{ $product->price() }} LYD</p>
                            <p class="font-weight-normal my-auto">{{ $product->views }} views</p>
                        </div>
                    </div>


                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center align-items-center mt-3">
            {{ $products->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
            const form = document.getElementById('deleteForm');

            function productToDelete(product)
            {
                let url = form.getAttribute('action').split('/');

                url = url.slice(0,-1).join('/') + '/' + product.id;

                form.setAttribute('action', url);
            }

            function deleteProduct() {
                let form = document.getElementById('deleteForm');
                form.submit();
            }
        </script>
    @endpush
</x-layout.Dashboard.main>
