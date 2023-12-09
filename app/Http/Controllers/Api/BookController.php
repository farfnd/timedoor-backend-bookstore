<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BooksGetRequest;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(BooksGetRequest $request)
    {
        $validated = $request->validated();

        $authorId = $validated['author_id'] ?? null;
        $books = $this->bookService->getBooksByAuthor($authorId);

        return response()->json($books);
    }
}
