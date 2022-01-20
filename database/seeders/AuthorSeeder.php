<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $authors = [
            [
                'id' => 1,
                'author' => 'Asato Asato'      
            ],
            [
                'id' => 2,
                'author' => 'Fujino Ōmori'      
            ],
            [
                'id' => 3,
                'author' => 'Chu - Gong'
            ],
            [
                'id' => 4,
                'author' => 'Farnar'
            ],
            [
                'id' => 5,
                'author' => 'Kionachi'
            ]
        ];

        foreach($authors as $author){
            Author::create($author);
        }
    }
}
