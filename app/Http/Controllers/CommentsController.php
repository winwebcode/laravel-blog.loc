<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /*public function show($post_id)
    {
        //$post_id = $request->get('post_id');
        $comments = Comment::all()->where('post_id', '=', $post_id);

        return view('pages.show', compact('comments'));
    }*/

    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
        ]);

        $comments = Comment::add($request->all());

        return redirect()->back()->with('status', 'Комментарий скоро будет опубликован');
    }
}
