@extends('layouts.app')

@section('title', 'Top Books')

@section('content')
    <h1>Top {{ $limit }} Books by Average Rating</h1>
    <div class="mb-3">
        <form action="{{ route('books.index') }}">
            <div class="mb-3">
                <label for="showData">Show</label>
                <select id="showData" class="form-select" name="limit">
                    @for ($i = 10; $i <= 100; $i += 10)
                        <option value="{{ $i }}" {{ $i == $limit ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-3">
                <label for="searchInput">Search</label>
                <input type="text" id="searchInput" class="form-control" placeholder="Search by Book or Author"
                    name="search" value="{{ $search }}">
            </div>

            <button id="submitBtn" class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Book</th>
                <th>Category</th>
                <th>Author</th>
                <th>Average Rating</th>
                <th>Voter</th>
            </tr>
        </thead>
        <tbody id="topBooksTableBody">
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->name }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ number_format($book->avgRating, 2) }}</td>
                    <td>{{ $book->voterCount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
