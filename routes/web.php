<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/category/{category}', "HomeController@getCategory")->name('getCategory');
Route::get('/news-post/{slug}', "HomeController@getNewsPost")->name('getNewsPost');
Route::get('/tag/{slug}', "HomeController@getTag")->name('getTag');
Route::get('/analitics', "HomeController@getAnalitics")->name('getAnalitics');

Route::post('comment/add/{news}', 'CommentController@addComment')->name('addComment');
Route::post('comment/like/{id}', 'CommentController@addLike')->name('addLike');
Route::post('comment/dislike/{id}', 'CommentController@addDislike')->name('addDislike');

Route::group(['prefix' => 'admin', 'roles'=>'Admin', 'middleware' => ['auth', 'roles']], function()
{
    Route::get('/', [
        'uses' => 'Admin\AdminController@index',
        'as' => 'adminIndex'
    ]);

    Route::resource('category', 'Admin\CategoryController',[
        'names' => [
            'create' => 'admin.category.create',
            'update' => 'admin.category.update',
            'edit' => 'admin.category.edit',
            'store' => 'admin.category.store',
            'show' => 'admin.category.show',
            'destroy' => 'admin.category.destroy',
            'index' => 'admin.category.index'
        ]
    ]);

    Route::resource('tag', 'Admin\TagController', [
        'names' => [
            'create' => 'admin.tag.create',
            'update' => 'admin.tag.update',
            'edit' => 'admin.tag.edit',
            'store' => 'admin.tag.store',
            'show' => 'admin.tag.show',
            'destroy' => 'admin.tag.destroy',
            'index' => 'admin.tag.index'
        ]
    ]);

    Route::resource('news', 'Admin\NewsController', [
        'names' => [
            'create' => 'admin.news.create',
            'update' => 'admin.news.update',
            'edit' => 'admin.news.edit',
            'store' => 'admin.news.store',
            'show' => 'admin.news.show',
            'destroy' => 'admin.news.destroy',
            'index' => 'admin.news.index'
        ]
    ]);

    Route::resource('commercial', 'Admin\CommercialController', [
        'names' => [
            'create' => 'admin.commercial.create',
            'update' => 'admin.commercial.update',
            'edit' => 'admin.commercial.edit',
            'store' => 'admin.commercial.store',
            'show' => 'admin.commercial.show',
            'destroy' => 'admin.commercial.destroy',
            'index' => 'admin.commercial.index'
        ]
    ]);

    Route::get('/comment', 'Admin\CommentController@index')->name('admin.comment.index');
    Route::post('/comment/confirm/{id}', 'Admin\CommentController@confirmComment')->name('admin.confirmComment');

});
