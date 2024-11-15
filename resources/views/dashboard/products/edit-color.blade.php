<x-layout.Dashboard.main>
    @push('styles')
        <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    @endpush

    @push('scripts')
        <script src="assets/plugins/global/plugins.bundle.js"></script>
    @endpush

    <div class="container-fluid px-2 px-md-4 mt-5 pt-5">

        <div class="card card-body mx-3 mx-md-4 mt-n6 mt-5 mb-2">
            <div>
                <a class="btn btn-primary" href="{{ route('admin.products.edit', $product) }}">back to product</a>
            </div>
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
                    <form method="POST" action="{{ route('admin.products.color.update', [$product, $color->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="input-group input-group-outline my-3 {{ $color->color ? 'is-focused' : null }} ">
                            <label for="color" class="form-label">Color</label>
                            <input id="color" name="color" type="text" class="form-control" value="{{ old('color') ?? $color->color }}">
                        </div>

                        <div class="input-group input-group-outline my-3 {{ $color->name ? 'is-focused' : null }}">
                            <label for="color_name" class="form-label">Color Name</label>
                            <input id="color_name" name="color_name" type="text" class="form-control" value="{{ old('color_name') ?? $color->name }}">
                        </div>


                        <div class="input-group input-group-outline my-3 {{ $color->priceWithCurrency() ? 'is-focused' : null }}">
                            <label for="color_old_price" class="form-label">Color Old Price</label>
                            <input id="color_old_price" name="color_old_price" type="text" class="form-control" value="{{ old('color_old_price') ?? $color->old_price }}">
                        </div>

                        <div>
                            <div>
                                <strong class="text-danger">Note: </strong>
                                <span>Use (Custom Price) when you don't want update the price after fetching</span>
                            </div>
                            <div class="input-group input-group-outline my-3 {{ $color->priceWithCurrency() ? 'is-focused' : null }}">
                                <label for="color_custom_price" class="form-label">Color Custom Price</label>
                                <input id="color_custom_price" name="color_custom_price" type="text" class="form-control" value="{{ old('color_custom_price') ?? $color->custom_price }}">
                            </div>
                        </div>


                        <div class="input-group input-group-outline my-3 {{ $color->priceWithCurrency() ? 'is-focused' : null }}">
                            <label for="color_price" class="form-label">Color Price</label>
                            <input id="color_price" name="color_price" type="text" class="form-control" value="{{ old('color_price') ?? $color->priceWithOutCurrency() }}">
                        </div>

                        <div id="imgFields">
                            @foreach($color->images as $image)
                                <div>
                                    <div class="input-group input-group-outline my-3 {{ $image ? 'is-focused' : null }}">
                                        <label for="color_img_url" class="form-label">Color image</label>
                                        <input id="color_img_url" name="color_images[]" type="text" class="form-control" value="{{ old('color_img_url') ?? $image }}">
                                        <a onclick="createUrlField()" class="btn btn-primary h-100 mb-0">+</a>
                                    </div>
                                    <div x-data="{checked: {{ in_array($image, $color->excludedImages ?? []) ? 'true' : 'false' }} }" class="mb-3 form-check">
                                        <input :value="checked ? '{{$image}}' : null" type="text" name="color_exclude_img[]" hidden>
                                        <input x-model="checked" type="checkbox" class="form-check-input" id="color_exclude_img{{$image}}">
                                        <label @click="! checked" class="form-check-label" for="color_exclude_img{{$image}}">Exclude</label>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-6 col-md-3">
                                        <img src="{{ $image }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="my-3">
                            <div class="my-3">
                                <label for="color_thumbnail" class="form-label">Color Thumbnail</label>
                                <div class="input-group input-group-outline">
                                    <input id="color_thumbnail" name="color_thumbnail" type="file" class="form-control" value="{{ old('product_thumbnail') }}">
                                </div>
                            </div>

                            <div class="row justify-content-center mt-2">
                                <div class="col-4 d-flex justify-content-center">
                                    <img src="{{ $color->thumbnail() }}" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a onclick="addSizeField()" class="btn btn-secondary">Add a size</a>
                        </div>
                        <div id="sizeFields">
                            @foreach($color->sizes as $size)
                                <div class="row d-flex justify-content-center">
                                    <div class="col-8 col-xl-4">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="input-group input-group-outline my-3 is-focused">
                                                    <label for="color_sizes" class="form-label">Size</label>
                                                    <input id="color_sizes" name="color_sizes[]" type="text"
                                                           class="form-control" value="{{ $size->size }}"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group input-group-outline my-3 {{ isset($size->qty) ? 'is-focused' : null }}">
                                                    <label for="color_qty" class="form-label">Qty</label>
                                                    <input id="color_qty" name="color_size_qty[]" type="text"
                                                           class="form-control" value="{{ $size->qty }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="input-group input-group-outline my-4 d-flex">
                            <input type="submit" class="btn btn-info w-100 p-1 fs-6" value="Save">
                        </div>
                    </form>

                    <div>
                        <p><strong class="text-danger">Note:</strong> The color will be deleted for ever</p>
                        <form method="POST" action="{{ route('admin.products.color.destroy', [$product, $color->id]) }}">
                            @csrf
                            @method('DELETE')

                            <input type="submit" class="btn btn-danger w-75 p-1 fs-6" value="Delete">
                        </form>
                    </div>
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


            function addSizeField() {

                const sizeFields = document.getElementById('sizeFields');
                console.log(sizeFields);

                const node = document.createElement('div');
                node.classList.add('row', 'd-flex', 'justify-content-center');
                node.innerHTML = `
                           <div class="col-8 col-xl-4">
                                 <div class="row">
                                            <div class="col-6">
                                                <div class="input-group input-group-outline my-3 is-focused">
                                                    <label for="color_sizes" class="form-label">Size</label>
                                                    <input id="color_sizes" name="color_sizes[]" type="text"
                                                           class="form-control" value=""
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group input-group-outline my-3 is-focused">
                                                    <label for="color_qty" class="form-label">Qty</label>
                                                    <input id="color_qty" name="color_size_qty[]" type="text"
                                                           class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                           </div>
                `

                sizeFields.append(node)
            }

        </script>
    @endpush
</x-layout.Dashboard.main>
