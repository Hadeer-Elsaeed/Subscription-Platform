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
        $websites = Website::with('users')->get();
        $counter =0;
        foreach ($websites as $website) {
            $this->info("Checking website: {$website->name}");

            $posts = $website->posts;

            foreach ($posts as $post) {
                $subscribersToSend = $website->users()->whereDoesntHave('posts', function($query) use ($post) {
                    $query->where('posts.id', $post->id);
                })->get();
                foreach ($subscribersToSend as $subscriber) {
                    SendPostEmailJob::dispatch($subscriber, $post);
                    $this->info("Queued email for user {$subscriber->email} for post {$post->title}");
                }
            }
        }

        $this->info('All new post emails have been queued.');
    }
}
