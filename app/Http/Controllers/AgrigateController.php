<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class AgrigateController
{
     public function store()
     {
        $res =  Comment::query()->where('commentable_id', 'b5ad8ce9-7494-403a-b6ac-1441a526de39')
             ->selectRaw('conut(*) as total_count')
             ->where('created_at', '>=', now()->subMonth()->startOfMonth())
             ->where('created_at', '<=', now()->subMonth()->endOfMonth())
             ->get();
        $res->dd();
     }
}
