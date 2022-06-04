@if($type === 'table')
    <tr>
        <th class="p-4" scope="row">
            <a wire:click="showProduct({{ $item->options->product_id }})" data-bs-toggle="modal" data-bs-target="#singleProduct" href="#">
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
                        <div class="input-group align-items-center">
                            <input onKeyDown="return false" type="number" step="1" min="1" max="5" wire:model="qty" name="quantity" class="quantity-field border-0 text-center w-25">
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td class="p-4">
            <a wire:click="deleteItemFromCart('{{ $item->rowId }}')" style="cursor: pointer">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     width="24" height="24"
                     viewBox="0 0 48 48"
                     style=" fill:#undefined;"><path d="M 20.5 4 A 1.50015 1.50015 0 0 0 19.066406 6 L 14.640625 6 C 12.803372 6 11.082924 6.9194511 10.064453 8.4492188 L 7.6972656 12 L 7.5 12 A 1.50015 1.50015 0 1 0 7.5 15 L 8.2636719 15 A 1.50015 1.50015 0 0 0 8.6523438 15.007812 L 11.125 38.085938 C 11.423352 40.868277 13.795836 43 16.59375 43 L 31.404297 43 C 34.202211 43 36.574695 40.868277 36.873047 38.085938 L 39.347656 15.007812 A 1.50015 1.50015 0 0 0 39.728516 15 L 40.5 15 A 1.50015 1.50015 0 1 0 40.5 12 L 40.302734 12 L 37.935547 8.4492188 C 36.916254 6.9202798 35.196001 6 33.359375 6 L 28.933594 6 A 1.50015 1.50015 0 0 0 27.5 4 L 20.5 4 z M 14.640625 9 L 33.359375 9 C 34.196749 9 34.974746 9.4162203 35.439453 10.113281 L 36.697266 12 L 11.302734 12 L 12.560547 10.113281 A 1.50015 1.50015 0 0 0 12.5625 10.111328 C 13.025982 9.4151428 13.801878 9 14.640625 9 z M 11.669922 15 L 36.330078 15 L 33.890625 37.765625 C 33.752977 39.049286 32.694383 40 31.404297 40 L 16.59375 40 C 15.303664 40 14.247023 39.049286 14.109375 37.765625 L 11.669922 15 z"></path></svg>
            </a>
        </td>
    </tr>
@elseif($type === 'card')
    <div class="card my-4">
        <img src="{{ $item->options->thumbnail }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ $item->name }}</h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
                <div>
                    <strong>Price :</strong>
                </div>
                <span>
                    <strong>{{ $item->price }} LYD</strong>
                </span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <div>
                    <strong>Size :</strong>
                </div>
                <span>
                    <strong>{{ $item->options->size }}</strong>
                </span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <div>
                    <strong>Quantity :</strong>
                </div>
                <div>
                    <div class="input-group d-flex justify-content-end align-items-end">
                        <input type="number" onKeyDown="return false" step="1" min="1" max="5" wire:model="qty" name="quantity" class="quantity-field border-0 text-center w-25">
                    </div>
                </div>
             </li>
        </ul>
        <div class="card-body d-flex justify-content-center">
            <a wire:click="deleteItemFromCart('{{ $item->rowId }}')" style="cursor: pointer">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     width="24" height="24"
                     viewBox="0 0 48 48"
                     style=" fill:#undefined;"><path d="M 20.5 4 A 1.50015 1.50015 0 0 0 19.066406 6 L 14.640625 6 C 12.803372 6 11.082924 6.9194511 10.064453 8.4492188 L 7.6972656 12 L 7.5 12 A 1.50015 1.50015 0 1 0 7.5 15 L 8.2636719 15 A 1.50015 1.50015 0 0 0 8.6523438 15.007812 L 11.125 38.085938 C 11.423352 40.868277 13.795836 43 16.59375 43 L 31.404297 43 C 34.202211 43 36.574695 40.868277 36.873047 38.085938 L 39.347656 15.007812 A 1.50015 1.50015 0 0 0 39.728516 15 L 40.5 15 A 1.50015 1.50015 0 1 0 40.5 12 L 40.302734 12 L 37.935547 8.4492188 C 36.916254 6.9202798 35.196001 6 33.359375 6 L 28.933594 6 A 1.50015 1.50015 0 0 0 27.5 4 L 20.5 4 z M 14.640625 9 L 33.359375 9 C 34.196749 9 34.974746 9.4162203 35.439453 10.113281 L 36.697266 12 L 11.302734 12 L 12.560547 10.113281 A 1.50015 1.50015 0 0 0 12.5625 10.111328 C 13.025982 9.4151428 13.801878 9 14.640625 9 z M 11.669922 15 L 36.330078 15 L 33.890625 37.765625 C 33.752977 39.049286 32.694383 40 31.404297 40 L 16.59375 40 C 15.303664 40 14.247023 39.049286 14.109375 37.765625 L 11.669922 15 z"></path></svg>
            </a>
        </div>
    </div>
@endif
