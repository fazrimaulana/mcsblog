<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Modules\Posts\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {

        	$post = new Post;

        	$post->author = 1;
        	$post->title = $faker->sentence(5);
        	$post->slug = $faker->numerify($faker->sentence(5)."###");
        	$post->content = $faker->paragraphs(50, true);
        	$post->published_at = $faker->dateTimeBetween('-5 month', '+3 days');
        	$post->type = "post";
        	$post->status = "published";
        	$post->visible = "public";
        	$post->status_comment = "open";
        	$post->image = $faker->imageUrl(750, 346);
        	$post->view_count = 0;

        	$post->save();

        	$post->categories()->attach(["1"]);

        	$post->tags()->attach(["1"]);

        }
    }
}
