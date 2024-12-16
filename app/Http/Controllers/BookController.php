<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class BookController extends Controller

{
    public function showBooksList(Request $request)
{
    $userId = Auth::id(); // Get the currently logged-in user's ID

    // Start with a query to get only the books by the logged-in user
    $books = Book::where('user_id', $userId)->orderBy('created_at', 'DESC');
   
    if (!empty($request->keyword)) {
        $books->where('title', 'like', '%' . $request->keyword . '%');
    }

    $books = $books->paginate(6);
    
    return view('books.list', [
        'books' => $books,
    ]);
}
    public function createBooks(){
        return view('books.createBooks');

    }
    public function storeBooks(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'genre' => 'required|string|max:255',
        
    ]);

    $book = new Book();
    $book->title = $request->title;
    $book->author = $request->author;
    $book->description = $request->description;
    $book->genre = $request->genre;
    $book->pages = $request->pages;
    $book->author_bio = $request->author_bio;
    $book->status = 1; // Default to active, or set it according to your logic
    $book->user_id = Auth::id(); // Assign the current user's ID

    // If handling file uploads
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $book->image = $path;
    }

    $book->save();

    return redirect()->route('books.showBooksList')->with('success', 'Book added successfully!');
}

    public function editBooks($id){
        $book = Book::findOrFail($id);
     
        return view('books.editBooks',[
            'book' => $book
        ]);

    }
    public function updateBooks($id, Request $request)
    {
        // Retrieve the book or fail if it doesn’t exist
        $book = Book::findOrFail($id);

        // Validate input data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',  // Ensure 'status' is present and a boolean
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genre' => 'required|string|max:255',
            'pages' => 'required|string|max:255',
            'author_bio' => 'required|string|max:555',
        ]);
        

        // Update book details
        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->description = $validatedData['description'];
        $book->status = $validatedData['status'];
        $book->genre = $validatedData['genre'];
        $book->pages = $validatedData['pages'];
        $book->author_bio = $validatedData['author_bio'];
        $book->user_id = Auth::id();

        // Handle image upload and replacement
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($book->image && File::exists(public_path('storage/' . $book->image))) {
                File::delete(public_path('storage/' . $book->image));
            }

            // Store the new image in 'public/images' directory and save path to DB
            $path = $request->file('image')->store('images', 'public');
            $book->image = $path;
        }

        // Save the updated book in the database
        $book->save();

        // Redirect back to books list with success message
        return redirect()->route('books.showBooksList')->with('success', 'Book updated successfully!');
    }


    public function deleteBooks($id) {
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
   
   

   // BookController.php
public function discover(Request $request)
{
   
    // Get the search keyword from the query string
    $keyword = $request->get('keyword');

    // Query books with a condition that checks if the keyword matches the title or author and apply pagination
    $books = Book::orderBy('created_at', 'DESC')
        ->where('status', 1)
        ->when($keyword, function ($query, $keyword) {
            return $query->where('title', 'like', '%' . $keyword . '%')
                         ->orWhere('author', 'like', '%' . $keyword . '%');
        })
        ->paginate(10);

    // Pass the books to the view
    return view('books.discover', compact('books'));
}
//  this meth will show book details page
  
public function details($id)
    {
        // Fetch the book by ID
        $book = Book::findOrFail($id);

        // Fetch the user who posted the book (assuming there's a relationship defined in Book model)
        $user = $book->user; // If Book has a 'user' relationship

        // Fetch similar books (e.g., books by the same author)
        $similarBooks = Book::where('status',1)->take(4)->where('id','!=',$id)->inRandomOrder()->get();
        $reviews = $book->reviews()->with('user')->get();

        return view('books.details', compact('book', 'user', 'similarBooks','reviews'));
    }





    
}
