<div id="product-list-forms">
    <form method="GET" action="{{ route('products') }}" id="search_product">
        <div>
            <label for="search">
                Search:
                <input type="text" name="search" placeholder="Search..">
            </label>
        </div>
        <button type="submit">Search</button>
    </form>

    <form method="GET" action="{{ route('products') }}" id="sort_products">
        <div>
            <label for="sort">Sort By:</label>
            <select name="sort" id="sort">
                <option value="">None</option>
                <option value="name_asc">Name (A-Z)</option>
                <option value="name_desc">Name (Z-A)</option>
                <option value="price_asc">Price (Low to High)</option>
                <option value="price_desc">Price (High to Low)</option>
            </select>
        </div>
    </form>

    <form method="GET" action="{{ route('products') }}" id="pagination-form">
        <div class="pagination-links-form">
            <label for="perPage">Items Per Page:</label>
            <select name="perPage" id="perPage" onchange="sendPaginationRequest(this)">
                <option value="">Default</option>
                <option value="12">12</option>
                <option value="24">24</option>
                <option value="36">36</option>
            </select>
        </div>
    </form>
</div>