@extends('layouts.admin_app')

@section('content')
<div class="top">
    <h1>Edit product info</h1>
    <a class="cool_button" href="{{ route('admin.product', ['id' => $product->id]) }}">Previous Page</a>
</div>
<div class="error">
    @if($errors->any())
        {{ $errors->first() }}
    @endif
</div>
<img src="{{URL::asset($product->image)}}" alt="Product Image" id="image">
<form method="POST" action="{{ route('admin.product.image.update', ['id' => $product->id]) }}" class="image_form" enctype="multipart/form-data">
    @csrf
    <p class="product_id hidden">{{ $product->id }}</p>
    <div class="row">
        <label for="product_image"></label>
        <input type="file" class="form-control-file" id="product_image" class="product_image_input" name="product_image">
        <button class="cool_button" type="submit">Change Image</button>
    </div>
</form>
<form method="POST" id="categories">
    <h2>Categories</h2>
    <table>
        <thead>
            <tr>
                <th>Categories</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table_body">
            
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <p class="hidden category_id">{{ $category->id }}</p>
                        <p class="hidden product_id">{{ $product->id }}</p>
                        @if($product->categories->contains($category->id))
                            <p class="not_cool_button reduce_width action_button">Remove</p>
                        @else
                            <p class="cool_button reduce_width action_button">Add</p>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
<form action="{{ route('admin.product.update', ['id' => $product->id]) }}" method="POST" id="product_info">
    @csrf
    <h2>Product info</h2>
    <label for="product_name">Product name:</label>
    <input type="text" id="product_name" name="product_name" value="{{ $product->name }}" required>

    <label for="description">Descritpion:</label>
    <input type="text" id="description" name="description" value="{{ $product->description }}" required>

    <label for="price">Price:</label>
    <input type="number" step="0.01" min="0" id="price" name="price" value="{{ $product->price }}" required>

    <label for="stock">Stock:</label>
    <input type="number" step="1" min="0" id="stock" name="stock" value="{{ $product->stock }}" required>

    <label for="tags">Tags:</label>
    <input type="text" id="tags" name="tags" value="{{ $product->tags }}" required>

    <button class="cool_button" type="submit">Update product</button>
</form>

@endsection