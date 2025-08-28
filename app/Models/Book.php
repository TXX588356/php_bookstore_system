<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'desc', 'price', 'stock', 'publisher', 'page_count', 'cover_image'];
    use HasFactory;

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function cart() {
        return $this->hasMany(Cart::class);
    }

    // Boot method to handle cascading delete
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($book) {
            // Detach all categories related to this book
            $book->categories()->detach();

            // Delete all cart entries related to this book
            $book->cart()->delete();
        });
    }
}
