@extends('layouts.app')
@section('breadcrumbs')
    <nav aria-label="breadcrumb" class="breadcrumb">
        <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
            <li class="breadcrumb-item"><a href="{{ route('purchase-history') }}">Purchase History</a></li>
            <li class="breadcrumb-item active" aria-current="page">Purchase</li>
        </ol>
        @endsection
@section('content')
    @if($purchase)
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="margin-top: 0">Purchase Details</h1>
                    <p>
                        <strong>Number of Products:</strong> {{ $purchaseDetails->count() }}<br>
                        <strong>Total Price:</strong> ${{ $purchaseDetails->sum('price') }}<br>
                        <strong>Tracking Status:</strong> {{ $purchase->tracking_status }}<br>
                        <strong>Tracking Number:</strong>
                        @if ($purchase->tracking_number)
                            {{ $purchase->tracking_number }}<br>
                        @elseif ($purchase->tracking_status == 'Canceled')
                            Your order has been canceled. No tracking number will be issued.<br>
                        @else
                            Tracking number hasn't been given yet<br>
                        @endif
                        @if ($purchase->tracking_status != 'Canceled')
                        <strong>Delivery Address:</strong> {{ $purchase->address }}<br>
                        @endif
                    </p>
                    @if ($purchase->tracking_status == 'Shipped')
                        <button class="cool_button"><a href="{{ route('purchase-history.tracking') }}">Track order</a></button>
                    @endif
                    @if ($purchase->tracking_status != 'Shipped' && $purchase->tracking_status != 'Canceled' && $purchase->tracking_status != 'Delivered')
                        <form action="{{ route('purchase-history.cancel', ['id' => $purchase->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="details-button paint-red">Cancel Order</button>
                        </form>
                    @endif
                    @if ($errors->any())
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <table class="table table-striped">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Order Date</th>
                        </tr>
                        @foreach($purchaseDetails as $purchaseDetail)
                            <tr>
                                <td>{{ $purchaseDetail->product->name }}</td>
                                <td>${{ $purchaseDetail->price }}</td>
                                <td>{{ $purchaseDetail->quantity }}</td>
                                <td>{{ $purchaseDetail->purchase->date }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                <h1>No Purchase Details Found</h1>
            </div>
        </div>
    @endif
@endsection