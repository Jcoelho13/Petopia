@extends('layouts.admin_app')

@section('content')
    <div class="top">
        <h1>Create a product</h1>
        <a class="cool_button" href="{{ route('admin.products') }}">Previous page</a>
    </div>
    <div class="error">
        @if($errors->any())
            {{ $errors->first() }}
        @endif
    </div>
    <form method="POST" action="{{ route('admin.product.create') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <label for="product_image">Select an image</label>
        <input type="file" class="form-control-file" id="product_image" class="product_image_input" name="product_image">

        <label for="product_name">Product name:</label>
        <input type="text" id="product_name" name="product_name" required>

        <label for="description">Descritpion:</label>
        <input type="text" id="description" name="description" required>

        <label for="price">Price:</label>
        <input type="number" step="0.01" min="0" id="price" name="price" required>

        <label for="stock">Stock:</label>
        <input type="number" step="1" min="0" id="stock" name="stock" required>

        <label for="tags">Tags:</label>
        <input type="text" id="tags" name="tags" required>

        <div class="categories">
            <h2>Categories</h2>
            <div class="categories_container">
                @foreach ($categories as $category)
                    <div class="category">
                        <input type="checkbox" id="category_{{ $category->id }}"name="category[]">
                        <label for="{{ $category->name }}">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <button class="cool_button" type="submit">Create product</button>
    </form>
@endsection