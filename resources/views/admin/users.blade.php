@extends('layouts.admin_app')

@section('content')
    <div class="top">
        <h1>Welcome to the user database</h1>
        <a class="cool_button" href="{{ route('admin.admin') }}">Previous page</a>
    </div>
    <div class="table">
        <div class="row">
            <form method="GET" action="{{ route('admin.users') }}">
                <label for="sort_by">Sort By:</label>
                <select name="sort_by" id="sort_by">
                    <option value="id_asc">ID Ascending</option>
                    <option value="id_desc">ID Descending</option>
                    <option value="name_asc">Name Ascending (A-Z)</option>
                    <option value="name_desc">Name Descending (Z-A)</option>
                </select>
            </form>
            <form method="GET" action="{{ route('admin.users') }}" id="search">
                <label for="search_field">Search By:</label>
                <select name="search_field" id="search_by_field">
                    <option value="email">Email</option>
                    <option value="name">Name</option>
                </select>
                <input type="text" name="search" id="search_field" placeholder="Search keywords...">
                <button type="submit">Search</button>
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
                <th>Email</th>
                <th>See more</th>
            </tr>
            </thead>
            <tbody id="table-body">
            @foreach($nonAdminUsers as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a class="see_more" href="{{route('admin.user', $user->id)}}">→</a></td>                        
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="add_user">
        <p>Want to create a new user?<p>
        <a href="{{ route('admin.create.user') }}" class="cool_button">Create User</a>
    </div>
@endsection