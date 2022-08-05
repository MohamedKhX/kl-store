<x-layout.Dashboard.main>
    <div class="container d-flex flex-column align-items-center justify-content-center">
        @if(session()->has('success'))
            <div class="w-100 alert alert-success mt-4">
                <span class="text-white">
                    {{ session()->get('success') }}
                </span>
            </div>
        @endif
        <livewire:order-details :order="$order"/>
        <div class="row d-flex justify-content-center">
            @foreach($products as $product)
                <livewire:order-product-card :product="$product" :order="$order"/>

            @endforeach
        </div>
    </div>
</x-layout.Dashboard.main>
