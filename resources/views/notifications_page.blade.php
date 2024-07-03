@extends('layouts.app')

@section('content')
    <div id="notifications">
    <div id="unread-notifications">
        <h1>Unread Notifications</h1>
        @foreach($unreadNotifications as $notification)
            @php
                $notificationDate = \Carbon\Carbon::parse($notification->date)->format('d-m-Y H:i:s');
            @endphp
            <div id="notification">
                <p>{{ $notificationDate }} - {{ $notification->notify->body }}</p>
                @if ($notification->notify_type === 'App\Models\Notifications\PurchaseNotification')
                    <a href="{{ route('purchase-history.details', $notification->notify->purchase_id) }}" class="notification-anchor" data-notification-id="{{ $notification->id }}">Go to Purchase</a>
                @elseif ($notification->notify_type === 'App\Models\Notifications\ProductNotification')
                    <a href="{{ route('products.show', $notification->notify_id) }}" class="notification-anchor" data-notification-id="{{ $notification->id }}">Go to Product</a>
                @elseif ($notification->notify_type === 'App\Models\Notifications\WishListNotification')
                    <a href="{{ route('wishlist', $notification->notify_id) }}" class="notification-anchor" data-notification-id="{{ $notification->id }}">Go to Wishlist</a>
                @elseif ($notification->notify_type === 'App\Models\Notifications\CartNotification')
                    <a href="{{ route('cart', $notification->notify_id) }}" class="notification-anchor" data-notification-id="{{ $notification->id }}">Go to ShoppingCart</a>
                @endif
                <button class="mark-as-read" data-notification-id="{{ $notification->id }}">Mark as Read</button>
            </div>
        @endforeach
    </div>

    <div id="read-notifications">
        <h1>Read Notifications</h1>
        @foreach($readNotifications as $notification)
            @php
                $notificationDate = \Carbon\Carbon::parse($notification->date)->format('d-m-Y H:i:s');
            @endphp
            <div id="notification">
                <p>{{ $notificationDate }} - {{ $notification->notify->body }}</p>
                @if ($notification->notify_type === 'App\Models\Notifications\PurchaseNotification')
                    <a href="{{ route('purchase-history.details', $notification->notify_id) }}" class="notification-anchor">Go to Purchase</a>
                @elseif ($notification->notify_type === 'App\Models\Notifications\ProductNotification')
                    <a href="{{ route('products.show', $notification->notify_id) }}" class="notification-anchor">Go to Product</a>
                @elseif ($notification->notify_type === 'App\Models\Notifications\WishListNotification')
                    <a href="{{ route('wishlist', $notification->notify_id) }}" class="notification-anchor">Go to Wishlist</a>
                @elseif ($notification->notify_type === 'App\Models\Notifications\CartNotification')
                    <a href="{{ route('cart', $notification->notify_id) }}" class="notification-anchor">Go to ShoppingCart</a>
                @endif
            </div>
        @endforeach
    </div>
    </div>
@endsection
