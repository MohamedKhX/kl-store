<div class="card w-100 w-md-75 w-lg-50 my-5">
    <div class="card-body text-center mt-2 p-3">
        <div class="">
            <div>

                <h6>
                    <strong class="">Name :</strong>
                    <a href="{{ route('admin.orders.show', $order) }}" class="text-primary">{{ $order->name }}</a>
                </h6>
                <h6>
                    <strong class="">Phone Number :</strong>
                    <span class="text-primary">{{ $order->phone_number }}</span>
                </h6>
                <hr>
            </div>
            <div class="px-6">
                <form wire:submit.prevent="handleSubmit">
                    @csrf
                    <div class="input-group input-group-static mb-3 d-flex flex-column align-items-center justify-content-center">
                        <label for="status" class="text-center">
                            Status
                        </label>

                        <select wire:model="status" name="status" class="form-control text-center" id="status">
                            <option value="Requested">
                                Requested
                            </option>
                            <option value="Accepted">
                                Accepted
                            </option>
                            <option value="Refused">
                                Refused
                            </option>
                            <option value="InComing">
                                InComing
                            </option>
                            <option value="InLibya">
                                InLibya
                            </option>
                            <option value="Arrived">
                                Arrived
                            </option>
                            <option value="No Response">
                                No Response
                            </option>
                            <option value="Not Accepted">
                                Not Accepted
                            </option>
                        </select>
                    </div>
                    <input class="btn btn-sm btn-info" type="submit" value="Save">
                </form>
                <h7 class="text-dark">
                    {{ $order->created_at->diffForHumans() }}
                </h7>
            </div>
            @if(session()->has('success'))
                <div class="alert alert-success fade show" role="alert">
                    <div class="d-flex justify-content-between">
                        <p class="text-center text-white bold p-0 mb-0">{!! session()->get('success') !!}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <hr class="dark horizontal my-0">
    <div class="card-footer d-flex justify-content-between">
        <p class="font-weight-normal my-auto">
            {{ $order->priceWithShipping() }} LYD
        </p>
        <p class="font-weight-normal my-auto me-4">
            <span class="text-danger">{{ $order->status }}</span>
        </p>
        <p class="font-weight-normal my-auto">
            {{ $order->city->name }}
        </p>
    </div>
</div>
