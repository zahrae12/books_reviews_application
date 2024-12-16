<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Assume you have a Book model
use App\Models\Review; 

class WelcomeController extends Controller
{
    public function welcomeHome(Request $request)
    {
        // Retrieve the latest featured books
        $featuredBooks = Book::latest()->take(5)->get();

        // Retrieve the latest book reviews
        $latestReviews = Review::latest()->take(4)->get();

        $keyword = $request->input('keyword');

        // Search for books that match the keyword in the title or author
        $bookslist = Book::where('title', 'like', '%' . $keyword . '%')
            ->orWhere('author', 'like', '%' . $keyword . '%')
            ->get();

        // Pass data to the view
        return view('welcome', compact('featuredBooks', 'latestReviews','bookslist'));
    }
}
