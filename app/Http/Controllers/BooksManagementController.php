<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BooksManagementController extends Controller
{
   
    public function createABook()
    {
        $books = Book::all(); // Fetch all readers from the database
        return view('admin.books-management', compact('books')); 
       
    }

    /**
     * Store a newly created book in the database.
     */
    public function storeABook(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:255',
            'pages' => 'required|integer|min:1',
            'author_bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $book = new Book($validated);
        $book->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $book->image = $path;
        }

        $book->save();

        return redirect()->back()->with('message', 'book added successfully!');
    }
    // In your BookController.php

public function editABook($id)
{
    // Find the book by its ID
    $book = Book::find($id);

    return view('admin.edit', compact('book'));
}
 // In your BookController.php

 public function updateABook(Request $request, $id)
 {
     // Validate the incoming request
     $request->validate([
         'title' => 'required|string|max:255',
         'author' => 'required|string|max:255',
         'status' => 'required|in:0,1', // Ensure the status is valid (0 or 1)
     ]);
 
     // Retrieve the book by ID or fail if it doesn't exist
     $book = Book::findOrFail($id);
 
     // Update the book's details
     $book->title = $request->input('title');
     $book->author = $request->input('author');
     $book->status = $request->input('status');
     $book->save(); // Save the changes to the database
 
     // Redirect to the admin.books-management route with a success message
     return redirect()->route('admin.books-management')
         ->with('message', 'Book updated successfully!');
 }
 

    
    
 public function destroyABook($id) {
    $book = Book::find($id);

    if($book == null){
        session()->flash('error','Book not found');
        return response()->json([
            'status' => false,
            'message' => 'Book not found'
        ]);
    } else {
        // Delete the book image if it exists
        if ($book->image && File::exists(public_path('storage/' . $book->image))) {
            File::delete(public_path('storage/' . $book->image));
        }

        // Delete the book record
        $book->delete();

        session()->flash('success','Book deleted successfully!');
        return response()->json([
            'status' => true,
            'message' => 'Book deleted successfully!'
        ]);
    }
}
}
