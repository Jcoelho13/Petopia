@extends('layouts.admin_app')

@section('content')
<div class="top">
        <h1>Categories</h1>
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
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody id="table-body">
                @foreach($categories as $category)
                    <tr>
                        <td class="id_here">{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td><span class="not_cool_button delete_button">✖</span></td>                        
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <form method="GET" action="{{ route('admin.category.create') }}" id="add_category">
            <label for="name">Create new category:</label>
            <input type="text" name="name" id="name" placeholder="Category name...">
            <button type="submit">Create Category</button>
        </form>
    </div>
@endsection