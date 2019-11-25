<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home.index');
    // return view('welcome');
});

Route::get('/article/{id}', 'BlogController@showArticle')->name('article.show');
Route::get('/blog', 'BlogController@showBlog')->name('blog');
Route::get('/blog/filtered/{category}', 'BlogController@filteredShowBlog')->name('blog.filtered');

Route::get('/home', 'HomeController@index')->name('home.index');

Route::get('/admin/add', 'AdminController@showAddArticle')->name('admin.showAddArticle');
Route::post('/admin/add', 'AdminController@addArticle')->name('admin.addArticle');