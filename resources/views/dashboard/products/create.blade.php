<x-layout.Dashboard.main>

    @php

    @endphp


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
                    <h2 class="text-center">Create a new product</h2>
                    <div class="col-12 col-md-10 col-lg-9 col-xl-8">
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input id="product_name" name="product_name" type="text" class="form-control" value="{{ old('product_name') }}">
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <textarea placeholder="Product Description... [optional]" class="form-control" name="product_description" id="product_description" cols="30" rows="10">{{ old('product_description') }}</textarea>
                        </div>

                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="product_priority" class="form-label">Product Priority</label>
                            <input id="product_priority" name="product_priority" type="text" class="form-control" value="{{ old('product_priority') }}">
                        </div>

                        <div class="my-3">
                            <label for="category_thumbnail" class="form-label">Product Thumbnail</label>
                            <div class="input-group input-group-outline">
                                <input id="product_thumbnail" name="product_thumbnail" type="file" class="form-control" value="{{ old('product_thumbnail') }}">
                            </div>
                        </div>
                        <div class="input-group input-group-static mb-4">
                            <label for="categorySelector" class="ms-0">Category: </label>
                            <select name="product_category_id" class="form-control" id="categorySelector">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            {{ old('product_category_id') == $category->id ? 'selected' : null }}
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div>
                                <strong class="text-danger">Note:</strong>
                                <span>
                                    If you will change price the whole colors price will change as well
                                </span>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline my-3 is-focused">
                                    <label for="product_price" class="form-label">Price: </label>
                                    <input id="product_price" name="product_price" type="text" class="form-control" value="{{ old('product_price') }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline my-3 is-focused">
                                    <label for="product_old_price" class="form-label">Old Price: </label>
                                    <input id="product_old_price" name="product_old_price" type="text" class="form-control" value="{{ old('product_old_price') }}">
                                </div>
                            </div>
                        </div>
                        <div class="my-3">
                            <strong>Collections: </strong>
                            <div class="d-flex flex-column justify-content-center">
                                @foreach($collections as $key => $collection)
                                    <div class="form-check">
                                        <input name="collections[]"
                                               class="form-check-input"
                                               type="checkbox"
                                               value="{{ $collection->id }}"
                                               id="{{ $collection->name }}"
                                               @php
                                                    if(old('collections')) {
                                                       foreach (old('collections') as $collection_id) {
                                                           if($collection_id == $collection->id) {
                                                               echo 'checked';
                                                           }
                                                       }
                                                    }
                                               @endphp
                                        >
                                        <label class="form-check-label" for="{{ $collection->name }}">
                                            {{ $collection->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-check form-switch d-flex align-content-center">
                            <input class="form-check-input me-2" name="product_status" type="checkbox" id="product_status" checked>
                            <label class="form-check-label" for="product_status">Product Status</label>
                        </div>
                        <div class="input-group input-group-outline my-4 d-flex">
                            <input type="submit" class="btn btn-lg btn-info w-100 p-1 fs-6" value="Next">
                        </div>
                    </form>
                </div>
                </div>
        </div>
    </div>
</x-layout.Dashboard.main>
