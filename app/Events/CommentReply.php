<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use JetBrains\PhpStorm\NoReturn;

class CommentReply
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public mixed $text;
    public mixed $user_reply_id;
    public mixed $reply_on;
    public mixed $article_id;
    #[NoReturn] public function __construct($text, $user_reply_id, $reply_on, $article_id)
    {
        $this->text=$text;
        $this->article_id = $article_id;
        $this->user_reply_id=$user_reply_id;
        $this->reply_on = $reply_on;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
