<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\Book;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function createReview($book_id){

        $book = Book::findOrFail($book_id);
        
     

        // Return a view with the book data (assuming you have a 'reviews.create' view)
        return view('reviews.createReview', compact('book'));
    }


    public function storeReview(Request $request, $book_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to add a review.');
        }
    
        // Validate the incoming review data
        $request->validate([
            'review' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'book_id' => 'required|exists:books,id'
        ]);
    
        // Ensure Auth::id() returns a valid user ID
        $user_id = Auth::id(); // This should not be null
    
        // Create and save the new review
        Review::create([
            'review' => $request->input('review'),
            'rating' => $request->input('rating'),
            'user_id' => $user_id,  // Set the user_id to the currently authenticated user
            'book_id' => $book_id,
        ]);
    
        // Redirect back or to a specific page with a success message
        return redirect()->route('books.details', $book_id)->with('success', 'Review added successfully!');
    }


    //for my reviews 
    public function showReviews()
    {
        // Fetch all reviews for the logged-in user
        $reviews = Auth::user()->reviews;
        $reviews = Review::with('book') // eager load the related book
                     ->paginate(6); // Change 10 to the number of reviews you want per page

        return view('reviews.showReviews', compact('reviews'));
    }
    
    // edit the reviews
    public function editReview(Review $review)
    {
        // Check if the logged-in user is the owner of the review
        if ($review->user_id != Auth::id()) {
            return redirect()->route('reviews.showReviews', $review->book_id)->with('error', 'You cannot edit this review.');
        }

        return view('reviews.editReview', compact('review'));
    }

    // update the review:
    public function update(Request $request, $review_id)
{
    $review = Review::findOrFail($review_id);
    
    // Make sure the review belongs to the authenticated user
    if ($review->user_id !== Auth::id()) {
        return redirect()->route('reviews.showReviews')->with('error', 'Unauthorized access');
    }

    $request->validate([
        'review' => 'required|string|max:255',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $review->update([
        'review' => $request->input('review'),
        'rating' => $request->input('rating'),
    ]);

    return redirect()->route('reviews.showReviews')->with('success', 'Review updated successfully');
}

//    delete the review
   
public function destroy($review_id)
{
    $review = Review::findOrFail($review_id);

    // Make sure the review belongs to the authenticated user
    if ($review->user_id !== Auth::id()) {
        return redirect()->route('reviews.showReviews')->with('error', 'Unauthorized access');
    }

    $review->delete();

    return redirect()->route('reviews.showReviews')->with('success', 'Review deleted successfully');
}

}
