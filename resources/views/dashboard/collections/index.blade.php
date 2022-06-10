<x-layout.Dashboard.main>
    <div class="container-fluid px-2 px-md-4 mt-5">
        <div class="d-flex justify-content-center justify-content-lg-end">
            <a class="btn btn-primary w-75 w-lg-25" href="{{ route('admin.collections.create') }}">Create a collection</a>
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
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Collection</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created_at</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated_at</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($specialCollections as $collection)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <h5 class="mb-0 text-xs"><a href="{{ route('admin.collections.show', $collection->id) }}">{{ $collection->name }}</a></h5>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    @if($collection->status)
                                        <span class="badge bg-gradient-success">Active</span>
                                    @else
                                        <span class="badge bg-gradient-danger">DeActive</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $collection->created_at }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $collection->updated_at }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a class="text-xs font-weight-bold mb-0 me-4" href="{{ route('admin.collections.edit', $collection->id) }}">
                                        Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Collection</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created_at</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated_at</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($collections as $collection)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <h5 class="mb-0 text-xs"><a href="{{ route('admin.collections.show', $collection->id) }}">{{ $collection->name }}</a></h5>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    @if($collection->status)
                                        <span class="badge bg-gradient-success">Active</span>
                                    @else
                                        <span class="badge bg-gradient-danger">DeActive</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $collection->created_at }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $collection->updated_at }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a class="text-xs font-weight-bold mb-0 me-4" href="{{ route('admin.collections.edit', $collection->id) }}">
                                        Edit
                                    </a>
                                    <a onclick="collectionToDelete({{ json_encode($collection) }}, {{count($collection->products)}})" class="text-xs font-weight-bold mb-0 mr-2 text-danger" href=""  data-bs-toggle="modal" data-bs-target="#DeleteModal">
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

            <div>
                <h3 class="text-center">Special Collections</h3>
                @foreach($specialCollections as $collection)
                    <div class="card my-5">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <a class="d-block blur-shadow-image" href="{{ route('admin.collections.show', $collection->id) }}">
                                <img src="{{ url('storage/' . $collection->thumbnail) }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                            </a>
                            <div class="colored-shadow" style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);"></div>
                        </div>
                        <div class="card-body text-center mt-5">
                            <div class="d-flex mt-n6 mx-auto">
                                <a class="btn btn-link text-primary ms-auto border-0"
                                   onclick="collectionToDelete({{ json_encode($collection) }}, {{count($collection->products)}})"
                                   data-bs-toggle="modal" data-bs-target="#DeleteModal"
                                >
                                    <i class="material-icons text-lg">delete</i>
                                </a>
                                <a class="btn btn-link text-info me-auto border-0"
                                   href="{{ route('admin.collections.edit', $collection->id) }}"
                                >
                                    <i class="material-icons text-lg">edit</i>
                                </a>
                            </div>
                            <h5 class="font-weight-normal mt-3">
                                <a href="{{ route('admin.collections.show', $collection->id) }}">{{ $collection->name }}</a>
                            </h5>
                            <p class="mb-0">
                                {{ $collection->description }}
                            </p>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer d-flex justify-content-between">
                            <p class="font-weight-normal my-auto">Status :
                                @if((bool) $collection->status)
                                    <span class="badge bg-gradient-success">Active</span>
                                @else
                                    <span class="badge bg-gradient-danger">DeActive</span>
                                @endif
                            </p>
                            <p class="font-weight-normal my-auto">Products : {{count($collection->products)}}</p>
                        </div>
                    </div>
                @endforeach
                    <hr>
            </div>

            <div>
                <h3 class="text-center">Other Collections</h3>
                @foreach($collections as $collection)
                    <div class="card my-5">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <a class="d-block blur-shadow-image" href="{{ route('admin.collections.show', $collection->id) }}">
                                <img src="{{ url('storage/' . $collection->thumbnail) }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                            </a>
                            <div class="colored-shadow" style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);"></div>
                        </div>
                        <div class="card-body text-center mt-5">
                            <div class="d-flex mt-n6 mx-auto">
                                <a class="btn btn-link text-primary ms-auto border-0"
                                   onclick="collectionToDelete({{ json_encode($collection) }}, {{count($collection->products)}})"
                                   data-bs-toggle="modal" data-bs-target="#DeleteModal"
                                >
                                    <i class="material-icons text-lg">delete</i>
                                </a>
                                <a class="btn btn-link text-info me-auto border-0"
                                   href="{{ route('admin.collections.edit', $collection->id) }}"
                                >
                                    <i class="material-icons text-lg">edit</i>
                                </a>
                            </div>
                            <h5 class="font-weight-normal mt-3">
                                <a href="{{ route('admin.collections.show', $collection->id) }}">{{ $collection->name }}</a>
                            </h5>
                            <p class="mb-0">
                                {{ $collection->description }}
                            </p>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer d-flex justify-content-between">
                            <p class="font-weight-normal my-auto">Status :
                                @if((bool) $collection->status)
                                    <span class="badge bg-gradient-success">Active</span>
                                @else
                                    <span class="badge bg-gradient-danger">DeActive</span>
                                @endif
                            </p>
                            <p class="font-weight-normal my-auto">Products : {{count($collection->products)}}</p>
                        </div>
                    </div>
                @endforeach
                <hr>
            </div>

        </div>
    </div>

    {{-- Start Delete Model --}}
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="DeleteModalLabel">Are you sure you want to delete the collection?</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li id="collectionName">Collection: clothes</li>
                        <li id="collectionStatus">Status: Active</li>
                        <li id="collectionProducts">Products : 200</li>
                    </ul>
                    <h3 class="text-danger">Note: it will be deleted forever</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteForm" method="POST" action="{{ route('admin.collections.destroy', 1) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" hidden>
                    </form>
                    <button onclick="deleteCollection()" type="button" class="btn bg-gradient-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Delete Model --}}

    @push('scripts')
        <script>
            const form = document.getElementById('deleteForm');



            function collectionToDelete(collection, productsCount)
            {
                const collectionName = document.getElementById('collectionName');
                const collectionStatus = document.getElementById('collectionStatus');
                const collectionProducts = document.getElementById('collectionProducts');

                let url = form.getAttribute('action').split('/');

                url = url.slice(0,-1).join('/') + '/' + collection.id;

                form.setAttribute('action', url);

                let status = Boolean(collection.status) ? 'Active' : 'DeActive';

                collectionName.textContent = 'Collection : ' + collection.name;
                collectionStatus.textContent = 'Status : '   + status;
                collectionProducts.textContent = 'Products : ' + productsCount;
            }

            function deleteCollection() {
                let form = document.getElementById('deleteForm');
                form.submit();
            }
        </script>
    @endpush
</x-layout.Dashboard.main>
