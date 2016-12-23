<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Commercial;
use Validator;
use Session;

class CommercialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commercials = Commercial::orderBy('created_at', 'asc')->get();

        return view('admin.commercial.index', [
            'commercials' => $commercials,
            'page_title' => 'Список рекламных объявлений'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.commercial.create', [
            'page_title' => 'Создать рекламное объявление',
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
            'good' => 'required|max:150',
            'seller' => 'required|max:150',
            'website' => 'required|max:150',
            'price' => 'required',
            'kupon' => 'required|max:150',
            'position' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $commercial = new Commercial;

        $commercial->good = $request->good;
        $commercial->seller = $request->seller;
        $commercial->website = $request->website;
        $commercial->price = $request->price;
        $commercial->kupon = $request->kupon;
        $commercial->position = $request->position;

        $commercial->save();

        Session::flash('flash_message', 'Объявление ' . $commercial->good . ' успешно создано!');
        return redirect()->route('admin.commercial.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commercial = Commercial::findOrFail($id);

        return view('admin.commercial.show', [
            'commercial' => $commercial,
            'page_title' => 'Просмотр объявления' . $commercial->title
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
        $commercial = Commercial::findOrFail($id);

        return view('admin.commercial.edit', [
            'page_title' => 'Редактирование объявления' . $commercial->good,
            'commercial' => $commercial,
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
            'good' => 'required|max:150',
            'seller' => 'required|max:150',
            'website' => 'required|max:150',
            'price' => 'required',
            'kupon' => 'required|max:150',
            'position' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $commercial = Commercial::find($id);

        $commercial->good = $request->good;
        $commercial->seller = $request->seller;
        $commercial->website = $request->website;
        $commercial->price = $request->price;
        $commercial->kupon = $request->kupon;
        $commercial->position = $request->position;

        $commercial->save();

        Session::flash('flash_message', 'Объявление ' . $commercial->good . ' успешно обновлено!');
        return redirect()->route('admin.commercial.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commercial = Commercial::findOrFail($id);
        $commercial->delete();

        Session::flash('flash_message', 'Объявление: ' . $commercial->good . ' удалено!');
        return redirect()->route('admin.commercial.index');
    }
}
