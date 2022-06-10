<x-layout.Dashboard.main>
    <div class="container px-2 px-md-4 mt-5">
        @if(session()->has('success'))
            <div class="alert alert-success text-white" role="alert">
                <strong>Success!</strong> {{ session()->get('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-center align-items-center flex-column card p-4">
            <h5>{{ $category->name }}</h5>
            <h6>Total products: {{ count($category->products) }}</h6>
            <h6>Status:
                @if($category->status)
                    <span class="badge bg-gradient-success">Active</span>
                @else
                    <span class="badge bg-gradient-danger">DeActive</span>
                @endif
            </h6>
            <div class="d-flex flex-row">
                <h6 class="me-3"><a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a></h6>
                <h6><a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal">Delete</a></h6>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-5">
            @if(count($category->products))
                @foreach($category->products as $product)
                    <x-dashboard.product-card :product="$product" :delete-button="false"/>
                @endforeach
            @else
                <div class="d-flex justify-content-center align-items-center">
                    <h2>No Products in this category</h2>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="DeleteModalLabel">Are you sure you want to delete the category?</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="text-danger">Note: it will be deleted forever</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteForm" method="POST" action="{{ route('admin.categories.destroy', $category->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" hidden>
                    </form>
                    <button onclick="submitForm()" type="button" class="btn bg-gradient-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const form = document.getElementById('deleteForm');
            function submitForm() {
                form.submit();
            }
        </script>
    @endpush
</x-layout.Dashboard.main>
