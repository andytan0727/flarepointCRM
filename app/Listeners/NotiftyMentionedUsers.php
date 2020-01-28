<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\NewComment;
use App\Notifications\YouWereMentionedNotification;

class NotiftyMentionedUsers
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param NewComment $event
     */
    public function handle(NewComment $event)
    {
        collect($event->comment->mentionedUsers())
        ->map(function ($name) {
            return User::whereName($name)->first();
        })
        ->filter()
        ->each(function ($user) use ($event) {
            $user->notify(new YouWereMentionedNotification($event->comment));
        });
    }
}
