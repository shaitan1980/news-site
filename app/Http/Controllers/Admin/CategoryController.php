<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'asc')->get();

        return view('admin.category.index', [
            'categories' => $categories,
            'page_title' => 'Список категорий'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create', [
            'page_title' => 'Создать новую категорию',
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
            'slug' => 'required|max:150|unique:categories',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $category = new Category;

        $category->title = $request->title;
        $category->slug = $request->slug;

        $category->save();

        Session::flash('flash_message', 'Категория ' . $category->name . ' успешно добавлена!');
        return redirect()->route('admin.category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.show', [
            'category' => $category,
            'page_title' => 'Просмотр категории ' . $category->title,
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
        $category = Category::findOrFail($id);

        return view('admin.category.edit', [
            'category' => $category,
            'page_title' => 'Редактирование категории ' . $category->title,
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
            'slug' => 'required|max:150|unique:categories,slug,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $category = Category::find($id);

        $category->title = $request->title;
        $category->slug = $request->slug;

        $category->save();

        Session::flash('flash_message', 'Категория ' . $category->title . ' успешно обновлена!');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if($category->id == 5) {
            return redirect()->back()->with('flash_error', 'Нельзя удалять эту категорию!'); //нельзя удалять категорию политика
        }

        $category->delete();

        Session::flash('flash_message', 'Категория: ' . $category->title . ' удалена!');
        return redirect()->route('admin.category.index');
    }
}
