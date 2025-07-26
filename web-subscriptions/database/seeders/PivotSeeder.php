<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Website;
use App\Models\Post;

class PivotSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $websites = Website::all();
        $posts = Post::all();

        foreach ($users as $user) {
            $randomWebsiteIds = $websites->random(rand(1, 3))->pluck('id')->toArray();
            $user->websites()->sync($randomWebsiteIds);
        }

        foreach ($posts as $post) {
            $randomUserIds = $users->random(rand(1, 2))->pluck('id')->toArray();
            $post->users()->sync($randomUserIds);
        }
    }
}
