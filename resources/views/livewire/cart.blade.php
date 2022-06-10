<div>
    <div class="container-fluid container-lg mt-2">
        <div class="row">
            <div class="d-none d-xl-block col-8">
                @if(count($cartItems) <= 0)
                    <h3 class="p-7 text-center">No Products in the cart!</h3>
                @else
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th class="p-4" scope="col">COLOR</th>
                            <th class="p-4" scope="col">PRODUCT</th>
                            <th class="p-4" scope="col">SIZE</th>
                            <th class="p-4" scope="col">PRICE</th>
                            <th class="p-4" scope="col">QUANTITY</th>
                            <th class="p-4" scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <th class="p-4" scope="row">
                                    <a wire:click="showProduct({{ $item->options->product_id }})" data-bs-toggle="modal"
                                       data-bs-target="#singleProduct" href="#">
                                        <img class=""
                                             src="{{ $item->options->thumbnail }}"
                                             alt=""
                                             width="140"
                                        >
                                    </a>
                                </th>
                                <td class="w-25 p-4">
                                    <strong>
                                        {{ $item->name }}
                                    </strong>
                                </td>
                                <td class="p-4  text-center">
                                    <strong>
                                        {{ $item->options->size }}
                                    </strong>
                                </td>
                                <td class="p-2 text-center">
                                    <strong>
                                        {{ $item->price }} LYD
                                    </strong>
                                </td>
                                <td class="p-4">
                                    <div class="d-flex">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between">
                                                <div class="quantity buttons_added">
                                                    <input wire:click="decrement('{{ $item->rowId }}')" type="button" value="-" class="minus">
                                                    <input type="text"
                                                           onKeyDown="return false"
                                                           name="quantity" title="Qty"
                                                           class="input-text qty text"
                                                           wire:model="qtys.{{$item->rowId}}"
                                                    >
                                                    <input wire:click="increment('{{ $item->rowId }}')" type="button" value="+" class="plus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <a wire:click="deleteItemFromCart('{{ $item->rowId }}')" style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                             width="24" height="24"
                                             viewBox="0 0 48 48"
                                             style=" fill:#undefined;">
                                            <path
                                                d="M 20.5 4 A 1.50015 1.50015 0 0 0 19.066406 6 L 14.640625 6 C 12.803372 6 11.082924 6.9194511 10.064453 8.4492188 L 7.6972656 12 L 7.5 12 A 1.50015 1.50015 0 1 0 7.5 15 L 8.2636719 15 A 1.50015 1.50015 0 0 0 8.6523438 15.007812 L 11.125 38.085938 C 11.423352 40.868277 13.795836 43 16.59375 43 L 31.404297 43 C 34.202211 43 36.574695 40.868277 36.873047 38.085938 L 39.347656 15.007812 A 1.50015 1.50015 0 0 0 39.728516 15 L 40.5 15 A 1.50015 1.50015 0 1 0 40.5 12 L 40.302734 12 L 37.935547 8.4492188 C 36.916254 6.9202798 35.196001 6 33.359375 6 L 28.933594 6 A 1.50015 1.50015 0 0 0 27.5 4 L 20.5 4 z M 14.640625 9 L 33.359375 9 C 34.196749 9 34.974746 9.4162203 35.439453 10.113281 L 36.697266 12 L 11.302734 12 L 12.560547 10.113281 A 1.50015 1.50015 0 0 0 12.5625 10.111328 C 13.025982 9.4151428 13.801878 9 14.640625 9 z M 11.669922 15 L 36.330078 15 L 33.890625 37.765625 C 33.752977 39.049286 32.694383 40 31.404297 40 L 16.59375 40 C 15.303664 40 14.247023 39.049286 14.109375 37.765625 L 11.669922 15 z"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="col-12 my-3 d-xl-none">
                <div class="d-flex flex-column justify-content-center">
                    @if(count($cartItems) <= 0)
                        <h3 class="p-3 text-center">No Products in the cart!</h3>
                    @else
                        @foreach($cartItems as $item)
                            <div class="card my-4">
                                <a wire:click="showProduct({{ $item->options->product_id }})" data-bs-toggle="modal"
                                   data-bs-target="#singleProduct" href="#">
                                    <img src="{{ $item->options->thumbnail }}" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title {{arRight()}}">{{ $item->name }}</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between">
                                        @if(ar())
                                            <span>
                                                <strong>{{ __('elements.LYD') . '‎' }} {{ $item->price  }} </strong>
                                            </span>

                                            <div>
                                                <strong>{{ __('cart.price') }}</strong>
                                            </div>
                                        @else
                                            <div>
                                                <strong>{{ __('cart.price') }}</strong>
                                            </div>
                                            <span>
                                                <strong>{{ $item->price }} {{ __('elements.LYD') }}</strong>
                                            </span>
                                        @endif
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        @if(ar())
                                            <span>
                                               <strong>{{ $item->options->size }}</strong>
                                            </span>
                                            <div>
                                                <strong>{{ __('cart.size') }}</strong>
                                            </div>
                                        @else
                                            <div>
                                                <strong>{{ __('cart.size') }}</strong>
                                            </div>
                                            <span>
                                               <strong>{{ $item->options->size }}</strong>
                                            </span>
                                        @endif

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        @if(ar())
                                            <div>
                                                <div class="quantity buttons_added">
                                                    <input wire:click="decrement('{{ $item->rowId }}')" type="button" value="-" class="minus">
                                                    <input type="text"
                                                           onKeyDown="return false"
                                                           name="quantity" title="Qty"
                                                           class="input-text qty text"
                                                           wire:model="qtys.{{$item->rowId}}"
                                                    >
                                                    <input wire:click="increment('{{ $item->rowId }}')" type="button" value="+" class="plus">
                                                </div>
                                            </div>

                                            <div>
                                                <strong>{{ __('cart.qty') }}</strong>
                                            </div>
                                        @else
                                            <div>
                                                <strong>{{ __('cart.qty') }}</strong>
                                            </div>
                                            <div>
                                                <div class="quantity buttons_added">
                                                    <input wire:click="decrement('{{ $item->rowId }}')" type="button" value="-" class="minus">
                                                    <input type="text"
                                                           onKeyDown="return false"
                                                           name="quantity" title="Qty"
                                                           class="input-text qty text"
                                                           wire:model="qtys.{{$item->rowId}}"
                                                    >
                                                    <input wire:click="increment('{{ $item->rowId }}')" type="button" value="+" class="plus">
                                                </div>
                                            </div>
                                        @endif

                                    </li>
                                </ul>
                                <div x-data="{ disabled: true }" class="card-body d-flex justify-content-center">
                                    <a :disabled="disabled" wire:click="deleteItemFromCart('{{ $item->rowId }}')" style="cursor: pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                             width="24" height="24"
                                             viewBox="0 0 48 48"
                                             style=" fill:#undefined;">
                                            <path
                                                d="M 20.5 4 A 1.50015 1.50015 0 0 0 19.066406 6 L 14.640625 6 C 12.803372 6 11.082924 6.9194511 10.064453 8.4492188 L 7.6972656 12 L 7.5 12 A 1.50015 1.50015 0 1 0 7.5 15 L 8.2636719 15 A 1.50015 1.50015 0 0 0 8.6523438 15.007812 L 11.125 38.085938 C 11.423352 40.868277 13.795836 43 16.59375 43 L 31.404297 43 C 34.202211 43 36.574695 40.868277 36.873047 38.085938 L 39.347656 15.007812 A 1.50015 1.50015 0 0 0 39.728516 15 L 40.5 15 A 1.50015 1.50015 0 1 0 40.5 12 L 40.302734 12 L 37.935547 8.4492188 C 36.916254 6.9202798 35.196001 6 33.359375 6 L 28.933594 6 A 1.50015 1.50015 0 0 0 27.5 4 L 20.5 4 z M 14.640625 9 L 33.359375 9 C 34.196749 9 34.974746 9.4162203 35.439453 10.113281 L 36.697266 12 L 11.302734 12 L 12.560547 10.113281 A 1.50015 1.50015 0 0 0 12.5625 10.111328 C 13.025982 9.4151428 13.801878 9 14.640625 9 z M 11.669922 15 L 36.330078 15 L 33.890625 37.765625 C 33.752977 39.049286 32.694383 40 31.404297 40 L 16.59375 40 C 15.303664 40 14.247023 39.049286 14.109375 37.765625 L 11.669922 15 z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-12 d-xl-none">
                @if(count($cartItems) === 0)
                @else
                    <form action="">
                        <div class="mb-3">
                            <input type="text"
                                   class="form-control {{arRight()}}"
                                   placeholder="{{ __('cart.coupon_code')  }}"
                                   style="padding: .5rem 1rem"
                            >
                            <button class="btn btn-dark px-2 mt-3 w-100" type="button">{{ __('cart.apply_coupon') }}</button>
                        </div>
                    </form>
                @endif
            </div>

            <div class="col-12 col-xl-4">
                <div class="mt-7">
                    <h4 class="{{ arRight() }}">{{ __('cart.cart_totals') }}</h4>
                    <hr>
                    <div class="d-flex justify-content-between">
                        @if(ar())
                            <h5><strong> {{ __('elements.LYD') . '‎' }} {{ $subTotal }}</strong></h5>
                            <h5>{{ __('cart.sub_total') }}</h5>
                        @else
                            <h5>{{ __('cart.sub_total') }}</h5>
                            <h5><strong>{{ $subTotal }} {{ __('elements.LYD') }}</strong></h5>
                        @endif
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        @if(ar())
                            <h5><strong> {{  __('elements.LYD') . '‎' }} 30</strong></h5>
                            <h5>{{ __('cart.shipping_to') }} بنغازي </h5>
                        @else
                            <h5>{{ __('cart.shipping_to') }} Bangazi</h5>
                            <h5><strong>30 {{ __('elements.LYD') }}</strong></h5>
                        @endif
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        @if(ar())
                            <h5><strong>{{ __('elements.LYD') . '‎' }} {{ $total }} </strong></h5>
                            <h5>{{ __('cart.total') }}</h5>
                        @else
                            <h5>{{ __('cart.total') }}</h5>
                            <h5><strong>{{ $total }} {{ __('elements.LYD') }}</strong></h5>
                        @endif
                    </div>
                    <hr>
                    <button class="btn btn-dark w-100" {{ count($cartItems) === 0 ? 'disabled' : null }}>
                        {{ __('cart.proceed_to_checkout') }}
                    </button>
                </div>
            </div>

            <div class="col-4 d-none d-xl-block">
                <h4>Have a coupon?</h4>
                <form action="">
                    <div class="input-group mb-3">
                        <input type="text"
                               class="form-control"
                               placeholder="Coupon code"
                        >
                        <button class="btn btn-dark px-2" type="button">APPLY COUPON</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

