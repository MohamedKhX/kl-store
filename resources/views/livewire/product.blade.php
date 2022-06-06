<div>
    <div class="container">
        @if($showProduct)
            <div class="row animate__animated animate__fadeIn" x-data="{currentSize: @entangle('sizeSelected')}" x-init="load()">
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

                            <h5>{{ $color->price }}</h5>
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
                        <div class="d-flex d-sm-none justify-content-center color-images-box">
                            <div class="row d-flex ">
                                @if(count($product->colors) === 1)
                                        @foreach($product->colors as $key => $colorItem)
                                            <div class="col-12">
                                                <a type="button" class="{{ $loop->last ? '' : 'me-3' }}" wire:click="reRender({{ $key + 1 }})">
                                                    <img class="mt-3 img-fluid color-img {{ $key +1 === $colorId ? 'sm-img-active' : '' }}"
                                                         src="{{ $colorItem->thumbnail }}"
                                                         alt="">
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                @if(count($product->colors) === 2)
                                    @foreach($product->colors as $key => $colorItem)
                                        <div class="col-6">
                                            <a type="button" class="{{ $loop->last ? '' : 'me-3' }}" wire:click="reRender({{ $key + 1 }})">
                                                <img class="mt-3 img-fluid color-img {{ $key +1 === $colorId ? 'sm-img-active' : '' }}"
                                                     src="{{ $colorItem->thumbnail }}"
                                                     alt="">
                                            </a>
                                        </div>
                                    @endforeach
                                    @endif
                                @if(count($product->colors) >=  3)
                                    @foreach($product->colors as $key => $colorItem)
                                        <div class="col-4 d-flex justify-content-center">
                                            <a type="button" wire:click="reRender({{ $key + 1 }})">
                                                <img class="mt-3 img-fluid color-img {{ $key +1 === $colorId ? 'sm-img-active' : '' }}"
                                                     src="{{ $colorItem->thumbnail }}"
                                                     alt="">
                                            </a>
                                        </div>
                                    @endforeach
                                 @endif
                            </div>
                        </div>
                        <div class="d-none d-sm-flex">
                            @foreach($product->colors as $key => $colorItem)
                                <a type="button" class="{{ $loop->last ? '' : 'me-3' }}" wire:click="reRender({{ $key + 1 }})">
                                    <img class="mt-3 img-fluid color-img {{ $key +1 === $colorId ? 'sm-img-active' : '' }}"
                                         src="{{ $colorItem->thumbnail }}"
                                         alt="">
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
                        @php
                            $sizes = collect($color->sizes);
                            $sizes1 = $sizes->take(4);
                            $sizes2 = $sizes->except(array_keys($sizes1->toArray()));
                        @endphp

                        <div class="mt-3 d-flex justify-content-center justify-content-md-start">
                            @foreach($sizes1 as $size)
                                @if($size->qty <= 0)
                                    <div class="size-square"
                                         x-init="currentSize == '{{ $size->size }}' ? currentSize = null : null"
                                    >
                                        <span class="text-danger">{{ $size->size }}</span>
                                    </div>
                                @else
                                    <div class="size-square {{ $sizeSelected == $size->size ? 'size-square-active' : null }}"
                                         @click="currentSize = '{{ $size->size }}'"
                                         onclick="changeSize(this)"
                                    >
                                        {{ $size->size }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="mt-3 d-flex justify-content-center justify-content-md-start">
                            @foreach($sizes2 as $size)
                                @if($size->qty <= 0)
                                    <div class="size-square"
                                         x-init="currentSize == '{{ $size->size }}' ? currentSize = null : null"
                                    >
                                        <span class="text-danger">{{ $size->size }}</span>
                                    </div>
                                @else
                                    <div class="size-square {{ $sizeSelected == $size->size ? 'size-square-active' : null }}"
                                         @click="currentSize = '{{ $size->size }}'"
                                         onclick="changeSize(this)"
                                    >
                                        {{ $size->size }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @if($showAlert === true)
                        <div class="pt-4">
                            <div class="alert alert-{{ $alertType }} d-flex flex-column flex-sm-row justify-content-between" role="alert">
                                {!! $alertMessage !!}
                            </div>
                        </div>
                    @endif
                    <div class="pt-4 mt-2 p-lg-4 d-flex justify-content-center">
                        <button wire:click="addToCart({{$product}})" class="btn btn-lg btn-dark w-100 w-md-50">Add to cart</button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
