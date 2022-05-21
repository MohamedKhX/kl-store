<x-layout.main>
    @foreach($products as $product)
        <x-panel :title="$product->name">
            <h2 style="font-weight: bold">Category: <span>{{ $product->category->name }}</span></h2>
            <div class="d-flex justify-content-center">
                <img src="{{ $product->thumbnail }}" alt="">
            </div>

            <h4 style="font-weight: bold">Colors:</h4>
            <ul>
                @foreach($product->colors as $color)
                    <x-panel :title="$color->color">
                        <h3 style="font-weight: bold">{{ $color->name }}</h3>
                        <div>
                            <h4 style="font-weight: bold">Description</h4>
                            <p>{{ $color->description }}</p>
                        </div>
                        <h4>Price: <span>{{ $color->price }}</span></h4>
                        <div>
                            <h4>Sizes: </h4>
                            <ul>
                                @foreach($color->sizes as $size)
                                    <li>{{ $size }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div>
                            @foreach($color->images as $img)
                                <img width="200" src="{{ $img }}" alt="">
                            @endforeach
                        </div>
                    </x-panel>
                @endforeach
            </ul>
        </x-panel>
    @endforeach
</x-layout.main>
