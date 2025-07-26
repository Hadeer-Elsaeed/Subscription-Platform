<?php
namespace App\Console\Commands;

use App\Jobs\SendPostEmailJob;
use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Illuminate\Console\Command;

class SendPostsEmails extends Command
{
    protected $signature = 'posts:send-emails';

    protected $description = 'Send new post emails to subscribers who have not received them yet';

    public function handle()
{
    Website::chunk(100, function($websites) {
        foreach ($websites as $website) {
            $this->info("Checking website: {$website->name}");

            $website->posts->each(function ($post) use ($website) {

                // Chunk subscribers who have NOT received this post yet
                $website->users()
                    ->whereDoesntHave('posts', fn($query) => $query->where('posts.id', $post->id))
                    ->chunk(50, function($subscribers) use ($post) {
                        foreach ($subscribers as $subscriber) {
                            SendPostEmailJob::dispatch($subscriber, $post);
                            $this->info("Queued email for user {$subscriber->email} for post {$post->title}");
                        }
                    });
            });
        }
    });

    $this->info('All new post emails have been queued.');
}

}
