<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            [
                'id' => 1,
                'category' => 'Romance'
            ],
            [
                'id' => 2,
                'category' => 'Action'
            ],
            [
                'id' => 3,
                'category' => 'War',
            ],
            [
                'id' => 4,
                'category' => 'Slice Of Life'
            ],
            [
                'id' => 5,
                'category' => 'Comedy'
            ],
            [
                'id' => 6,
                'category' => 'Fantasy'
            ],
            [
                'id' => 7,
                'category' => 'Sci-Fi',
            ]
        ];

        foreach($categories as $category){
            Category::create($category);
        }
    }
}
