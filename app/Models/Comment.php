<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user($id)
    {
        return User::query()->where('id',$id)->select('name','email','id')->first();
    }

    public function replies()
    {
        return $this->hasMany(Comment::class,'comment_reply_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class,'comment_reply_id','id')->select('text');
    }
}
