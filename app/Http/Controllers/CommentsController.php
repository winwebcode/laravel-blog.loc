<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
        ]);

        $comments = Comment::add($request->all());

        return redirect()->back()->with('status', 'Комментарий скоро будет опубликован');
    }
}
