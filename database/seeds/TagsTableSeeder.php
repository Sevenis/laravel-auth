<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Faker\Generator as Faker;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 8; $i++){
            $newTag = new Tag();
            $newTag->name = $faker->word;
            $newTag->save();
        }
    }
}
