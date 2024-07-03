

@section('content')
    <div id="products-container">
        <div id="products-container-left">
            @include('partials.category_filter')
        </div>

        <div id="products-container-right">
            <h1>Product List</h1>

            @include('partials.product_list_forms')

            @if ($searchQuery)
                <p>Results found for: "{{ $searchQuery }}"</p>
            @endif

            @include('partials.product_list')

            <div class="pagination-links" id="pagination">
                @if ($products->previousPageUrl())
                    <a href="{{ $products->previousPageUrl() }}">Previous</a>
                @endif

                @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <a href="{{ $products->url($i) }}" class="{{ $i == $products->currentPage() ? 'active' : '' }}">{{ $i }}</a>
                @endfor

                @if ($products->nextPageUrl())
                    <a href="{{ $products->nextPageUrl() }}">Next</a>
                @endif
            </div>
        </div>
    </div>

@endsection

@if(Auth::user() && Auth::user()->isAdmin())
    @include('layouts.admin_app')
@else
    @include('layouts.app')
@endif