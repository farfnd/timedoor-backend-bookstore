@extends('layouts.app')

@section('title', 'Top 10 Authors')

@section('content')
    <h1>Top 10 Most Famous Authors</h1>
    <div class="mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Author</th>
                    <th>Voters</th>
                </tr>
            </thead>
            <tbody id="topAuthorsTableBody">
                @foreach ($topAuthors as $author)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->ratings_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
