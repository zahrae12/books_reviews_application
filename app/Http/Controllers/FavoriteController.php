<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorites;

class FavoriteController extends Controller
{
    public function favoriteBooks()
    
    {
        $favorites = auth()->user()->favorites()->with('book')->paginate(10); // 8 books per page

      

        return view('favorites.favoriteBooks', compact('favorites'));
    }
    
    // add a book to fav
    public function addToFavorites(Request $request) {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'status' => 'required|string',
        ]);
    
        $user = auth()->user();
        $bookId = $request->input('book_id');
        $status = $request->input('status');
    
        // Check if the record already exists
        $favorite = $user->favorites()->updateOrCreate(
            ['book_id' => $bookId],
            ['status' => $status]
        );
    
        if ($favorite) {
            return back()->with('success', 'Book status updated successfully.');
        } else {
            return back()->with('error', 'Failed to update book status.');
        }
    }


    // remove from favorites
    public function removeFromFavorites($bookId)
    {
        // Find the book in the user's favorites
        $favorite = Favorites::where('user_id', Auth::id())->where('book_id', $bookId)->first();

        if ($favorite) {
            // Delete the favorite record
            $favorite->delete();
            return redirect()->route('favorites.favoriteBooks')->with('success', 'Book removed from favorites.');
        }

        return redirect()->route('favorites.favoriteBooks')->with('error', 'Book not found in favorites.');
    }

}
