<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;
use App\Category;
use App\Tag;
use Validator;
use Session;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'asc')->get();

        return view('admin.news.index', [
            'news' => $news,
            'page_title' => 'Список новостей'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.news.create', [
            'page_title' => 'Создать новость',
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->tag);
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:news',
            'body' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $tags = $request->tag;
        $newsCat = $request->category;

        $news = new News;
        $news->title = $request->title;
        $news->slug = $request->slug;
        $news->body = $request->body;
        $news->image = $request->image;
        $news->author_id = $request->user()->id;
        $news->read = 0;
        $news->is_analitics = $request->is_analitics;

        $news->save();

        $news->tags()->attach($tags);
        $news->categories()->attach($newsCat);

        Session::flash('flash_message', 'Новость ' . $news->title . ' успешно создана!');
        return redirect()->route('admin.news.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::findOrFail($id);

        return view('admin.news.show', [
            'news' => $news,
            'page_title' => 'Просмотр новости' . $news->title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);

        $categories = Category::all();
        $tags = Tag::all();

        $arr_tag = [];

        foreach($news->tags as $element) {
            $arr_tag[] =  $element->id;
        }

        return view('admin.news.edit', [
            'news' => $news,
            'page_title' => 'Редактирование новости' . $news->title,
            'categories' => $categories,
            'tags' => $tags,
            'arr_tag' => $arr_tag
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:news,slug,' . $id,
            'body' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }


        $news = News::find($id);
        $news->title = $request->title;
        $news->slug = $request->slug;
        $news->body = $request->body;
        $news->image = $request->image;
        $news->read = $news->read;
        $news->author_id = $request->author_id;
        $news->is_analitics = $request->is_analitics;

        $news->save();

        $the_tags = [];
        foreach($request->tag as $value) {
            $the_tags[] = $value;
        }

        News::find($id)->tags()->sync($the_tags);

        $the_categories = [];

        $the_categories[] = $request->category;

        News::find($id)->categories()->sync($the_categories);

        Session::flash('flash_message', 'Новость ' . $news->title . ' успешно обновлена!');
        return redirect()->route('admin.news.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        Session::flash('flash_message', 'Новость: ' . $news->title . ' удалена!');
        return redirect()->route('admin.news.index');
    }
}
