@php use App\Models\Product; use App\Models\Review; @endphp
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products') }}">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="top_container">
        <h1>Product Details</h1>
        <div class="row">
            <img src="{{URL::asset($product->image)}}" alt="{{ $product->name }} image">
            <div class="product_info">
                <h2>{{ $product->name }}</h2>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Price:</strong> ${{ $product->price }}</p>
                <p><strong>Stock:</strong> {{ $product->stock }}</p>
                <p id="averageRating"><strong>Average
                        Rating:</strong> {{ number_format($product->reviews->avg('rating'), 1) }}</p>
            </div>
        </div>
    </div>

    <div class="text-right">
        @if(Auth::user() && Auth::user()->isAdmin()==false && $product->stock == 0)
            <a class="cool_button paint_sandybrown" href="{{ route('wishlist.add', ['product' => $product->id]) }}">Add to Wishlist</a>
        @elseif(Auth::user() && Auth::user()->isAdmin()==false && $product->stock > 0)
            <a class="cool_button paint_sandybrown" href="{{ route('wishlist.add', ['product' => $product->id]) }}">Add to Wishlist</a><br>
            <form method="post" id="add-to-cart-form" action="{{ route('cart.add', ['productId' => $product->id]) }}" data-product-id="{{ $product->id }}">
                @csrf
                <form method="post" action="{{ route('cart.add', ['productId' => $product->id]) }}">
                    @csrf
                    @method('POST')
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" required style="width: 45px; height: 30px; font-size: 1em">
                    <button type="submit" class="cool_button">Add to Cart</button>
                </form>
            </form>
        @elseif(!Auth::check() && $product->stock > 0)
            <form method="post" action="{{ route('cart.add', ['productId' => $product->id]) }}">
                @csrf
                @method('POST')
                <input type="hidden" name="guest_cart" value="true">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" required style="width: 45px; height: 30px; font-size: 1em">
                <button type="submit" class="cool_button">Add to Cart</button>
            </form>
        @endif
        <div class="alert-message" id="no-stock" style="display: none">
            <p>Not enough stock!</p>
        </div>
    </div>

    <div id="reviews_container">
        @if ($product->reviews->count() > 0)
            <h3 id="yes_reviews">Reviews:</h3>
            <p id="no_reviews" style="display: none">This product has no reviews.</p>
            <ul>
                @foreach ($product->reviews as $review)
                    <li class="review" data-review-id="{{ $review->id }}">
                        <div style="display: flex">
                            <img src="{{ URL::asset($review->user->profile_image) }}" alt="Profile Picture"
                                 style="height: 80px; width: auto; margin-right: 1em; border-radius: 4px">
                            <p><strong>{{ $review->user->name }}</strong></p>
                            <p style="margin-left: auto;"><strong>{{ $review->date }}</strong></p>
                        </div>
                        <p id="reviewTitle"><strong>Title:</strong> {{ $review->title }}</p>
                        <p id="reviewBody"><strong>Description:</strong> {{ $review->body }}</p>
                        <p id="reviewRating"><strong>Rating:</strong> {{ $review->rating }}</p>

                        @if (Auth::check() && Auth::user()->getAuthIdentifier() === $review->user_id)
                            <form method="post" id="delete-form" data-product-id="{{ $product->id }}"
                                  data-review-id="{{ $review->id }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="cool_button paint_tomato">Delete Review</button>
                            </form>
                        @endif
                        @if (Auth::check() && Auth::user()->getAuthIdentifier() === $review->user_id && Product::userAlreadyReviewed($product->id, Auth::user()->getAuthIdentifier()))
                            <div>
                                <button onclick="toggleEditReviewForm()" class="cool_button paint_sandybrown">Edit
                                    Review
                                </button>
                                <form id="editForm" data-product-id="{{ $product->id }}"
                                      data-review-id="{{ $review->id }}"
                                      style="display: none;">
                                    @csrf
                                    @method('put')
                                    <label for="edit_title">Edit Title:</label><br>
                                    <input type="text" name="edit_title" value="{{ $review->title }}"
                                           style="width: 400px; height: 30px"><br>

                                    <label for="edit_body">Edit Description:</label><br>
                                    <textarea name="edit_body"
                                              style="min-height: 50px; max-height: 150px; min-width: 800px; max-width: 100%">{{ $review->body }}</textarea><br>

                                    <label for="edit_rating">Edit Rating:</label>
                                    <input type="number" name="edit_rating" min="1" max="5"
                                           value="{{ $review->rating }}"
                                           required><br>

                                    <button type="submit" id="edit-review" class="cool_button paint_sandybrown">Update
                                    </button>
                                </form>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <h3 id="yes_reviews" style="display: none">Reviews:</h3>
            <p id="no_reviews">This product has no reviews.</p>
        @endif

        @if (Auth::check() && Product::userBought($product->id, Auth::user()->getAuthIdentifier()) && !Product::userAlreadyReviewed($product->id, Auth::user()->getAuthIdentifier()))
            <button id="showReviewForm" class="cool_button" onclick=toggleAddReviewForm()>Add Review</button>
            <form action="{{ route('reviews.add') }}" method="post" id="review-form" class="review"
                  style="display: none;" data-product-id="{{ $product->id }}">
                @csrf
                @method('post')
                <h3>Add a Review</h3>
                <label for="title">Title:</label><br>
                <input type="text" name="title" class="form-control" style="width: 400px; height: 30px"><br>
                <label for="body">Description:</label><br>
                <textarea name="body" class="form-control"
                          style="min-height: 50px; max-height: 150px; min-width: 800px; max-width: 100%"></textarea><br>
                <label for="rating">Rating:</label>
                <input type="number" name="rating" class="form-control" min="1" max="5" required><br>
                <input type="hidden" name="product_id" value="{{ $product->id }}"><br>
                <button type="submit" class="cool_button" id="submit_review">Submit Review</button>
            </form>
        @elseif (Auth::check() && Product::userBought($product->id, Auth::user()->getAuthIdentifier()) && Product::userAlreadyReviewed($product->id, Auth::user()->getAuthIdentifier()))
            <button id="showReviewForm" class="cool_button" style="display: none" onclick=toggleAddReviewForm()>Add
                Review
            </button>
            <form action="{{ route('reviews.add') }}" method="post" id="review-form" class="review"
                  style="display: none;" data-product-id="{{ $product->id }}">
                @csrf
                @method('post')
                <h3>Add a Review</h3>
                <label for="title">Title:</label><br>
                <input type="text" name="title" class="form-control" style="width: 400px; height: 30px"><br>
                <label for="body">Description:</label><br>
                <textarea name="body" class="form-control"
                          style="min-height: 50px; max-height: 150px; min-width: 800px; max-width: 100%"></textarea><br>
                <label for="rating">Rating:</label>
                <input type="number" name="rating" class="form-control" min="1" max="5" required><br>
                <input type="hidden" name="product_id" value="{{ $product->id }}"><br>
                <button type="submit" class="cool_button" id="submit_review">Submit Review</button>
            </form>
        @endif
    </div>

    <a class="cool_button" href="{{ route('products') }}">Back to Product List</a>
@endsection

@if(Auth::user() && Auth::user()->isAdmin())
    @include('layouts.admin_app')
@else
    @include('layouts.app')
@endif
