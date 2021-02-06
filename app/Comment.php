<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $fillable = ['text', 'post_id'];

    public function post()
    {
        //Коммент. принадлежит 1 посту. , но 1 пост может иметь множество коммент.
         return $this->belongsTo(Post::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function allow()
    {
        $this->status = 1;
        $this->save();
    }

    public function disAllow()
    {
        $this->status = 0;
        $this->save();
    }

    public function toggleStatus()
    {
        if($this->status == 0) {
            return $this->allow();
        } else {
            return $this->disAllow();
        }
    }

    public function remove()
    {
        //code
        $this->delete();
    }

    public static function add($fields)
    {
        $comment = new static;
        $comment->fill($fields);
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return $comment;

    }

    public static function howNewComments()
    {
        return Comment::all()->where('status', 0)->count();
    }

    public function getUserName()
    {
        if($this->author->name != null) {
            return $this->author->name;
        } else {
            return null;
        }
    }

}
