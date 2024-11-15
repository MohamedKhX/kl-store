@props(['OrderName', 'orders'])

<div class="mt-4">
    <h4 class="text-center">
        {{ $orderName }} Orders
    </h4>
    <div class="mt-4 d-flex flex-column align-items-center justify-content-center">
        @foreach($orders as $order)
            <livewire:order-card :order="$order"/>
        @endforeach
    </div>
</div>
