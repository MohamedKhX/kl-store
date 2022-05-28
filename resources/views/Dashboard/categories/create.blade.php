<x-layout.Dashboard.main>
    <div class="container-fluid px-2 px-md-4 mt-5 pt-5">
        <div class="card card-body mx-3 mx-md-4 mt-n6 mt-5">
            @if($errors->any())
                <div class="alert alert-danger text-white pb-1" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row d-flex justify-content-center">
                <h2 class="text-center">Create a new category</h2>
                <div class="col-12 col-md-10 col-lg-9 col-xl-8">
                    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input id="category_name" name="category_name" type="text" class="form-control" value="{{ old('category_name') }}">
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <textarea placeholder="Category Description..." class="form-control" name="category_description" id="category_description" cols="30" rows="10">{{ old('category_description') }}</textarea>
                        </div>
                        <div class="my-3">
                            <label for="category_thumbnail" class="form-label">Category Thumbnail</label>
                            <div class="input-group input-group-outline">
                                <input id="category_thumbnail" name="category_thumbnail" type="file" class="form-control" value="{{ old('category_thumbnail') }}">
                            </div>
                        </div>
                        <div class="form-check form-switch d-flex align-content-center">
                            <input class="form-check-input me-2" name="category_status" type="checkbox" id="category_status" checked>
                            <label class="form-check-label" for="category_status">Category Status</label>
                        </div>
                        <div class="input-group input-group-outline my-4 d-flex">
                            <input type="submit" class="btn btn-primary w-100 p-1 fs-6" value="Create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout.Dashboard.main>
