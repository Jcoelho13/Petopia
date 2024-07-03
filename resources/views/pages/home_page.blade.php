@extends('layouts.app-no-breadcrumbs')

@section('content')
<div class="first_section">
    <h2>Welcome to Petopia {{ Auth::check() ? ", ".Auth::user()->name : ""}} - Where Paw-sibilities Are Endless!</h2>
    <div class="p_row">
        <p>At Petopia, we believe that every pet deserves a slice of paradise, and that's exactly what we've created for your beloved companions. Our virtual shelves are brimming with an enchanting array of pet essentials, from haute couture canine fashion to deluxe feline fortresses, and everything in between.</p>
        <span class="vertical_divider"></span>
        <p>Whether you're looking for a new leash, a cozy bed, or a fancy new toy, you'll find it here. We've got all the latest and greatest pet products, and we're constantly adding new items to our inventory. We're also proud to offer a wide range of products for pet parents, including stylish apparel, fun accessories, and more.</p>
    </div>
</div>
<div class="second_section">
    <div class="r_col">
        <h2>Product of the month</h2>
        <p>This month's product is the <a href="{{ url('/products/1') }}">Milk Bone Doggy Treats</a>! They are made with the best ingredients and your dog will love them! Take advantage of our 50% discount on each bag of Doggy Treats you buy and get as much as you can for your dog.</p>
    </div>
    <img src="{{URL::asset('/image/dog_treats.png')}}" alt="dog treats">
</div>
@endsection