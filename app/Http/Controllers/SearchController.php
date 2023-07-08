<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Wink\WinkPost;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Attributes\SearchUsingFullText;
class SearchController extends Controller
{

    public function __invoke(Request $request)
    {

    $posts = WinkPost::search($request->s)->get();
      return view('Articles.searchable_result', compact('posts'));
    }
}
