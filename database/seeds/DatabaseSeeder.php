<?php

use Illuminate\Database\Seeder;
use \App\User;
use \App\Articles;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,10)->create()->each(function ($user){
            $user->articles()->saveMany(factory(Articles::class,rand(1,6))->make());
        });



  /*     $this->call([
           UserTableSeeder::class,
           ArticlesTableSeeder::class
       ]);*/
    }
}
