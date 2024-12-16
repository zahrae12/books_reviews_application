<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\BooksManagementController;
use App\Http\Controllers\ReviewManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\RegisteredUserController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [WelcomeController::class, 'welcomeHome'])->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'redirect'])->name('dashboard');
  
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
   
Route::middleware(['auth', 'check-usertype'])->group(function () {
    Route::get('/user-management', [AdminController::class, 'createUser'])->name('user.create'); // Show the add user form
    Route::post('/user-management', [AdminController::class, 'storeUser'])->name('user.store'); // Handle form submission// Handle form submission
    Route::delete('/admin/user/{id}', [AdminController::class, 'deleteUser'])->name('user.delete');
    Route::patch('/admin/user/{id}/ban', [AdminController::class, 'banUser'])->name('user.ban');
    
});

Route::middleware(['check-admin'])->group(function () {
    Route::get('books', [BookController::class, 'showBooksList'])->name('books.showBooksList'); // Show the add user form
    Route::get('books/create', [BookController::class, 'createBooks'])->name('books.createBooks'); // Show the add user form
    Route::post('books', [BookController::class, 'storeBooks'])->name('books.storeBooks'); // Show the add user form
    Route::get('books/edit/{id}',[BookController::class,'editBooks'])->name('books.editBooks');
    Route::post('books/edit/{id}',[BookController::class,'updateBooks'])->name('books.updateBooks');
    Route::delete('books/{id}', [BookController::class, 'deleteBooks'])->name('books.deleteBooks');
    // web.php
    Route::get('/discover', [BookController::class, 'discover'])->name('books.discover');
    Route::get('/book/{id}', [BookController::class, 'details'])->name('books.details');

});

Route::middleware(['check-admin'])->group(function () {
    Route::get('/reviews/create/{book}', [ReviewController::class, 'createReview'])->name('reviews.createReview');
    Route::post('/reviews/{book}', [ReviewController::class, 'storeReview'])->name('reviews.storeReview');
    Route::get('/reviews', [ReviewController::class, 'showReviews'])->name('reviews.showReviews');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'editReview'])->name('reviews.editReview');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
   
});
Route::middleware(['check-admin'])->group(function () {
    Route::get('books/favorites', [FavoriteController::class, 'favoriteBooks'])->name('favorites.favoriteBooks');
    Route::post('favorites/add', [FavoriteController::class, 'addToFavorites'])->name('favorites.add');
    Route::post('/favorites/remove/{bookId}', [FavoriteController::class, 'removeFromFavorites'])->name('favorites.remove');

});
// fix this
Route::middleware(['auth', 'check-usertype'])->group(function () {
   
    Route::get('/books/createe', [BooksManagementController::class, 'createABook'])->name('admin.books-management');
    Route::post('/bookss', [BooksManagementController::class, 'storeABook'])->name('books.store');
    Route::get('/bookss/{id}/edit', [BooksManagementController::class, 'editABook'])->name('admin.edit');
    Route::put('bookss/{book}', [BooksManagementController::class, 'updateABook'])->name('admin.update');
    Route::delete('/bookss/{id}', [BooksManagementController::class, 'destroyABook'])->name('books.destroy');
});
//Reviews Management logic

Route::middleware(['auth', 'check-usertype'])->group(function () {
    Route::get('/Reviewss', [ReviewManagementController::class, 'index'])->name('admin.reviews-management'); // List reviews
    Route::get('/create', [ReviewManagementController::class, 'create'])->name('rev.create'); // Form to add review
    Route::post('store/{book}', [ReviewManagementController::class, 'store'])->name('rev.store');
    Route::get('/{id}/edit', [ReviewManagementController::class, 'edit'])->name('rev.editrev'); // Edit review
    Route::put('/{id}', [ReviewManagementController::class, 'update'])->name('rev.updaterev'); // Update review
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    // Delete review
});
Route::get('/error', function () {
    return view('errors.404'); // Your error view
})->name('error');
require __DIR__.'/auth.php';
