<h2>Categories</h2>
<form method="GET" action="{{ route('products') }}" id="category_filter">
    @if(isset($categories) && $categories->isNotEmpty())
        <div>
            @foreach ($categories as $category)
                <div>
                    <input type="checkbox" id="category_{{ $category->id }}" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }} onclick="sendCategoryFilterRequest()">
                    <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                </div>
            @endforeach
        </div>
    @endif
</form>