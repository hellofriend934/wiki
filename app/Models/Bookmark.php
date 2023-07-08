<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wink\WinkPost;

class Bookmark extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function posts()
    {
        return $this->hasMany(WinkPost::class,'wink_post_id','id');
    }
}
