<div>
    @if($category->id === $currentCategory->id)
        <div class="tab-pane fade {{ $category->id === $currentCategory->id ? 'show active' : '' }}"
             id="pills-{{$category->slug}}"
             role="tabpanel"
             aria-labelledby="pills-{{$category->slug}}-tab">
            <div class="d-flex justify-content-center">
                <p class="text-center fs-1">
                    {{ $category->description }}
                </p>
            </div>
            <div class="row h-100 align-items-center g-2 d-flex justify-content-center">
                @foreach($products as $product)
                    <x-card.product :name="$product->name" :img="$product->thumbnail()" :price="$product->price()" oldPrice="{{ $product->oldPrice() }}">
                        <x-slot name="link">
                            <div style="cursor: pointer" class="stretched-link" href="#" wire:click="showProduct({{$product->id}})" data-bs-toggle="modal" data-bs-target="#singleProduct"></div>
                        </x-slot>
                    </x-card.product>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
    @endif
</div>

