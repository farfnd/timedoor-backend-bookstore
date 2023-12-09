<?php

namespace App\Services;

use App\Models\Author;
use App\Models\Rating;
use App\Repositories\BookRepository;

class RatingService
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function store($authorId, $bookId, $score)
    {
        $bookBelongsToAuthor = $this->validateBookBelongsToAuthor($authorId, $bookId);

        if (!$bookBelongsToAuthor) {
            throw new \InvalidArgumentException('The book does not belong to the author');
        }

        Rating::create([
            'book_id' => $bookId,
            'score' => $score,
        ]);
    }

    private function validateBookBelongsToAuthor($authorId, $bookId)
    {
        $book = $this->bookRepository->getBooksByAuthor($authorId)->where('id', $bookId)->first();

        return $book;
    }
}
