<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected Model $author;

    protected Model $category;

    protected Model $book;

    protected function setUp(): void
    {
        parent::setUp();

        Author::factory(9)->create();
        $this->author = Author::factory()->create([
            'name' => 'F. Scott Fitzgerald',
        ]);

        $this->category = Category::factory()->create([
            'name' => 'Novel',
        ]);

        $this->book = Book::factory()->create([
            'name' => 'The Great Gatsby',
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        Rating::factory(3)->create([
            'book_id' => $this->book->id,
            'score' => 8,
        ]);
    }

    public function test_index_books()
    {
        $requestData = [
            'limit' => 10,
            'search' => $this->book->name,
        ];

        $response = $this->get(route('books.index', $requestData));

        $response->assertStatus(200)
            ->assertViewIs('books')
            ->assertViewHasAll(['limit', 'search', 'books'])
            ->assertSeeText($this->book->name)
            ->assertSeeText($this->author->name)
            ->assertSeeText($this->category->name)
            ->assertSeeText('3')
            ->assertSeeText('8.00');
    }

    public function test_index_authors()
    {
        $response = $this->get(route('authors.index'));

        $response->assertStatus(200)
            ->assertViewIs('top-authors')
            ->assertViewHas('topAuthors')
            ->assertSeeText($this->author->name)
            ->assertSeeText('3');
    }

    public function test_create_rating()
    {
        $postData = [
            'book_id' => $this->book->id,
            'score' => 10,
        ];

        $response = $this->post(route('ratings.store'), [
            'author_id' => $this->author->id,
            ...$postData
        ]);

        $response->assertStatus(302)
            ->assertRedirect(route('books.index'))
            ->assertSessionHas('success', 'Rating created successfully');

        $this->assertDatabaseHas('ratings', $postData);

        $getData = [
            'limit' => 10,
            'search' => $this->book->name,
        ];

        $response = $this->get(route('books.index', $getData));

        $response->assertStatus(200)
            ->assertViewIs('books')
            ->assertViewHasAll(['limit', 'search', 'books'])
            ->assertSeeText($this->book->name)
            ->assertSeeText($this->author->name)
            ->assertSeeText($this->category->name)
            ->assertSeeText('4')
            ->assertSeeText('8.50');
    }

    public function test_get_books_by_author()
    {
        $response = $this->get(route('api.books.index') . '?author_id=' . $this->author->id);

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'name' => $this->book->name,
                'author_id' => $this->author->id,
                'category_id' => $this->category->id,
            ]);
    }
}
