@extends('layouts.app')
@section('breadcrumbs')
    <nav aria-label="breadcrumb" class="breadcrumb">
        <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Purchase History</li>
        </ol>
        @endsection
@section('content')
    @if(count($purchases) > 0)
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="margin-top: 0">Purchase History</h1>
                    @foreach($purchases as $index => $purchase)
                        <div class="ph">
                        <h2>Purchase Number {{ $index + 1 }}</h2>
                        <p>
                            <strong>Number of Products:</strong> {{ $purchaseDetails[$purchase->id]->count() }}<br>
                            <strong>Total Price:</strong> ${{ $purchaseDetails[$purchase->id]->sum('price') }}
                        </p>
                        <a href="{{ route('purchase-history.details', ['id' => $purchase->id]) }}" class="details-button">View Purchase Details</a>
                        <table class="table table-striped">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Order Date</th>
                            </tr>
                            @foreach($purchaseDetails[$purchase->id] as $purchaseDetail)
                                <tr>
                                    <td>{{ $purchaseDetail->product->name }}</td>
                                    <td>${{ $purchaseDetail->price }}</td>
                                    <td>{{ $purchaseDetail->quantity }}</td>
                                    <td>{{ $purchase->date }}</td>
                                </tr>
                            @endforeach
                        </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                <h1>No Purchase History</h1>
            </div>
        </div>
    @endif
@endsection
