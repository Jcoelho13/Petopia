@extends('layouts.admin_app')

@section('content')
    <div class="top">
        <h1>{{ $product->name }}</h1>
        <a class="cool_button" href="{{ route('admin.products') }}">Previous page</a>
    </div>
    <div class="special_row">
        <img src="{{URL::asset($product->image)}}" alt="Product Image">
        <div class="column">
            <div class="product_data">
                <p><strong>ID</strong> - {{$product->id}}</p>
                <p><strong>Description</strong> - "{{$product->description}}"</p>
                <p><strong>Stock</strong> - {{$product->stock}}</p>
                <p><strong>Price</strong> - {{$product->price}} €</p>
                <p><strong>Nº of sales</strong> - {{ $product->purchases()->count() }}</p>
                <p><strong>Average rating</strong> - {{ $product->averageRating() }}</p>
                <p><strong>Nº of reviews</strong> - {{ $product->reviews()->count() }}</p>
            </div>
            <div class="buttons">
                <a href="{{ route('admin.product.edit', $product->id) }}" class="cool_button">Edit product's data</a>
                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')   
                    <button type="submit" class="not_cool_button" onclick="return confirm('Are you sure you want to delete this product?')">Delete product</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row space">
        <div class="tags">
            <h2>Product tags</h2>
            <div class="tags_container">
        @if ($product->tags == null)
                <p class="ups">No tags available</p>
        @else
            @foreach (explode(',', $product->tags) as $tag)
                    <p class="tag_category">{{$tag}}</p>
            @endforeach 
        @endif
            </div>
        </div>
        <div class="categories">
            <h2>Product categories</h2>
            <div class="categories_container">
        @if ($product->categories()->count() == 0)
                <p class="ups">No categories available</p>    
        @else
            @foreach ($product->categories() as $category)
                    <p class="tag_category">{{$category}} </p>
            @endforeach
        @endif
            </div>
        </div>
    </div>
    <div class="reviews_section">
        <h2>{{ $product->name }}'s reviews</h2>
        <div class="product_reviews">
            @if($product->reviews->count() == 0)
                <p>This product has no reviews.</p>
            @else
                @foreach ($product->reviews as $review)
                    <div class="review">
                        <div class="review_data">
                            <p style="display: none" class="id_hidden">{{ $review->id }}</p>
                            <p><strong>Review ID:</strong> {{ $review->id }}</p>
                            <p><strong>Product:</strong> {{ $review->product->name }}</p>
                            <p><strong>Date:</strong> {{ $review->date }}</p>
                            <div class="{{"review_details_".$review->id}}_button review_menu">
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                        </div>
                        <div class="review_details_{{ $review->id }} details hidden">
                            <div class="review_details">
                                <h3>Review Details</h3>
                                <p>User ID: {{ $review->user->id }}</p>
                                <p>Rating: {{ $review->rating }}/5</p>
                                <p>Title: {{ $review->title }}</p>
                                <p>Body: {{ $review->body }}</p>
                            </div>
                            <form action="{{ route('admin.product.review.delete', [$product->id, $review->id]) }}" class="delete_review_form" method="POST">
                                <p style="display: none" class="id_hidden">{{ $review->id }}</p>
                                <p style="display: none" class="product_id_hidden">{{ $product->id }}</p>
                                @csrf
                                @method('DELETE')   
                                <button type="submit" class="not_cool_button" onclick="return confirm('Are you sure you want to delete this review?')">Delete Review</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    
@endsection
