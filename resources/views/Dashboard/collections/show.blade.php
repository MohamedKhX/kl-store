<x-layout.Dashboard.main>
    <div class="container-fluid px-2 px-md-4 mt-5">
        @if(session()->has('success'))
            <div class="alert alert-success text-white" role="alert">
                <strong>Success!</strong> {{ session()->get('success') }}
            </div>
        @endif
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="d-flex justify-content-center align-items-center flex-column card p-4">
                    <h5>{{ $collection->name }}</h5>
                    <h6>Total products: {{ count($collection->products) }}</h6>
                    <h6>Status:
                        @if($collection->status)
                            <span class="badge bg-gradient-success">Active</span>
                        @else
                            <span class="badge bg-gradient-danger">DeActive</span>
                        @endif
                    </h6>
                    <div class="d-flex flex-row">
                        <h6 class="me-3"><a href="{{ route('admin.collections.edit', $collection->id) }}">Edit</a></h6>
                        <h6><a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal">Delete</a></h6>
                    </div>
                </div>
                <div class="mt-5">
                    @if(count($collection->products))
                        @foreach($collection->products as $product)
                            <div class="card my-5">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <a class="d-block blur-shadow-image" href="">
                                        <img src="{{ $product->thumbnail() }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                                    </a>
                                    <div class="colored-shadow" style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);"></div>
                                </div>
                                <div class="card-body text-center mt-5">
                                    <div class="d-flex mt-n6 mx-auto">
                                        <a class="btn btn-link text-primary ms-auto border-0"
                                           onclick=""
                                           data-bs-toggle="modal" data-bs-target="#DeleteModal"
                                        >
                                            <i class="material-icons text-lg">delete</i>
                                        </a>
                                        <a class="btn btn-link text-info me-auto border-0"
                                           href=""
                                        >
                                            <i class="material-icons text-lg">edit</i>
                                        </a>
                                    </div>
                                    <h5 class="font-weight-normal mt-3">
                                        <a href="">{{ $product->name }}</a>
                                    </h5>
                                    <p class="mb-0">
                                        {{ $product->description }}
                                    </p>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="card-footer d-flex justify-content-between">
                                    <p class="font-weight-normal my-auto">Price :
                                        <span class="badge bg-gradient-danger">{{ $product->price() }}</span>
                                    </p>
                                    <a
                                       onclick="deleteProduct('{{$product->id}}')"
                                       class="btn btn-danger font-weight-normal my-auto">
                                        Delete
                                    </a>
                                    <form hidden method="POST"
                                          id="deleteProductFromCollection{{$product->id}}"
                                          action="{{ route('admin.collections.product.delete', [$collection->id, $product->id]) }}"
                                    >
                                        @csrf
                                        @method('PATCH')
                                        <input value="test" type="submit" hidden>
                                    </form>
                                    <p class="font-weight-normal my-auto">Views : {{$product->views}}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex justify-content-center align-items-center">
                            <h2>No Products in this collection</h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="DeleteModalLabel">Are you sure you want to delete the collection?</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="text-danger">Note: it will be deleted forever</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteForm" method="POST" action="{{ route('admin.collections.destroy', $collection->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" hidden>
                    </form>
                    <button onclick="submitForm()" type="button" class="btn bg-gradient-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function deleteProduct(id) {
                const formProduct = document.getElementById('deleteProductFromCollection' + id);
                formProduct.submit();
            }

            const form = document.getElementById('deleteForm');
            function submitForm() {
                form.submit();
            }
        </script>
    @endpush
</x-layout.Dashboard.main>
