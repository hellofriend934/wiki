<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Wink\WinkPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    public function index()
    {

        if (Cache::has('posts')){
            $posts = Cache::get('posts');

        }else
        {

        $posts = WinkPost::query()->select('slug','title','body','featured_image')->take(100)->get();
        $posts->map(function ($item){
            $matches = [];
           preg_match_all('/<img alt=".*"\s{0,}src=".*">/',$item->body,$matches);
           foreach ($matches as $match)
           {
               $item->body = Str::remove($match, $item->body);
           }
           $item->body = substr($item->body,0,250);
        });
            Cache::put('posts',$posts->toArray(),now()->addWeek());
        }


        $posts = Cache::get('posts');

        return view('home', compact('posts'));
    }

    public function clear_notification()
    {
        if (session()->has('reply_notification'))
        {
            session()->forget('reply_notification');
            return redirect()->back();
        }else{
            flash(1, 'у вас нет уведомлений');
            return redirect()->back();

        }
    }
}
