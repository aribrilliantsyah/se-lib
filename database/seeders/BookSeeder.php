<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
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
                'code' => 'BK-001',
                'book' => 'Eiti Shikkusu (86)',
                'author_id' => 1,
                'cover' => '',
                'summary' => 'Lorem Ipsum Dolor Sit Amet',
                'stock' => 5,
            ],
            [
                'id' => 2,
                'code' => 'BK-002',
                'book' => 'Bokutachi no Remake',
                'author_id' => 5,
                'cover' => '',
                'summary' => 'Lorem Ipsum Dolor Sit Amet',
                'stock' => 10,
            ],
            [
                'id' => 3,
                'code' => 'BK-003',
                'book' => 'Solo Leveling',
                'author_id' => 3,
                'cover' => '',
                'summary' => 'Lorem Ipsum Dolor Sit Amet',
                'stock' => 8,
            ],
            [
                'id' => 4,
                'code' => 'BK-004',
                'book' => 'Is It Wrong to Try to Pick Up Girls in a Dungeon?',
                'author_id' => 2,
                'cover' => '',
                'summary' => 'Lorem Ipsum Dolor Sit Amet',
                'stock' => 15,
            ],
            [
                'id' => 5,
                'code' => 'BK-005',
                'book' => 'FFF-Class Trashero',
                'author_id' => 4,
                'cover' => '',
                'summary' => 'Lorem Ipsum Dolor Sit Amet',
                'stock' => 15,
            ]
        ];

        foreach($books as $book){
            Book::create($book);
        }
    }
}
