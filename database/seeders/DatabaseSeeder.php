<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Book; // Import model Book
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder untuk User 
        User::factory()->create([
            'name' => 'Norman Thoir',
            'email' => 'norman@gmail.com',
        ]);

        // Seeder untuk Book
        // $books = [
        //     [
        //         'title' => 'To Kill a Mockingbird',
        //         'author' => 'Harper Lee',
        //         'isbn' => '9780061120084',
        //         'year' => 1960,
        //     ],
        //     [
        //         'title' => '1984',
        //         'author' => 'George Orwell',
        //         'isbn' => '9780451524935',
        //         'year' => 1949,
        //     ],
        //     [
        //         'title' => 'The Great Gatsby',
        //         'author' => 'F. Scott Fitzgerald',
        //         'isbn' => '9780743273565',
        //         'year' => 1925,
        //     ],
        //     [
        //         'title' => 'The Catcher in the Rye',
        //         'author' => 'J.D. Salinger',
        //         'isbn' => '9780316769488',
        //         'year' => 1951,
        //     ],
        //     [
        //         'title' => 'Pride and Prejudice',
        //         'author' => 'Jane Austen',
        //         'isbn' => '9780141040349',
        //         'year' => 1813,
        //     ],
        // ];

        // foreach ($books as $book) {
        //     Book::create($book);
        // }
    }
}
