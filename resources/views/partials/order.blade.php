<div class="horizontal_container">
    <div class="column">
        <p>Order Number</p>
        <p>{{$order->tracking_number}}</p>
    </div>
    <div class="column">
        <p>Order Date</p>
        <p>{{$order->"date"}}</p>
    </div>
    <div class="column">
        <p>Order Status</p>
        <p>{{$order->tracking_status}}</p>
    </div>
    <div class="column">
        <p>Product Quantity</p>
        <p>{{$order->product_number}}</p>
    </div>
    <div class="column">
        <p>Order Total</p>
        <p>{{$order->total}}</p>
    </div>
    <div class="column">
        <button class="cool_button">Track order</button>
        <button class="cool_button">Order Details</button>
    </div>
</div>