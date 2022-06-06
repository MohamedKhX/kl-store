<x-layout.Dashboard.main>
    <div class="container-fluid px-2 px-md-4 mt-5 pt-5">
        <div class="card card-body mx-3 mx-md-4 mt-n6 mt-5">
            @if($errors->any())
                <div class="alert alert-danger text-white pb-1" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row d-flex justify-content-center">
                <h2 class="text-center">Edit a product</h2>
                <div class="col-12 col-md-10 col-lg-9 col-xl-8">
                    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input id="product_name" name="product_name" type="text" class="form-control" value="{{ old('product_name') ?? $product->name }}">
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <textarea placeholder="Product Description... [optional]" class="form-control" name="product_description" id="product_description" cols="30" rows="10">{{ old('product_description') ?? $product->description }}</textarea>
                        </div>
                        <div class="my-3">
                            <label for="category_thumbnail" class="form-label">Product Thumbnail</label>
                            <div class="input-group input-group-outline">
                                <input id="product_thumbnail" name="product_thumbnail" type="file" class="form-control" value="{{ old('product_thumbnail') }}">
                            </div>
                        </div>
                        <div class="form-check form-switch d-flex align-content-center">
                            <input class="form-check-input me-2" name="product_status" type="checkbox" id="product_status" checked>
                            <label class="form-check-label" for="product_status">Product Status</label>
                        </div>
                        <div class="input-group input-group-outline my-4 d-flex">
                            <input type="submit" class="btn btn-lg btn-outline-success w-100 p-1 fs-6" value="Save">
                        </div>
                    </form>
                    <div>
                        <h5>Colors : </h5>
                        <div class="row d-flex">
                            @foreach($product->colors as $color)
                                <a href="{{ route('admin.products.color.edit', [$product, $color->id]) }}" class="col-3 col-sm-2 col-lg-1">
                                    <img src="{{ $color->thumbnail }}" alt="">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.Dashboard.main>
