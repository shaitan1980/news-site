<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use Validator;
use Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'asc')->get();

        return view('admin.tag.index', [
            'tags' => $tags,
            'page_title' => 'Список тегов'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create', [
            'page_title' => 'Создать новый тег',
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:150',
            'slug' => 'required|max:150|unique:tags',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $tag = new Tag;

        $tag->title = $request->title;
        $tag->slug = $request->slug;

        $tag->save();

        Session::flash('flash_message', 'Тег ' . $tag->title . ' успешно добавлен!');
        return redirect()->route('admin.tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);

        return view('admin.tag.show', [
            'tag' => $tag,
            'page_title' => 'Просмотр тега ' . $tag->title,
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
        $tag = Tag::findOrFail($id);

        return view('admin.tag.edit', [
            'tag' => $tag,
            'page_title' => 'Редактирование тега ' . $tag->title,
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
            'title' => 'required|max:150',
            'slug' => 'required|max:150|unique:tags,slug,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $tag = Tag::findOrFail($id);

        $tag->title = $request->title;
        $tag->slug = $request->slug;

        $tag->save();

        Session::flash('flash_message', 'Тег ' . $tag->title . ' успешно обновлен!');
        return redirect()->route('admin.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        Session::flash('flash_message', 'Тэг: ' . $tag->title . ' удален!');
        return redirect()->route('admin.tag.index');
    }
}
