@extends('layouts.app')

@section('title', 'Input Rating')

@section('content')
    <h1>Rate Books</h1>
    <div class="mb-3">
        <form action="{{ route('ratings.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="authors">Authors</label>
                <select id="authors" class="form-select" name="author_id" required>
                    <option label="Select an author" selected hidden default></option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="book">Book:</label>
                <select name="book_id" id="books" class="form-select" required>
                    <option label="Select an author first" selected hidden></option>
                </select>
            </div>

            <div class="mb-3">
                <label for="score">Rating:</label>
                <select name="score" id="score" class="form-select" required>
                    <option label="Select a rating" selected hidden></option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <button id="submitBtn" class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        const authorSelect = document.getElementById('authors');
        const bookSelect = document.getElementById('books');

        authorSelect.addEventListener('change', function() {
            let authorId = this.value;
            let booksUrl = `{{ route('api.books.index') }}`;

            fetch(`${booksUrl}?author_id=${authorId}`)
                .then(response => response.json())
                .then(data => {
                    bookSelect.innerHTML = '<option label="Select a book" selected hidden></option>';
                    data.forEach(book => {
                        let option = document.createElement('option');
                        option.value = book.id;
                        option.text = book.name;
                        bookSelect.appendChild(option);
                    });
                });
        });
    </script>
@endsection
