<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Comment;
use Wink\WinkAuthor;
use Wink\WinkPost;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index($slug)
    {
//        dd(auth()->user()->getRoleNames());
        $post = WinkPost::query()->where('slug',$slug)->select('title','body','featured_image','id','author_id','slug')->first();
         //relation doesn't work so
        $author = WinkAuthor::query()->where('id',$post->author_id)->first();
        $comments = $post->comments;


        $post->visit()->hourlyInterval();

        return view('Articles.article', compact('post', 'author','comments'));
    }

    public function bookmarks(string $id)
    {
        if ($bookmark = Bookmark::query()->where('wink_post_id',$id)->first())
        {
            session()->flash('res', 'удаленно');
            $bookmark->delete();
            return redirect()->back();

        }else{
            Bookmark::query()->create(['user_id'=>auth()->id(), 'wink_post_id'=>$id]);
            session()->flash('res', 'добавлено');
            return redirect()->back();
        };

    }
}
