<x-layout.Dashboard.main>

    {{-- Start Index Coupons --}}
    <div class="container px-2 px-md-4 px-lg-8 px-xl-10 mt-5">
        <div class="d-flex justify-content-center justify-content-lg-end">
            <a class="btn btn-primary w-75 w-lg-25" href="{{ route('admin.coupons.create') }}">Create a Coupon</a>
        </div>
        @if(session()->has('success'))
            <div class="alert alert-success text-white" role="alert">
                <strong>Success!</strong> {{ session()->get('success') }}
            </div>
        @endif
        <div class="mt-5">
            @if($coupons->count() > 0)
                @foreach($coupons as $coupon)
                    <div class="card my-5">
                        <div class="card-body text-center mt-4">
                            <h5 class="font-weight-normal mt-2">
                                <a href="{{ route('admin.coupons.show', $coupon->id) }}">{{ $coupon->code }}</a>
                            </h5>
                            <div class="mt-3">
                                <p><strong class="text-black">Type:</strong> <span>{{ $coupon->type }}</span></p>
                                <p><strong class="text-black">Max users:</strong> <span>{{ $coupon->max_users }}</span></p>
                                <p><strong class="text-black">Number of uses:</strong> <span>{{ $coupon->number_of_uses }}</span></p>
                            </div>
                            <div class="d-flex mt-3 mx-auto">
                                <a class="btn btn-link  text-primary ms-auto border-0"
                                   onclick="couponToDelete({{ $coupon->id }})"
                                   data-bs-toggle="modal" data-bs-target="#DeleteModal"
                                >
                                    <i class="material-icons text-lg">delete</i>
                                </a>
                                <a class="btn btn-link text-info me-auto border-0"
                                   href="{{ route('admin.coupons.edit', $coupon->id) }}"
                                >
                                    <i class="material-icons text-lg">edit</i>
                                </a>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer d-flex justify-content-between">
                            <p class="font-weight-normal my-auto">Status :
                                @if((bool) $coupon->status)
                                    <span class="badge bg-gradient-success">Active</span>
                                @else
                                    <span class="badge bg-gradient-danger">DeActive</span>
                                @endif
                            </p>
                            <p class="font-weight-normal my-auto">Valid to use :
                                @if($coupon->isValidToUse())
                                    <span class="badge bg-gradient-success">Yes</span>
                                @else
                                    <span class="badge bg-gradient-danger">No</span>
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center">
                    <h2>No Coupons!</h2>
                </div>
            @endif


        </div>
    </div>
    {{-- End Index Coupons --}}

    {{-- Start Delete Model --}}
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="DeleteModalLabel">Are you sure you want to delete the coupon?</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="text-danger">Note: it will be deleted forever</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteForm" method="POST" action="{{ route('admin.coupons.destroy', 1) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" hidden>
                    </form>
                    <button onclick="deleteCoupon()" type="button" class="btn bg-gradient-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Delete Model --}}

    {{-- Start Javascript --}}
    @push('scripts')
        <script>
            const form = document.getElementById('deleteForm');

            function couponToDelete(id)
            {
                let url = form.getAttribute('action').split('/');

                url = url.slice(0,-1).join('/') + '/' + id;

                form.setAttribute('action', url);
            }

            function deleteCoupon() {
                let form = document.getElementById('deleteForm');
                form.submit();
            }
        </script>
    @endpush
    {{-- End Javascript --}}
</x-layout.Dashboard.main>
