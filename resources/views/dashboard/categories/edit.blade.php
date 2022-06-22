<x-layout.Dashboard.main>
    <div class="container-fluid px-2 px-md-4 mt-5">
        <div class="d-flex justify-content-center align-content-center">
            <div class="page-header min-height-250 w-100 border-radius-xl mt-4" style="background-image: url('{{ url('storage/'. $category->thumbnail) }}');">
            </div>
        </div>


        <div class="card card-body mx-3 mx-md-4 mt-n6">
            @if($errors->any())
                <div class="alert alert-success text-white pb-1" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row d-flex justify-content-center">
                <h2 class="text-center">Edit a Category</h2>
                <div class="col-12 col-md-10 col-lg-9 col-xl-8">
                    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input id="category_name" name="category_name" type="text" class="form-control" value="{{ $category->name }}">
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <textarea placeholder="Category Description..." class="form-control" name="category_description" id="category_description" cols="30" rows="10">{{ $category->description }}</textarea>
                        </div>

                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="category_priority" class="form-label">Priority</label>
                            <input id="category_priority" name="category_priority" type="text" class="form-control" value="{{ $category->priority }}">
                        </div>

                        <div class="my-3">
                            <label for="category_thumbnail" class="form-label">Category Thumbnail</label>
                            <div class="input-group input-group-outline">
                                <input id="category_thumbnail" name="category_thumbnail" type="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-check form-switch d-flex align-content-center">
                            <input class="form-check-input me-2" name="category_status" type="checkbox" id="category_status"
                                {{ (bool) $category->status ? 'checked' : null}}
                            >
                            <label class="form-check-label" for="category_status">Category Status</label>
                        </div>
                        <div class="input-group input-group-outline my-4 d-flex">
                            <input type="submit" class="btn btn-primary w-100 p-1 fs-6" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-layout.Dashboard.main>
