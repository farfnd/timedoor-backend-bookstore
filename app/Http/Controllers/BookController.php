<?php

namespace App\Http\Controllers;

use App\Http\Requests\BooksGetRequest;
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

        $limit = $validated['limit'] ?? 10;
        $search = $validated['search'] ?? '';

        $books = $this->bookService->getBooks($limit, $search);

        return view('books', compact('limit', 'search', 'books'));
    }
}
