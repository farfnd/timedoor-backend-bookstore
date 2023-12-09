<?php

namespace App\Services;

use App\Repositories\BookRepository;

class BookService
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getBooks($limit, $search)
    {
        $books = $this->bookRepository->searchBooks($search);

        return $this->calculateAverageRatingsAndSort($books, $limit);
    }

    public function getBooksByAuthor($id)
    {
        return $this->bookRepository->getBooksByAuthor($id);
    }

    private function calculateAverageRatingsAndSort($books, $limit)
    {
        $books->each(function ($book) {
            $avgRating = $book->ratings->avg('score');
            $voterCount = $book->ratings->count();

            $book->avgRating = $avgRating;
            $book->voterCount = $voterCount;
        });

        return $books->sortByDesc('avgRating')->take($limit);
    }
}
