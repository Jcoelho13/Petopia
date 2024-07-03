@extends('layouts.app')
@section('breadcrumbs')
    <nav aria-label="breadcrumb" class="breadcrumb">
        <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Reviews</li>
        </ol>
        @endsection
@section('content')

    <div class="reviews_container">
        @if (count($reviews) > 0)
            <h1 class="h1_review">Your reviews</h1>
            <ul>
                @foreach ($reviews as $review)
                    <li class="review">
                        <div id="review_info"
                             style="display: flex; justify-content: space-between; align-items: center;">
                            <a href="{{ route('products.show', ['id' => $review->product_id]) }}"><img
                                        src="{{ $review->image }}" alt="{{ $review->name }} image"></a>
                            <p style="flex: 1; text-align: left; padding-left: 1em">
                                <a href="{{ route('products.show', ['id' => $review->product_id]) }}">{{ $review->name }}</a>
                            </p>
                            <p style="margin-left: auto; font-weight: bold">
                                {{ $review->date }}
                            </p>
                        </div>
                        <p><strong>Title:</strong> {{ $review->title }}</p>
                        <p><strong>Description:</strong> {{ $review->body }}</p>
                        <p><strong>Rating:</strong> {{ $review->rating }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p>You have not published any reviews.</p>
        @endif
    </div>

@endsection
