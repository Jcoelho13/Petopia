@extends('layouts.app')

@section('content')
    <div id="wishlist-container">
        <h1 class="h1_wishlist">Your Wishlist</h1>
        @if ($wishlist->products->isEmpty())
            <p>Your wishlist is empty.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th style="padding-left: 2em">Price</th>
                    <th style="padding-left: 1em">Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($wishlist->products as $product)
                    <tr>
                        <td><img src="{{ URL::asset($product->image) }}" alt="{{$product->name}} image"></td>
                        <td>{{ $product->name }}</td>
                        <td style="padding-left: 2em">${{ $product->price }}</td>
                        <td style="padding-left: 1em">{{ $product->stock > 0 ? 'Available' : 'Out of Stock'}}</td>
                        <td>
                            <div style="display: flex; justify-content: center; align-items: center;">
                            @if ($product->stock > 0)

                                <form method="post" action="{{ route('cart.add', ['productId' => $product->product_id]) }}" style="margin-right: 1em">
                                    @csrf
                                    @method('POST')
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" required style="width: 45px; height: 30px; font-size: 1em">
                                    <button type="submit" class="button-green">Add to Cart</button>
                                </form>

                            @endif
                            <a href="{{ route('wishlist.remove', ['product' => $product->product_id]) }}" class="button-red">Remove</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="remove_all">
                <a href="{{ route('wishlist.remove-all') }}" class="button-red">Remove All</a>
            </div>
        @endif
    </div>
@endsection
