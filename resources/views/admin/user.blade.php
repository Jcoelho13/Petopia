@extends('layouts.admin_app')

@section('content')
    <div class="top">
        <h1>{{ $globalUser->name }}'s Information</h1>
        <a class="cool_button" href="{{ route('admin.users') }}">Previous page</a>
    </div>
    <div class="">
        <div class="row">
            <img src="{{URL::asset('/image/user.png')}}" alt="User Image">
            <div class="user_data">
                <div class="text">
                    <p><strong>ID:</strong> {{ $globalUser->id }}</p>
                    <p><strong>Name:</strong> {{ $globalUser->name }}</p>
                    <p><strong>Email:</strong> {{ $globalUser->email }}</p>
                    <p><strong>Wallet:</strong> {{ $user->wallet }}€</p>
                </div>
                <div class="buttons">
                    <a href="{{ route('admin.user.edit', $user->id) }}" class="cool_button">Edit user's data</a>
                    <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')   
                        <button type="submit" class="not_cool_button" onclick="return confirm('Are you sure you want to delete this user?')">Delete user</button>
                    </form>
                    <form action="{{ route('admin.ban.unban.user', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @if($globalUser->isbanned == 1)
                            <button type="submit" class="cool_button" onclick="return confirm('Are you sure you want to unban this user?')">Unban user</button>
                        @else
                            <button type="submit" class="not_cool_button" onclick="return confirm('Are you sure you want to ban this user?')">Ban user</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="purchase_history">
        <h2>{{ $globalUser->name }}'s purchase history</h2>
        <div class="user_purchases">
            @if($user->purchases->count() == 0)
                <p>This user has no purchases.</p>
            @else
                @foreach ($user->purchases as $purchase)
                    <div class="purchase">
                        <div class="purchase_data">
                            <p style="display: none" class="id_hidden">{{ $purchase->id }}</p>
                            <p><strong>Purchase ID:</strong> {{ $purchase->id }}</p>
                            <p><strong>Date:</strong> {{ $purchase->date }}</p>
                            <p><strong>Total:</strong> {{ $purchase->getTotal() }}€</p>
                            <div class="{{"purchase_details_".$purchase->id}}_button purchase_menu">
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                        </div>
                        <div class="{{"purchase_details_".$purchase->id}} details hidden">
                            <div class="purchase_details">
                                <p style="display: none" class="id_hidden">{{ $purchase->id }}</p>
                                <p style="display: none" class="user_id_hidden">{{ $user->id }}</p>
                                <h3>Purchase Details</h3>
                                <p>Payment Method Name: {{ $purchase->paymentMethod->name }}</p>
                                <p>Tracking Status: <select name="tracking_status" id="tracking_status" class="tracking_select">
                                    <option value="Pending" {{ $purchase->tracking_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Shipped" {{ $purchase->tracking_status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="Delivered" {{ $purchase->tracking_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="Canceled" {{ $purchase->tracking_status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                                </select></p>
                                <p>Tracking Number: {{ $purchase->tracking_number }}</p>
                            </div>
                            <div class="purchase_products">
                                <h3>Purchase Products</h3>
                                <div class="products">
                                    @foreach ($purchase->details as $detail)
                                        <div class="purchase_product">
                                            <img src="{{URL::asset($detail->product->image)}}" alt="Product Image">
                                            <div>
                                                <p>Product: {{ $detail->product->name }}</p>
                                                <p>Quantity: {{ $detail->quantity }}</p>
                                                <p>Price: {{ $detail->price }}€</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="reviews_section">
        <h2>{{ $globalUser->name }}'s reviews</h2>
        <div class="user_reviews">
            @if($user->reviews->count() == 0)
                <p>This user has no reviews.</p>
            @else
                @foreach ($user->reviews as $review)
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
                                <p>Rating: {{ $review->rating }}/5</p>
                                <p>Comment: {{ $review->comment }}</p>
                            </div>
                            <form action="{{ route('admin.user.review.delete', [$user->id, $review->id]) }}" class="delete_review_form" method="POST">
                                <p style="display: none" class="id_hidden">{{ $review->id }}</p>
                                <p style="display: none" class="user_id_hidden">{{ $user->id }}</p>
                                @csrf
                                @method('DELETE')   
                                <button type="submit" class="not_cool_button" onclick="return confirm('Are you sure you want to delete this review?')">Delete Review</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
