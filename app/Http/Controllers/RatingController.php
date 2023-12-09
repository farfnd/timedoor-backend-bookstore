<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingStoreRequest;
use App\Services\AuthorService;
use App\Services\RatingService;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    protected $authorService;
    protected $ratingService;

    public function __construct(
        AuthorService $authorService,
        RatingService $ratingService
    ) {
        $this->authorService = $authorService;
        $this->ratingService = $ratingService;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = $this->authorService->getAuthors();

        return view('input-rating', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RatingStoreRequest $request)
    {
        $validated = $request->validated();

        $authorId = $validated['author_id'];
        $bookId = $validated['book_id'];
        $score = $validated['score'];

        try {
            $this->ratingService->store($authorId, $bookId, $score);
        } catch (\Throwable $th) {
            return redirect()->route('books.index')->with('error', $th->getMessage());
        }

        return redirect()->route('books.index')->with('success', 'Rating created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
