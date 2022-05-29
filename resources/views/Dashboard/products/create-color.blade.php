<x-layout.Dashboard.main>
    @push('styles')
        <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    @endpush

    @push('scripts')
        <script src="assets/plugins/global/plugins.bundle.js"></script>
    @endpush

    <div class="container-fluid px-2 px-md-4 mt-5 pt-5">
        <div class="card card-body mx-3 mx-md-4 mt-n6 mt-5 mb-2">
            @if(session()->has('success'))
                <div class="alert alert-success text-white" role="alert">
                    <strong>Success!</strong> {{ session()->get('success') }}
                </div>
            @endif
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
                <h2 class="text-center">Product Color</h2>
                <div class="col-12 col-md-10 col-lg-9 col-xl-8">
                    <form method="POST" action="{{ route('admin.products.color.store', $product) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group input-group-outline my-3 {{ old('color') ? 'is-focused' : null }} ">
                            <label for="color" class="form-label">Color</label>
                            <input id="color" name="color" type="text" class="form-control" value="{{ old('color') }}">
                        </div>

                        <div class="input-group input-group-outline my-3 {{ old('color_name') ? 'is-focused' : null }}">
                            <label for="color_name" class="form-label">Color Name</label>
                            <input id="color_name" name="color_name" type="text" class="form-control" value="{{ old('color_name') }}">
                        </div>

                        <div class="input-group input-group-outline my-3 {{ old('color_price') ? 'is-focused' : null }}">
                            <label for="color_price" class="form-label">Color Price</label>
                            <input id="color_price" name="color_price" type="text" class="form-control" value="{{ old('color_price') }}">
                        </div>

                        <div id="imgFields">
                            <div class="input-group input-group-outline my-3 {{ old('color_img_url') ? 'is-focused' : null }}">
                                <label for="color_img_url" class="form-label">Color image</label>
                                <input id="color_img_url" name="color_images[]" type="text" class="form-control" value="{{ old('color_img_url') }}">
                                <a onclick="createUrlField()" class="btn btn-primary h-100 mb-0">+</a>
                            </div>
                        </div>

                        <div class="my-3">
                            <label for="color_thumbnail" class="form-label">Product Thumbnail</label>
                            <div class="input-group input-group-outline">
                                <input id="color_thumbnail" name="color_thumbnail" type="file" class="form-control" value="{{ old('product_thumbnail') }}">
                            </div>
                        </div>

                        <div>
                            <p>Write size after that write comma ,</p>
                            <div class="input-group input-group-outline my-3 {{ old('color_price') ? 'is-focused' : null }}">
                                <label for="color_sizes" class="form-label">Color Sizes</label>
                                <input id="color_sizes" name="color_sizes" type="text" class="form-control" value="{{ old('color_price') }}">
                            </div>
                        </div>

                        <div class="input-group input-group-outline my-4 d-flex">
                            <input type="submit" class="btn btn-info w-100 p-1 fs-6" value="Next">
                        </div>

                    </form>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary">That's Enough</a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let counter = 0;
            function createUrlField()
            {
                counter++;
                const imgFields = document.getElementById('imgFields');

                const node = document.createElement('div');
                node.classList.add('input-group', 'input-group-outline', 'my-3', 'is-filled');
                node.innerHTML = `<label for="color_img_url${counter}" class="form-label">Color image</label>
                                <input id="color_img_url${counter}" name="color_images[]" type="text" class="form-control" value="{{ old('color_img_url') }}">
                                <a onclick="createUrlField()" class="btn btn-primary h-100 mb-0">+</a>`;

                imgFields.append(node);
            }

        </script>
    @endpush
</x-layout.Dashboard.main>
