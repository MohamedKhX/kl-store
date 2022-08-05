<div class="mt-4">
    <h4 class="text-center">
        {{ $ordersName }} Orders
    </h4>
    <div class="mt-4 d-flex flex-column align-items-center justify-content-center">
        @foreach($orders as $order)
            <livewire:order-card :order="$order" :wire:key="'order-'.$order->id"/>
        @endforeach
    </div>
</div>
