<div class="container">
    @if($showProduct)
        <div class="row animate__animated animate__fadeIn" x-data x-init="load()">
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-2 d-none d-sm-block">
                            <div class="sm-images-box d-flex flex-column">
                                @foreach($color->images as $image)
                                    <img onclick="changeImg('{{ $image }}', this)" class="img-fluid sm-img {{ $loop->first ? 'sm-img-active' : '' }}" src="{{ $image }}" alt="">
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 col-sm-10">
                            <div class="d-none d-sm-block">
                                <img src="{{ $color->images[0] }}" id="thumbnail" class="img-fluid singleProduct" alt="">
                            </div>
                            <div class="d-block d-sm-none">
                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($color->images as $image)
                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                <img src="{{ $image }}" class="d-block w-100" alt="...">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 p-xxl-5 pt-4">
                    <div class="pt-xxl-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h2>{{ $product->name }}</h2>

                            <h5>{{ $color->price }}$</h5>
                        </div>
                        <div>
                            <p class="description">{{ $product->description }}</p>
                        </div>
                    </div>
                    <hr>

                    <div class="pt-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3>
                                Color
                            </h3>
                        </div>
                        <div class="mt-3 d-flex justify-content-center d-sm-block color-images-box">
                            @foreach($product->colors as $key => $color)
                                {{-- href="{{ route('product-color', ['product' => $product, 'color' => $key + 1]) }}" --}}
                                <a class="{{ $loop->last ? '' : 'me-3' }}" wire:click="reRender({{ $key + 1 }})">
                                    <img class="img-fluid color-img {{ $key +1 === $colorId ? 'sm-img-active' : '' }}" src="https://img-lcwaikiki.mncdn.com/mnresize/1024/-/pim/productimages/20211/4944599/l_20211-s1ct83z8-j2y_a.jpg" alt="">
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="pt-5">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3>
                                Size
                            </h3>
                        </div>
                        <div class="mt-3 d-flex justify-content-center justify-content-md-start">
                            @foreach($color->sizes as $key => $size)
                                <div onclick="changeSize({{ $key }}, this)" class="size-square {{ $key === $selectedSize ? 'size-square-active' : '' }}">{{ $size }}</div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-5 mt-2 p-lg-4 d-flex justify-content-center">
                        <button class="btn btn-lg btn-dark w-100 w-md-50">Add to cart</button>
                    </div>
                </div>
        </div>
    @endif
</div>

