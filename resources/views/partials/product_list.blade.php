<div id="product-list-container">
    <ul class="product-items">
        @forelse ($products as $product)
            <li>
                <a href="{{ route('products.show', $product->id) }}">
                    <img src="{{URL::asset($product->image)}}" alt="{{ $product->name }} image">
                </a>
                <a href="{{ route('products.show', $product->id) }}">
                    {{ $product->name }}
                </a>
                - ${{ $product->price }}
                <br>
                @if ($product->reviews->count() > 0)
                    - Average Rating: {{ number_format($product->reviews->avg('rating'), 1) }}
                @else
                    - This product has no reviews
                @endif
            </li>
        @empty
            <li>No products found.</li>
        @endforelse
    </ul>
</div>