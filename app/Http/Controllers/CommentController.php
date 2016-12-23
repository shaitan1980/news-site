<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Comment;
use Validator;
use Session;
use Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //Все операции с комментариями позволены только зарегистрированным пользователям
    }

    public function addComment(Request $request, $news)
    {

        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $newsPost = News::find($news);

        $comment = new Comment;

        $comment->body = $request->input('comment');
        $comment->author_id = $request->user()->id;
        $comment->news_id = $newsPost->id;

        if($newsPost->categories->contains('id', 5) === true) {
            $comment->publish = 0;
        }

        $comment->save();

        return redirect()->back()->with('flash_message', 'Комментарий успешно добавлен!');

    }

    public function addLike($id)
    {
        $comment = Comment::find($id);

        $comment->likes = $comment->likes + 1;

        $comment->save();

        return redirect()->back()->with('flash_message', 'Спасибо за оценку!');
    }

    public function addDislike($id)
    {
        $comment = Comment::find($id);

        $comment->likes = $comment->likes - 1;

        $comment->save();

        return redirect()->back()->with('flash_message', 'Спасибо за оценку!');
    }
}
