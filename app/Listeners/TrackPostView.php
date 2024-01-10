<?php

namespace App\Listeners;

use App\Events\PostViewed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TrackPostView
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PostViewed  $event
     * @return void
     */
    public function handle(PostViewed $event)
    {
        $postId = $event->postId;
        \App\Models\Post::where('id', $postId)->increment('view_count');
    }
}
