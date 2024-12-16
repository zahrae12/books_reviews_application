<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Book extends Model
{
    protected $fillable = ['title', 'author', 'description', 'genre', 'pages', 'author_bio'];

    
    // Define the relationship to the User model
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function favorites()
{
    return $this->hasMany(favorites::class,'book_id');
}
  

}
