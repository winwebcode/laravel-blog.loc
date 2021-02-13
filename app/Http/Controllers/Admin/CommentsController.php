<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all();

        return view('admin.comments.index', compact('comments'));
    }

    public function toggle($id)
    {
        Comment::find($id)->toggleStatus($id);

        return redirect()->route('comment.show');
    }

    public function destroy($id)
    {
        Comment::find($id)->delete();

        return redirect()->route('comment.show');
    }

    public function edit($id)
    {
        $comment = Comment::find($id);

        return view('admin.comments.edit' , compact('comment'));
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'text' => 'required',
        ]);

        $comment = Comment::find($request->id);
        $comment->edit($request->all());

       return redirect()->route('comment.show');
    }
}
