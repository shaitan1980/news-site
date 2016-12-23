<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::where('publish', 0)->get();

        return view('admin.comments.index', [
            'page_title' => 'Комментарии ожидающие одобрения',
            'comments' => $comments
        ]);
    }

    public function confirmComment($id)
    {
        $comment = Comment::find($id);

        $comment->publish = 1;

        $comment->save();

        return redirect()->back()->with('flash_message', 'Комментарий успешно одобрен!');
    }
}
