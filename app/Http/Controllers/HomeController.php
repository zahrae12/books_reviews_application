<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Book; 
use App\Models\Review;// Make sure to import the Book model
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == '0') {
                // Fetch similar or popular books for a regular user
                $similarBooks = Book::where('status', 1)
                    ->take(8)
                    // ->where('user_id', '!=', Auth::id())
                    ->inRandomOrder()
                    ->get();

                    $randomReviews = Review::with('book', 'user') // Assuming a Review belongs to a Book and a User
                    ->inRandomOrder()
                    ->take(2)
                    ->get();

                return view('user.dashboard', compact('similarBooks','randomReviews'));
            } else {
                // Fetching statistics for admin
                $totalBooks = Book::count();
                $totalUsers = User::count();
                $totalReviews = Review::count();
                $publishedBooks = Book::where('status', 1)->count();
                $unpublishedBooks = Book::where('status', 0)->count();

                // Grouping books by gender
                $booksByGender = Book::select('gender', \DB::raw('count(*) as total'))
                    ->join('users', 'users.id', '=', 'books.user_id') // Assuming `user_id` in `books`
                    ->groupBy('users.gender')
                    ->get();

                // Grouping books by genre
                $booksByGenre = Book::select('genre', \DB::raw('count(*) as total'))
                    ->groupBy('genre')
                    ->get();

                // Split reviews based on rating ranges (low and high ratings)
                $reviews = DB::table('reviews')
                ->join('books', 'reviews.book_id', '=', 'books.id')  // Join with books table
                ->join('users', 'reviews.user_id', '=', 'users.id')  // Join with users table to get gender
                ->selectRaw('books.genre, users.gender, AVG(reviews.rating) as avg_rating')
                ->groupBy('books.genre', 'users.gender')
                ->get();
        
            // Prepare the data for the chart
            $chartData = [
                'labels' => [],       // Stores genre names
                'male' => [],         // Stores average ratings for males
                'female' => [],       // Stores average ratings for females
            ];
        
            // Populate the chart data arrays
            foreach ($reviews as $review) {
                if (!in_array($review->genre, $chartData['labels'])) {
                    $chartData['labels'][] = $review->genre;
                }
        
                // Store the average ratings for each gender
                if ($review->gender == 'male') {
                    $chartData['male'][] = $review->avg_rating;
                } elseif ($review->gender == 'female') {
                    $chartData['female'][] = $review->avg_rating;
                }
            }
            $ageCategories = User::selectRaw('
        CASE 
            WHEN age < 18 THEN "Minor"
            WHEN age BETWEEN 18 AND 40 THEN "Major"
            ELSE "Old "
        END as age_category, COUNT(*) as total')
        ->groupBy('age_category')
        ->get();
                // Pass stats and grouped data to the view
                return view('admin.home', compact(
                    'totalBooks',
                    'totalUsers',
                    'totalReviews',
                    'publishedBooks',
                    'unpublishedBooks',
                    'booksByGender',
                    'booksByGenre',
                    'ageCategories',
                    'chartData' // Add the rating statistics
                ));
            }
        } else {
            // Redirect if not authenticated
            return redirect()->back();
        }
    }

    
    
}
