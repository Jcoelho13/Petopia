@extends('layouts.admin_app')

@section('content')
<div class="top">
        <h1>Product Database</h1>
        <a class="cool_button" href="{{ route('admin.admin') }}">Previous page</a>
    </div>
    <div class="column">
        <div class="table">
            <div class="row">
                <form method="GET" action="{{ route('admin.products') }}" id="sort" >
                    <label for="sort_by">Sort By:</label>
                    <select name="sort_by" id="sort_by">
                        <option value="id_asc">ID Ascending</option>
                        <option value="id_desc">ID Descending</option>
                        <option value="name_asc">Name Ascending (A-Z)</option>
                        <option value="name_desc">Name Descending (Z-A)</option>
                    </select>
                </form>
                <form method="GET" action="{{ route('admin.products') }}" id="search" >
                    <input type="text" name="search" id="search_field" placeholder="Search keywords...">
                    <button type="submit">Apply</button>
                </form>
                <form method="GET" action="{{ route('admin.users') }}" id="reset">
                    <button id="red" type="submit">Reset Table</button>
                </form>
            </div>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>See more</th>
                </tr>
                </thead>
                <tbody id="table-body">
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td><a class="see_more" href="{{route('admin.product', $product->id)}}">→</a></td>                        
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="add_product">
            <p>Want to create a new product?</p>
            <a href="{{ route('admin.product.create') }}" class="cool_button">Create product</a>
        </div>
    </div>
@endsection