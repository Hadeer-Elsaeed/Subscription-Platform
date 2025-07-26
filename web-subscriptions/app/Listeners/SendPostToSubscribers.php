<?php

namespace App\Listeners;

use App\Events\PostPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\SendPostEmailJob;


class SendPostToSubscribers
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostPublished $event)
    {
        $post = $event->post;
        $subscribers = $post->website->users;
        
        foreach ($subscribers as $subscriber) {
            SendPostEmailJob::dispatch($subscriber, $post);
        }
    }
}
