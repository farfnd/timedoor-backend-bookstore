<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['score', 'book_id'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function author()
    {
        return $this->hasOneThrough(Author::class, Book::class, 'id', 'id', 'book_id', 'author_id');
    }
}
