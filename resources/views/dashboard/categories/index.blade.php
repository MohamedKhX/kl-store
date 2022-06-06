<x-layout.Dashboard.main>
    <div class="container-fluid px-2 px-md-4 mt-5">
        <div class="d-flex justify-content-center justify-content-lg-end">
            <a class="btn btn-primary w-75 w-lg-25" href="{{ route('admin.categories.create') }}">Create a category</a>
        </div>
        @if(session()->has('success'))
            <div class="alert alert-success text-white" role="alert">
                <strong>Success!</strong> {{ session()->get('success') }}
            </div>
        @endif
        <div class="card d-none d-md-flex">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created_at</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated_at</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <h5 class="mb-0 text-xs"><a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a></h5>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    @if($category->status)
                                        <span class="badge bg-gradient-success">Active</span>
                                    @else
                                        <span class="badge bg-gradient-danger">DeActive</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $category->created_at }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $category->updated_at }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a class="text-xs font-weight-bold mb-0 me-4" href="{{ route('admin.categories.edit', $category->id) }}">
                                        Edit
                                    </a>
                                    <a onclick="categoryToDelete({{ json_encode($category) }}, {{count($category->products)}})" class="text-xs font-weight-bold mb-0 mr-2 text-danger" href=""  data-bs-toggle="modal" data-bs-target="#DeleteModal">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-md-none mt-5">
            @foreach($categories as $category)
                <div class="card my-5">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <a class="d-block blur-shadow-image" href="{{ route('admin.categories.show', $category->id) }}">
                            <img src="{{ url('storage/' . $category->thumbnail) }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                        </a>
                        <div class="colored-shadow" style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);"></div>
                    </div>
                    <div class="card-body text-center mt-5">
                        <div class="d-flex mt-n6 mx-auto">
                            <a class="btn btn-link text-primary ms-auto border-0"
                               onclick="categoryToDelete({{ json_encode($category) }}, {{count($category->products)}})"
                               data-bs-toggle="modal" data-bs-target="#DeleteModal"
                            >
                                <i class="material-icons text-lg">delete</i>
                            </a>
                            <a class="btn btn-link text-info me-auto border-0"
                                href="{{ route('admin.categories.edit', $category->id) }}"
                            >
                                <i class="material-icons text-lg">edit</i>
                            </a>
                        </div>
                        <h5 class="font-weight-normal mt-3">
                            <a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a>
                        </h5>
                        <p class="mb-0">
                            {{ $category->description }}
                        </p>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer d-flex justify-content-between">
                        <p class="font-weight-normal my-auto">Status :
                            @if((bool) $category->status)
                                <span class="badge bg-gradient-success">Active</span>
                            @else
                                <span class="badge bg-gradient-danger">DeActive</span>
                            @endif
                        </p>
                        <p class="font-weight-normal my-auto">Products : {{count($category->products)}}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Delete Model -->
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
                    <ul>
                        <li id="categoryName">Category: clothes</li>
                        <li id="categoryStatus">Status: Active</li>
                        <li id="categoryProducts">Products : 200</li>
                    </ul>
                    <h3 class="text-danger">Note: it will be deleted forever</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteForm" method="POST" action="{{ route('admin.categories.destroy', 1) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" hidden>
                    </form>
                    <button onclick="deleteCategory()" type="button" class="btn bg-gradient-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const form = document.getElementById('deleteForm');

            function categoryToDelete(category, productsCount)
            {
                const categoryName = document.getElementById('categoryName');
                const categoryStatus = document.getElementById('categoryStatus');
                const categoryProducts = document.getElementById('categoryProducts');

                let url = form.getAttribute('action').split('/');

                url = url.slice(0,-1).join('/') + '/' + category.id;

                form.setAttribute('action', url);

                let status = Boolean(category.status) ? 'Active' : 'DeActive';

                categoryName.textContent = 'Category : ' + category.name;
                categoryStatus.textContent = 'Status : '   + status;
                categoryProducts.textContent = 'Products : ' + productsCount;
            }

            function deleteCategory() {
                let form = document.getElementById('deleteForm');
                form.submit();
            }
        </script>
    @endpush
</x-layout.Dashboard.main>
