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
        $comment = Comment::find($id);
        $comment->toggleStatus($id);

        return redirect()->route('comment.show');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->remove($id);
        return redirect()->route('comment.show');
    }
}
