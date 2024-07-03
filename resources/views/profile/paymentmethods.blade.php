@extends('layouts.app')
@if(session('message'))
    <div class="alert-info-red">
        {{ session('message') }}
    </div>
@endif
@section('breadcrumbs')
    <nav aria-label="breadcrumb" class="breadcrumb">
        <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Payment Methods</li>
        </ol>
        @endsection
        @section('content')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(isset($methods) && $methods !== null && $methods->count() > 0)
                <ul class="container">
                    <h1 style="margin-top: 0">User Payment Methods</h1>
                    @foreach($methods as $paymentMethod)
                        <li class="payment-method">
                            {{ $paymentMethod->name }} -> {{ $paymentMethod->type }}
                            @if ($paymentMethod->type === 'MBWAY')
                                @if (isset($paymentMethod->mbway[0]->phonenumber))
                                    <span>Phone Number: {{ $paymentMethod->mbway[0]->phonenumber }}</span>
                                @endif
                            @else
                                @if (isset($paymentMethod->creditCards[0]->number))
                                    <span>Number: {{ $paymentMethod->creditCards[0]->number }}</span>
                                    <span>Expiration Date: {{ $paymentMethod->creditCards[0]->date }}</span>
                                @endif
                            @endif
                            <form action="{{ route('payment-methods.delete', $paymentMethod->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="details-button paint-red">Delete</button>
                            </form>
                        </li>
                    @endforeach
                    <div id="add-payment"><a href="{{ route('payment-methods.add') }}" class="details-button">Add Payment Method</a></div>
                </ul>
            @else
                <p>You have no payment methods associated.</p>
                <div id="add-payment"><a href="{{ route('payment-methods.add') }}" class="details-button">Add Payment Method</a></div>
            @endif

@endsection

