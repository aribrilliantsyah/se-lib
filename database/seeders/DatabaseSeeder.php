<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        (new RoleSeeder())->run();
        (new UserSeeder())->run();
        (new AuthorSeeder())->run();
        (new CategorySeeder())->run();
        (new BookSeeder())->run();
        (new BookCategorySeeder())->run();
        (new MemberSeeder())->run();
    }
}
