<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class ReviewManagementController extends Controller
{
   
    public function index()
    {
        // Fetch all reviews with associated books
        $reviews = Review::with('book')->get();
        $books = Book::all(); // Fetch books for the dropdown
        return view('admin.reviews-management', compact('reviews', 'books'));
    }
    // create a review  
    public function create()
    {
        // Fetch books to show in the dropdown for selecting a book
        $books = Book::all();
        return view('rev.create', compact('books'));
    }
    

    // store a review
    public function store(Request $request, Book $book)
    {
        // Validate the incoming request data
        $request->validate([
            'review' => 'required|string', // Validate the review content
            'rating' => 'required|integer|min:1|max:5', // Ensure the rating is between 1 and 5
            'book_id' => 'required|exists:books,id',
        ]);
        $book = Book::findOrFail($request->book_id);
        // Create a new review record for the specified book, associating it with the logged-in user
        $book->reviews()->create([
            'review' => $request->review,
            'rating' => $request->rating,
            'user_id' => auth()->id(), // Assuming you're using Laravel's authentication system
        ]);
    
        // Redirect back to the reviews list for the book with a success message
        return redirect()->route('admin.reviews-management', $book)->with('success', 'Review created successfully.');
    }
    


    // Show form to edit a review
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('rev.editrev', compact('review'));
    }

    // Update a review
   // Update a review
public function update(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'review' => 'required|string', // Validate the review content
        'rating' => 'required|integer|min:1|max:5', // Ensure the rating is between 1 and 5
    ]);

    // Find the review by its ID
    $review = Review::findOrFail($id);

    // Update the review
    $review->update([
        'review' => $request->review,
        'rating' => $request->rating,
    ]);

    // Redirect to the reviews management page with a success message
    return redirect()->route('admin.reviews-management')->with('success', 'Review updated successfully.');
}


    // Delete a review
    public function destroy($id)
    {
        $review = Review::findOrFail($id); // Find the review
        $review->delete(); // Delete the review
        return redirect()->route('admin.reviews-management')->with('success', 'Review deleted successfully.');
    }
}
