<?php

namespace App\Observers;

use App\Models\Reply;

class ReplyObserver
{
    public function created(Reply $reply)
    {
        $reply->topic->increment('reply_count', 1);
    }

    public function deleted(Reply $reply)
    {
        $reply->topic->decrement('reply_count', 1);
    }

    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }
}