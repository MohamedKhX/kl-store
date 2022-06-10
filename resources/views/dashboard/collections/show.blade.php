<x-layout.Dashboard.main>
    <div class="container px-2 px-md-4 mt-5">
        @if(session()->has('success'))
            <div class="alert alert-success text-white" role="alert">
                <strong>Success!</strong> {{ session()->get('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-center align-items-center flex-column card p-4">
                <h5>{{ $collection->name }}</h5>
                <h6>Total products: {{ count($collection->products) }}</h6>
                <h6>Status:
                    @if($collection->status)
                        <span class="badge bg-gradient-success">Active</span>
                    @else
                        <span class="badge bg-gradient-danger">DeActive</span>
                    @endif
                </h6>
                <div class="d-flex flex-row justify-content-center">
                   <a class="btn btn-info" href="{{ route('admin.collections.edit', $collection->id) }}">Edit</a>
{{--
                    <h6><a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal">Delete</a></h6>
--}}
                </div>
            </div>
        <div class="row d-flex justify-content-center mt-5">
            @if(count($collection->products))
                @foreach($collection->products as $product)
                    <x-dashboard.product-card :product="$product" :delete-button="false"/>
                @endforeach
            @else
                <div class="d-flex justify-content-center align-items-center">
                    <h2>No Products in this collection</h2>
                </div>
            @endif
        </div>
    </div>
</x-layout.Dashboard.main>
