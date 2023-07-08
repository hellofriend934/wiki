<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Comment;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Termwind\Components\Dd;
use Wink\WinkAuthor;
use Wink\WinkPost;

class AdminController extends Controller
{


    public function stat()
    {

        $posts_comments_and_views = WinkPost::query()->where('created_at', '>=', now()->startOfMonth())->where('created_at', '<=', now()->endOfMonth())
        ->has('comments')->has('author')->with('comments')->with('author')
           ->get();
        $posts_count_current_month= WinkPost::query()->where('created_at', '>=', now()->startOfMonth())->where('created_at', '<=', now()->endOfMonth())->count('*');


        $comments_stat_current_mont = 0;
        foreach ($posts_comments_and_views as $p_c_a_v)
        {
            $comments_stat_current_mont+=$p_c_a_v->comments->count();
        }

        $active_avtors_current_month = collect();
        foreach ($posts_comments_and_views as $post_comment_and_view)
        {
            $active_avtors_current_month->push($post_comment_and_view->author);

        }

        foreach ($active_avtors_current_month->duplicates()->keys() as $key)
        {
            $active_avtors_current_month->forget($key);

        }

       $active_avtors_current_month = $active_avtors_current_month->map(function ($item){
         $item->posts_in_this_month = $item->posts()->where('created_at', '>=', now()->startOfMonth())->where('created_at', '<=', now()->endOfMonth())->count('*');
         return $item;
        });

        return view('admin', compact('posts_count_current_month', 'comments_stat_current_mont', 'active_avtors_current_month'));
    }


    public function block_users(Request $request, $user_id)
    {
        if (auth()->user()->hasPermissionTo('block users')) {
            $blocked = User::query()->find($user_id);
             if ($blocked->hasAnyRole('super_user')){
                 flash(2, 'нельзя заблокировать супер пользователя');
                 return redirect()->back();
             }elseif ($blocked->hasAnyRole('admin','redactor') && !auth()->user()->hasRole('super_user'))
             {
                 flash(2, 'админов и редакторов может банить только супер пользователь');
                 return redirect()->back();

             }

            if ($blocked->block == null || $blocked->block == false && !$blocked->hasAnyRole('admin','super_user'))
            {
                $blocked->block = true;
                $blocked->save();

                try {
                    Block::query()->create(['user_id' => $blocked->id, 'expire' => $request->input('expire')]);
                    flash(1, 'пользователь заблокирован');
                    return redirect()->back();
                } catch (\Throwable $exception) {
                    flash(2, $exception->getMessage());
                    return redirect()->back();
                }
            }elseif ($blocked->block == true)
            {
                $blocked->block = false;
                $blocked->save();
                Block::query()->where('user_id', $user_id)->delete();
                flash(1, 'пользователь разблокирован');

                return redirect()->back();
            }




        }
    }

    public function delete_comments($c_id)
    {
       $c = Comment::query()->where('id',$c_id)->first();
       $c->delete();
        return redirect()->back();

    }
}
