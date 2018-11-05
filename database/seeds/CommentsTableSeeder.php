<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Comment::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 100; $i++) {
            Comment::create([
                'post_id' => random_int(1, 50),
                'user_id' => random_int(1, 14),
                'status' => random_int(0, 1),
                'content' => $faker->sentence,
            ]);
        }
    }
}
