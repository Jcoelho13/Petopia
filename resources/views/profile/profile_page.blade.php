@extends('layouts.app')
@section('breadcrumbs')
    <nav aria-label="breadcrumb" class="breadcrumb">
        <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
@endsection
@section('content')
<section class="left">
    <div class="top_container">
        <div class="profile_image">
            <img src="{{ URL::asset($user->profile_image) }}" alt="Profile Picture">
        </div>
        <div class="profile_info">
            <div class="contents">
                <h2>{{ $user->name }}</h2>
                <h1>{{ $user->email }}</h1>
            </div>
        </div>
    </div>
    <div class="left_container">
        <h1>User Corner</h1>
        <div class="visible">
            <a href="{{ url('/purchasehistory') }}">
            <p>Purchase History</p>
            </a>
            <div class="magic_arrow">
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
        <div class="visible">
            <a href="{{ url('/paymentmethods') }}">
            <p>Payment Methods</p>
            </a>
            <div class="magic_arrow">
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
        <div class="visible">
            <a href="{{ url('/profile/my-reviews') }}">
            <p>My Reviews</p>
            </a>
            <div class="magic_arrow">
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
        <div class="buttons">
            <button class="cool_button" onclick="window.location='{{ route('profile.editPicture') }}'">Edit Picture</button>
            <button class="cool_button" onclick="window.location='{{ route('profile.edit') }}'">Edit Profile</button>
            <form action="{{ route('profile.delete', $user->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete" onclick="return confirm('Are you sure you want to delete your profile?')">Delete profile</button>
            </form>
        </div>
        </div>
</section>
<section class="top_right">
    <h1>Your latest order's status ↓</h1>
    <div class="orders">
        @if ($purchases->isEmpty())
            <p>No orders found.</p>
        @else
            @foreach ($purchases as $purchase)
                <div class="horizontal_container">
                    <div class="column">
                        <p>Tracking Number</p>
                        @if($purchase->tracking_number == null)
                            <p>Not yet available</p>
                        @else
                        <p>{{ $purchase->tracking_number }}</p>
                        @endif
                    </div>
                    <div class="column">
                        <p>Order Date</p>
                        <p>{{ $purchase->date }}</p>
                    </div>
                    <div class="column">
                        <p>Order Status</p>
                        <p>{{ $purchase->tracking_status }}</p>
                    </div>
                    <div class="column">
                        <p>Product Quantity</p>
                        <p>{{ $purchaseDetails[$purchase->id]->count() }}</p>
                    </div>
                    <div class="column">
                        <p>Order Total</p>
                        <p>€ {{ $purchaseDetails[$purchase->id]->sum('price') }}</p>
                    </div>
                    <div class="column">
                        <button class="cool_button"><a href="{{ route('purchase-history.tracking') }}">Track order</a></button>
                        <button class="cool_button"><a href="{{ route('purchase-history.details', ['id' => $purchase->id]) }}">Order Details</a></button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>

@endsection
