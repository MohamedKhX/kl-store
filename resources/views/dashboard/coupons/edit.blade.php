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
                <h2 class="text-center">Edit a coupon</h2>
                <div class="col-12 col-md-10 col-lg-9 col-xl-8">
                    <form method="POST" action="{{ route('admin.coupons.update', $coupon) }}">
                        @csrf
                        @method('PATCH')
                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="coupon_code" class="form-label">Coupon Code</label>
                            <input id="coupon_code" name="coupon_code" type="text" class="form-control" value="{{ old('coupon_code') ?? $coupon->code }}">
                        </div>

                        <div class="form-group">
                            <label for="coupon_type">Coupon Type</label>
                            <select name="coupon_type" id="coupon_type" class="form-control selectpicker" data-style="btn btn-link">
                                @if($coupon->type == 'fixed')
                                    <option value="fixed" selected>Fixed</option>
                                    <option value="percent_off">Percent_off</option>
                                @else
                                    <option value="percent_off" selected>Percent_off</option>
                                    <option value="fixed">Fixed</option>
                                @endif
                            </select>
                        </div>

                        <div class="input-group input-group-outline my-3 is-focused">
                            <label for="coupon_value" class="form-label">Coupon Value</label>
                            <input id="coupon_value" name="coupon_value" type="text" class="form-control" value="{{ old('coupon_value') ?? $coupon->value }}">
                        </div>

                        <div>
                            <p>Number of uses: {{ $coupon->number_of_uses }}</p>
                            <div class="input-group input-group-outline my-3 is-focused">
                                <label for="coupon_max_users" class="form-label">Coupon Max Users</label>
                                <input id="coupon_max_users" name="coupon_max_users" type="text" class="form-control" value="{{ old('coupon_max_users') ?? $coupon->max_users }}">
                            </div>
                        </div>

                        <div>
                            <p> Expire at : {{ $coupon->expire_at }} </p>
                            <div class="input-group input-group-outline my-3 is-focused">
                                <label for="coupon_expire_at" class="form-label">Coupon Expire at</label>
                                <input id="coupon_expire_at" name="coupon_expire_at" type="date" class="form-control" value="{{ old('coupon_expire_at') ?? $coupon->expire_at }}">
                            </div>
                        </div>
                        <div class="form-check form-switch d-flex align-content-center">
                            <input class="form-check-input me-2" name="coupon_status" type="checkbox" id="coupon_status"
                                   {{ $coupon->status ? 'checked' : null }}>
                            <label class="form-check-label" for="coupon_status">Coupon Status</label>
                        </div>
                        <div class="input-group input-group-outline my-4 d-flex">
                            <input type="submit" class="btn btn-dark w-100 p-1 fs-6" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout.Dashboard.main>
