@extends('layouts.app-no-breadcrumbs')

@section('content')
    <div id="cart-container">
        <h2 class="h1_cart">Your Shopping Cart</h2>
            @if (!Auth::check())
                @if (empty($cart))
                    <p>Your cart is empty.</p>
                @else
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th style="padding-left: 1.5em">Price</th>
                            <th style="padding-left: 1em">Total</th>
                            <th style="padding-left: 4em">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $totalQuantity = 0;
                            $totalPrice = 0;
                        @endphp

                        @foreach ($cart as $productId => $quantity)
                            @php
                                $product = \App\Models\Product::find($productId);
                                $totalQuantity += $quantity;
                                $totalPrice += ($product->price * $quantity);
                            @endphp
                            <tr>
                                <td><img src="{{ URL::asset($product->image) }}" alt="{{ $product->name }} image"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $quantity }}</td>
                                <td style="padding-left: 1.5em">${{ number_format($product->price, 2) }}</td>
                                <td style="padding-left: 1em">${{ number_format($product->price * $quantity, 2) }}</td>
                                <td style="padding-left: 4em">
                                    <a href="{{ route('cart.remove', ['product' => $productId]) }}" class="button-red">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <p style="text-align: right"><strong>Total Quantity:</strong> {{ $totalQuantity }} items</p>
                    <p style="text-align: right"><strong>Total Price:</strong> ${{ number_format($totalPrice, 2) }}</p>

                    <div class="checkout">
                        <p>Please Login/Register to checkout</p>
                        <a href="{{ route('cart.remove-all') }}" class="button-red">Clear Cart</a>
                    </div>
                @endif
            @else
            @if ($cart && $cart->products->isEmpty())
                <p>Your cart is empty.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th style="padding-left: 1.5em">Price</th>
                        <th style="padding-left: 1em">Total</th>
                        <th style="padding-left: 4em">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cart->products as $product)
                        <tr>
                            <td><img src="{{ URL::asset($product->image) }}" alt="{{$product->name}} image"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td style="padding-left: 1.5em">${{ number_format($product->price, 2) }}</td>
                            <td style="padding-left: 1em">${{ number_format($product->price * $product->quantity, 2) }}</td>
                            <td style="padding-left: 4em">
                                <a href="{{ route('cart.remove', ['product' => $product->product_id]) }}" class="button-red">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <p style="text-align: right"><strong>Total Quantity:</strong> {{ $cart->getTotalQuantity() }} items</p>
                <p style="text-align: right"><strong>Total Price:</strong> ${{ number_format($cart->getTotalPrice(), 2) }}</p>

                <div class="checkout">
                    <a href="{{ route('checkout') }}" class="button-green">Checkout</a>
                    <a href="{{ route('cart.remove-all') }}" class="button-red">Clear Cart</a>
                </div>
            @endif
        @endif
    </div>
@endsection
