<x-layout.Dashboard.main>
    Here we go to the show page
    {{--
        1- Show products in a good way
        2- Show thumbnail and the url and size and the price and the quantity
        3- Show total Price , Price , revnue , Shippin Price
        4- Status
        5- Can change status with out edit the product
        6- Name, Phone number, Notes, email , address,
        7- admin notes and you can edit them
    --}}
    <div class="container">
        <div class="">
            @foreach($products as $product)
                <x-dashboard.product-card :product="$product"/>
            @endforeach
        </div>
    </div>
</x-layout.Dashboard.main>
