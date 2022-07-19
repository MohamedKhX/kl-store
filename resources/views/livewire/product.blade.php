<div>
    <div class="container">
        @if($showProduct)
            @auth()
                @if(auth()->user()->role === 'admin')
                    <div class="d-flex justify-content-center my-3">
                        <a class="btn btn-sm btn-dark" href="{{ route('admin.products.edit', $product) }}">Edit this product</a>
                    </div>
                    <div>
                        <h4>Fast Edit</h4>
                        @if (session()->has('updatedProduct'))
                            <div class="alert alert-success alert-dismissible " role="alert">
                                Updated successfully
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul class="py-0 my-0">
                                    @foreach($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="mb-4" wire:submit.prevent="handleFastUpdate">
                            <div class="mb-3">
                                <label for="color_priority" class="form-label">Color Priority</label>
                                <input wire:model.defer="color_priority" type="text" class="form-control" name="color_priority" id="color_priority" aria-describedby="emailHelp" value="{{ $color->priority }}">
                            </div><div class="mb-3">
                                <label for="color_priority" class="form-label">Product Priority</label>
                                <input wire:model.defer="product_priority" type="text" class="form-control" name="product_priority" id="product_priority" aria-describedby="emailHelp" value="{{ $color->priority }}">
                            </div>
                            <div class="mb-3">
                                <label for="outer_description" class="form-label">Outer Description</label>
                                <input wire:model.defer="outer_description" type="text" class="form-control" name="outer_description" id="outer_description" value="{{ $product->outer_description }}">
                            </div>
                            <button type="submit" class="btn btn-dark">Update</button>
                        </form>
                    </div>
                @endif
            @endauth


            <div x-data x-show="! window.location.href.split('#')[0].includes('/product')">
                <a class="text-dark bold mb-3" href="{{ route('show-product', [$product, $color->id]) }}">
                    <strong class="d-flex">
                        <img
                            style="margin-bottom: .2rem; margin-right: .2rem; transform: rotate(270deg)"
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABD0lEQVRIie3Vu0rEQBjF8R9iKe6iCOILWPg49iIr9lrZbmGRLio2FiJeGlufwIew9NKJlW7Efi0yrCFuLpNt98BAMvN9/5OcCRnmilQfd8gwjhwZbgNjosWSwTm2cYmfyIdbwl4w26kqynAaCS7qDKPixEKpYBlfNYAX0+N5Cuuf6BUbyhE16RibhfsB1rBV1RBrcFW4TgP8A+tVDeWI2irBAU5wUVfYxSDBUYAfNhXHGkTBiduD1F8sRfgbnttCxhhOmU/CWtrQPwx1E7WJKDqWGIPBLHCa9+ARu7juAm9j8BpGZ5Uj+sbKDLxV+Q9zovIbPGBf/iW8R8I3Qu99XVEfN7odOCP5XvX+Ueeq0y/UKk6QNmPcXgAAAABJRU5ErkJggg==">
                        <span style="">
                            فتح في صفحة أخرى
                        </span>
                    </strong>
                </a>
            </div>

                <div class="row animate__animated animate__fadeIn" x-data="{currentSize: @entangle('sizeSelected')}" x-init="load()">
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-2 d-none d-sm-block">
                                <div class="sm-images-box d-flex flex-column">
                                    @foreach($color->getImages() as $image)
                                        <img onclick="changeImg('{{ $image }}', this)" class="img-fluid sm-img {{ $loop->first ? 'sm-img-active' : '' }}" src="{{ $image }}" alt="">
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-12 col-sm-10">
                                <div class="d-none d-sm-block">
                                    <img src="{{ array_values($color->getImages())[0] ?? null }}" id="thumbnail" class="img-fluid singleProduct" alt="">
                                </div>
                                <div class="d-block d-sm-none">
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($color->getImages() as $image)
                                                <div class="carousel-item position-relative {{ $loop->first ? 'active' : '' }}">
                                                    <div class="">
                                                        <div style="
                                                         margin-left: auto;
                                                         margin-right: auto;
                                                         left: 0;
                                                         right: 0;
                                                         text-align: center;
                                                         top: 40%;
                                                         width: 4rem; height: 4rem; z-index: 100"
                                                             class="text-light position-absolute"
                                                             role="status"
                                                             wire:loading.class="spinner-border"
                                                             wire:target="changeColor"
                                                        >
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        <img
                                                            wire:loading.class="img_filter"
                                                            wire:target="changeColor"
                                                            src="{{ $image }}"
                                                            class="d-block w-100"
                                                            alt="..."
                                                        >
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>

                                        @if(count($color->getImages()) > 1)
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-xxl-5 pt-4">
                        <div class="pt-xxl-4">
                            <div class="d-flex align-items-center justify-content-between">
                                @if(ar())
                                    <h5>{{ $color->priceWithCurrency() }}</h5>

                                    <h4>{{ $product->name }}</h4>

                                @else
                                    <h4>{{ $product->name }}</h4>

                                    <h5>{{ $color->priceWithCurrency() }}</h5>
                                @endif
                            </div>
                            @if($product->outer_description)
                                <p style="color: #5e5e5e" class="fs-1 {{arRight()}}">{{ $product->outer_description }}</p>
                            @endif
                        </div>
                        <hr>
                        <div class="pt-4">
                            <div class="d-flex align-items-center {{ ar() ? 'justify-content-end' : 'justify-content-between ' }}">
                                <h3>
                                    {{ __('product.color') }}
                                </h3>
                            </div>
                            <div class="d-flex d-sm-none justify-content-center color-images-box">
                                <div class="row d-flex ">
                                    @if(count($product->colorsWithSizes()) === 1)
                                        @foreach($product->colorsWithSizes() as $colorItem)
                                            <div class="col-12">
                                                <a type="button" class="{{ $loop->last ? '' : 'me-3' }}" wire:click="changeColor({{ $colorItem->id }})">
                                                    <img @click="clearActive(); $el.classList.add('sm-img-active'); changeColorLink({{$product->id}}, '{{$colorItem->id}}')" class="mt-3 img-fluid color-img {{ $colorItem->id === $colorId ? 'sm-img-active' : '' }}"
                                                         src="{{ $colorItem->thumbnail() }}"
                                                         alt="">
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if(count($product->colorsWithSizes()) === 2)
                                        @foreach($product->colorsWithSizes() as $colorItem)
                                            <div class="col-6">
                                                <a type="button" class="" wire:click="changeColor({{ $colorItem->id }})">
                                                    <img  @click="clearActive(); $el.classList.add('sm-img-active'); changeColorLink({{$product->id}}, '{{$colorItem->id}}')" class="mt-3 img-fluid color-img {{ $colorItem->id === $colorId ? 'sm-img-active' : '' }}"
                                                         src="{{ $colorItem->thumbnail() }}"
                                                         alt="">
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if(count($product->colorsWithSizes()) >=  3)
                                        @foreach($product->colorsWithSizes() as $colorItem)
                                            <div class="col-4 d-flex justify-content-center">
                                                <a type="button" wire:click="changeColor({{ $colorItem->id }})">
                                                    <img @click="clearActive(); $el.classList.add('sm-img-active'); changeColorLink({{$product->id}}, '{{$colorItem->id}}')" class="mt-3 img-fluid color-img {{ $colorItem->id === $colorId ? 'sm-img-active' : '' }}"
                                                         src="{{ $colorItem->thumbnail() }}"
                                                         alt="">
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="d-none d-sm-flex">
                                @foreach($product->colorsWithSizes() as $colorItem)
                                    <a type="button" class="{{ $loop->last ? '' : 'me-3' }}" wire:click="changeColor({{ $colorItem->id }})">
                                        <img  @click="clearActive(); $el.classList.add('sm-img-active'); changeColorLink({{$product->id}}, '{{$colorItem->id}}')" class="mt-3 img-fluid color-img {{ $colorItem->id === $colorId ? 'sm-img-active' : '' }}"
                                             src="{{ $colorItem->thumbnail() }}"
                                             alt="">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="pt-5">
                            <div class="d-flex align-items-center {{ ar() ? 'justify-content-end' : 'justify-content-between ' }}">
                                <h3 class="{{arRight()}}">
                                    {{ __('product.size') }}
                                </h3>
                            </div>
                            @php
                                $allSizes = collect($color->sizes);
                                $sizes = [];

                                foreach ($allSizes as $size) {
                                    if($size->qty > 0) {
                                        $sizes[] = $size;
                                    }
                                }

                                $sizes = collect($sizes);
                                $sizes1 = $sizes->take(4);
                                $sizes2 = $sizes->except(array_keys($sizes1->toArray()))->take(4);

                                $exceptSizes = array_merge(array_keys($sizes1->toArray()), array_keys($sizes2->toArray()));

                                $sizes3 = $sizes->except($exceptSizes);
                            @endphp

                            <div class="mt-3 d-flex justify-content-center justify-content-md-start">
                                @foreach($sizes1 as $size)
                                    @if($size->qty <= 0)
                                        {{--<div class="size-square"
                                             x-init="currentSize == '{{ $size->size }}' ? currentSize = null : null"
                                        >
                                            <span class="text-danger">{{ $size->size }}</span>
                                        </div>--}}
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
                                       {{-- <div class="size-square"
                                             x-init="currentSize == '{{ $size->size }}' ? currentSize = null : null"
                                        >
                                            <span class="text-danger">{{ $size->size }}</span>
                                        </div>--}}
                                    @else
                                        <div class="size-square {{ $sizeSelected == $size->size ? 'size-square-active' : null }}"
                                             @click="currentSize = '{{ $size->size }}'"
                                             onclick="changeSize(this)"
                                        >
                                            {{ $size->size }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>      <div class="mt-3 d-flex justify-content-center justify-content-md-start">
                                @foreach($sizes3 as $size)
                                    @if($size->qty <= 0)
                                       {{-- <div class="size-square"
                                             x-init="currentSize == '{{ $size->size }}' ? currentSize = null : null"
                                        >
                                            <span class="text-danger">{{ $size->size }}</span>
                                        </div>--}}
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
                            <div class="pt-4 {{ arRight() }}">
                                <div class="alert alert-{{ $alertType }} d-flex flex-column flex-sm-row justify-content-between" role="alert">
                                    {!! $alertMessage !!}
                                </div>
                            </div>
                        @endif
                        <div class="pt-4 mt-2 p-lg-4 d-flex justify-content-center">
                            <button wire:click="addToCart({{$product}})"
                                    class="btn btn-lg btn-dark w-100 w-md-50"
                                    wire:loading.attr="disabled"
                            >
                                <div wire:loading.class="spinner-border spinner-border-sm"
                                     wire:target="addToCart"
                                     role="status"
                                >
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <span>
                                   {{ __('product.add_to_cart') }}
                                </span>
                            </button>
                        </div>
                    </div>

                <div class="accordion my-4" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                {{ __('product.description') }}
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="description text-end">{!! $product->description !!} </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
