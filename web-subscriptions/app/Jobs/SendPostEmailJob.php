<?php

namespace App\Jobs;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostMail;


class SendPostEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected User $user;
    protected Post $post;
    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new PostMail($this->post));

        $this->post->users()->syncWithoutDetaching([$this->user->id]);
    }
}
