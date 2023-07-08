<?php

namespace App\Listeners;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Wink\WinkPost;

class CommentReplyListener
{
    /**
     * Create the event listener.
     */
    public mixed $text;
    public mixed $user_reply_id;
    public mixed $reply_on;
    public mixed $article_slug;
    public mixed $sender;
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->text = $event->text;
        $this->user_reply_id = $event->user_reply_id;
        $this->reply_on = $event->reply_on;
        $this->reply_on = Comment::query()->where('id',$event->reply_on)->value('text');
        $this->article_slug = WinkPost::query()->where('id',$event->article_id)->value('slug');
       $user_id = Comment::query()->where('commentable_id',$event->article_id)->value('user_id');
       $this->sender = User::query()->where('id', $user_id)->value('name');
        session()->push('reply_notification',['text'=>$this->text, 'user_id'=>$user_id,'sender'=>$this->sender, 'user_reply_id'=>$this->user_reply_id,'reply_on'=>$this->reply_on, 'article_slug'=>$this->article_slug]);
    }
}
