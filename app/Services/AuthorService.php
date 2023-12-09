<?php

namespace App\Services;

use App\Models\Author;

class AuthorService
{
    public function getTopAuthors($limit = 10)
    {
        return Author::withCount(['ratings' => function ($query) {
            $query->where('score', '>', 5);
        }])
            ->orderByDesc('ratings_count')
            ->take($limit)
            ->get();
    }
}
