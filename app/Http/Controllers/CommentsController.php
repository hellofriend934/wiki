<?php

namespace App\Http\Controllers;

use App\Events\CommentReply;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id, $type, $reply_id = null, $reply_user_id = null)
    {

        Comment::query()->create(['text'=>$request->input('comment'), 'commentable_id'=>$id,'commentable_type'=>$type, 'user_id'=>auth()->id(),'user_reply_id'=>$reply_user_id, 'comment_reply_id'=>$reply_id]);
        if ($reply_id!= null && $reply_user_id != null)
        {
            CommentReply::dispatch($request->input('comment'),$reply_user_id, $reply_id, $id);
        }
        return redirect()->back();
    }
}
