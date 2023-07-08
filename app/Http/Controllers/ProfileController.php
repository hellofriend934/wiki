<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Wink\WinkAuthor;

class ProfileController extends Controller
{
    public function __invoke(string $id)
    {
      $author = WinkAuthor::query()->where('id',$id)->select('slug','name','email','id')->first();
      if ($author == null)
      {
         $author =  User::query()->where('id',$id)->select('name','email','id','block')->first();
         $author->block == null ? $action = 'заблокировать' : $action = 'разблокировать';
      }
        return view('profile', compact('author','action'));
    }
}
