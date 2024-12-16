<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Review extends Model
{
    protected $fillable = ['review', 'rating', 'user_id', 'book_id'];


    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    // Define the relationship to the User model
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    



}
