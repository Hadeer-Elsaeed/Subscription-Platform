<?php

namespace App\Providers;

use App\Events\PostPublished;
use App\Listeners\SendPostToSubscribers;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PostPublished::class => [
            SendPostToSubscribers::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
