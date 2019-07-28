<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(Product::class, 50)->create();
        factory(Category::class, 50)->create();
        factory(User::class, 50)->create();
    }
}
