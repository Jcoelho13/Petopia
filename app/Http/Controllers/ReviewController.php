<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function addReview(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:50',
            'body' => 'nullable|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
            'product_id' => 'required|exists:product,id',
        ]);

        $user = Auth::user();

        $existingReview = Review::where('user_id', $user->getAuthIdentifier())
            ->where('product_id', $validatedData['product_id'])
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already submitted a review for this product.');
        }

        $review = new Review();
        $review->title = $validatedData['title'];
        $review->body = $validatedData['body'];
        $review->rating = $validatedData['rating'];
        $review->product_id = $validatedData['product_id'];
        $review->user_id = $user->getAuthIdentifier();
        $review->date = now();

        $review->save();

        return redirect()->back()->with('success', 'Review added successfully!');
    }

    public function deleteReview(Request $request, $productId, $review_id)
    {
        $review = Review::findOrFail($review_id);

        $user = Auth::user();
        if ($user->getAuthIdentifier() != $review->user_id) {
            return response()->json(['success' => false, 'message' => 'You do not have permissions to delete the review.']);
        }

        try {
            $review->delete();
            $productReviewsCount = Review::where('product_id', $productId)->count();
            return response()->json(['success' => true, 'message' => 'Review deleted successfully', 'review_id' => $review->id, 'reviews_left' => $productReviewsCount]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting review: ' . $e->getMessage()]);
        }
    }

    public function updateReview(Request $request, $productId, $reviewId)
    {
        $review = Review::findOrFail($reviewId);

        $user = Auth::user();

        if ($user->getAuthIdentifier() != $review->user_id) {
            return response()->json(['success' => false, 'message' => 'You do not have permissions to edit the review.']);
        }

        $newTitle = $request->input('edit_title');
        $newBody = $request->input('edit_body');
        $newRating = $request->input('edit_rating');

        $review->title = $newTitle;
        $review->body = $newBody;
        $review->rating = $newRating;
        $review->date = now();

        try {
            $review->save();
            return response()->json(['success' => true, 'message' => 'Review edited successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error editing review: ' . $e->getMessage()]);
        }
    }
}