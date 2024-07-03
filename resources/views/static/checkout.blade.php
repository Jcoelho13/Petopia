@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<div class="purchase_products">
<h1>Products in this purchase</h1>
<div class="products">
    @foreach ($cart->products as $product)
    <div class="product">
        <div class="row">
            <img src="{{$product->image}}" alt="Product image">
            <div class="product_info">
                <h2>Product name: {{$product->name}}</h2>
                <p>Product description: {{$product->description}}</p>
                <p>Product price: {{$product->price}} €</p>
            </div>
        </div>
    </div>     
    @endforeach 
</div>
</div>
<div class="checkout">
    <h1>Checkout details</h1>
    <div class="row">
        <p>Total cost</p>
        <p>{{$cart->getTotalPrice()}} €</p>
    </div>
    <div class="divider"></div>
    <div class="divider"></div>
    <div class="row">
        <p>Products in this order</p>
        <p>{{$cart->getTotalQuantity()}}</p>
    </div>
    <div class="divider"></div>
    <form id = "checkout-form" action="{{ route('checkout') }}" method="POST" onsubmit="return validateForm()">
        @csrf
        <div class="row">
            <label for="shipping_address">Shipping address</label>
            <input type="text" id="shipping_address" name="shipping_address" placeholder="Enter your shipping address" required>
            <div class="error-message" style="display: none; color: red;">Please fill out this field</div>
        </div>
        <label for="payment_method">Payment method</label>
        <select name="payment_method" id="payment_method">
            @if ($paymentMethods->isEmpty())
                <option value="" disabled>No payment methods available</option>
                <option value="add_payment_method">Add Payment Method</option>
            @else
                @foreach ($paymentMethods as $paymentMethod)
                    <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                @endforeach
                <option value="add_payment_method">Add Payment Method</option>
            @endif
        </select>
        <input type="submit" value="Confirm checkout">
    </form>
</div>

    <script>
        function validateForm() {
            const shippingAddress = document.getElementById('shipping_address').value.trim();
            const errorDiv = document.querySelector('.error-message');

            if (!shippingAddress) {
                errorDiv.style.display = 'block';
                return false;
            } else {
                errorDiv.style.display = 'none';
                return true;
            }
        }

        document.getElementById('checkout-form').addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });
    </script>
@endsection