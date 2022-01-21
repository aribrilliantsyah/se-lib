<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $books = [
            [
                'id' => 1,
                'book' => 'Eiti Shikkusu (86)',
                'categories' => [3,1,2,6,7]
            ],
            [
                'id' => 2,
                'book' => 'Bokutachi no Remake',
                'categories' => [1,4,5]
            ],
            [
                'id' => 3,
                'book' => 'Solo Leveling',
                'categories' => [1,2,5,6]
            ],
            [
                'id' => 4,
                'book' => 'Is It Wrong to Try to Pick Up Girls in a Dungeon?',
                'categories' => [1,2,5,6]
            ],
            [
                'id' => 5,
                'book' => 'FFF-Class Trashero',
                'categories' => [1,2,5,6]
            ]
        ];

        foreach($books as $book){
            Book::find($book['id'])->categories()->attach($book['categories']);
        }
    }
}
