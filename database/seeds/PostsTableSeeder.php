<?php
use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class PostsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker) {
        $users = User::all();
        for ($i = 0; $i < 10; $i++) {
            $newPost = new Post;
            $newPost->title = $faker->sentence(3);
            $newPost->body = $faker->text(500);
            $newPost->slug = Str::slug($newPost->title);
            $newPost->user_id = $users->random()->id;
            $newPost->save();
        }
    }
}
