<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Faker\Factory as Faker;

class PostsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $userIds = User::pluck('id')->all();
        $websiteIds = Website::pluck('id')->all();

        for ($i = 0; $i < 10; $i++) {
            Post::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'user_id' => $faker->randomElement($userIds),
                'website_id' => $faker->randomElement($websiteIds),
            ]);
        }
    }
}
