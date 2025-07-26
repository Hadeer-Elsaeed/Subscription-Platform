<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Website;

class WebsitesSeeder extends Seeder
{
    public function run()
    {
        $websites = [
            ['name' => 'Tech Blog', 'url' => 'https://techblog.com'],
            ['name' => 'Foodie Heaven', 'url' => 'https://foodieheaven.com'],
            ['name' => 'Travel Diaries', 'url' => 'https://traveldiaries.com'],
            ['name' => 'Gaming Zone', 'url' => 'https://gamingzone.com'],
            ['name' => 'Fitness Pro', 'url' => 'https://fitnesspro.com'],
        ];

        foreach ($websites as $website) {
            Website::create($website);
        }
    }
}
