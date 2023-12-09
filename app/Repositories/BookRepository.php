<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function searchBooks($search)
    {
        $query = Book::query()->with(['author', 'category', 'ratings']);

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhereHas('author', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        }

        return $query->get();
    }
}
