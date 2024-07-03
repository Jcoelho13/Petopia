<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Collection;


class ProductController extends Controller
{
    public function list(Request $request)
    {
        $perPage = $request->input('perPage', 12);

        $productsQuery = Product::query()->with('reviews');

        if ($request->has('search')) {
            $searchQuery = $request->input('search');
            $productsQuery = Product::query()->when($searchQuery, function ($query) use ($searchQuery) {
                $tsquery = "plainto_tsquery('english', ?)";
                $query->whereRaw("tsv_vector @@ $tsquery", [$searchQuery]);
                $query->orderByRaw("ts_rank(tsv_vector, $tsquery) DESC", [$searchQuery]);
            });
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            if ($sort === 'name_asc') {
                $productsQuery->orderBy('name', 'asc');
            } elseif ($sort === 'name_desc') {
                $productsQuery->orderBy('name', 'desc');
            } elseif ($sort === 'price_asc') {
                $productsQuery->orderBy('price', 'asc');
            } elseif ($sort === 'price_desc') {
                $productsQuery->orderBy('price', 'desc');
            }
        }

        $selectedCategories = Collection::wrap($request->input('categories', []))->map(fn($category) => intval($category))->toArray();

        if (!empty($selectedCategories)) {
            $productsQuery->where(function ($query) use ($selectedCategories) {
                foreach ($selectedCategories as $categoryId) {
                    $query->orWhereHas('categories', function ($subQuery) use ($categoryId) {
                        $subQuery->where('category_id', $categoryId);
                    });
                }
            });
        }

        $products = $productsQuery->paginate($perPage)->appends(request()->except('page'));
        $products->each(function ($product) {
            $product->averageRating = $product->averageRating();
        });

        $categories = Category::all();

        return view('products.list', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategories' => $selectedCategories,
            'searchQuery' => $searchQuery ?? null,
        ]);
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', ['product' => $product]);
    }

    public function getAverageRating($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $averageRating = $product->reviews->avg('rating');

        return response()->json(['average_rating' => $averageRating]);
    }
}