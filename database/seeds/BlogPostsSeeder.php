<?php

use App\Post;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BlogPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        // $faker->addProvider(new \Faker\Provider\Book($faker));

        for ($i=0; $i < 5; $i++) { 
            \App\Post::create([
                'title' => $faker->country,
                'author' => $faker->name,
                'content' => $faker->text
            ]);
        }
    }
}
