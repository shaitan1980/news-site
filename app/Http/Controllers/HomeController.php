<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Commercial;
use App\Tag;
use App\News;
use App\User;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with(['newsCat' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get(); //Жадная загрузка, для экономии запросов


        //$categories = Category::all();
        $commercial = Commercial::all();

        $authors = User::all();

        foreach($authors as $author) {
            $counter = $author->comments->count();
            $countComments[$author->name] = $counter;
        }

        arsort($countComments);

        $news = News::orderBy('created_at', 'desc')->take(4)->get();

        return view('frontend.home', [
            'title' => 'Главная страница',
            'categories' => $categories,
            'commercial' => $commercial,
            'news' => $news,
            'countComments' => $countComments,
        ]);
    }

    public function getCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();

        return view('frontend.category', [
            'title' => 'Категория ' . $category->title,
            'category' => $category
        ]);
    }

    public function getNewsPost($slug)
    {
        $newsPost = News::where('slug', $slug)->first();

        if($newsPost->is_analitics === 1 && Auth::user() === null) {
            return response("Доступ запрещен, зарегистрируйтесь!", 403);
        }

        return view('frontend.newspost', [
            'title' => 'Новость ' . $newsPost->title,
            'newsPost' => $newsPost
        ]);
    }

    public function getTag($slug)
    {
        $tag = Tag::where('slug', $slug)->first();

        return view('frontend.tag', [
            'title' => 'Тег ' . $tag->title,
            'tag' => $tag
        ]);

    }

    public function getAnalitics()
    {
        $analitics = News::where('is_analitics', 1)->get();

        return view('frontend.analitics', [
            'page_title' => 'Все аналитические новости',
            'analitics' => $analitics
        ]);
    }
}
