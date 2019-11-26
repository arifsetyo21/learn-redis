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

// Twitter feed like Route
Route::get('/{id}/userlist', 'UserController@showUserList')->where('id', '[0-9]+');
Route::get('/{id}/following', 'UserController@showFollowingList')->where('id', '[0-9]+');
Route::get('/{id}/follow/{userID}', 'UserController@followUser')->where('id', '[0-9]+');
Route::get('/{id}/unfollow/{userID}', 'UserController@unfollowUser')->where('id', '[0-9]+');

Route::get('/{id}/postUpdate', 'UserController@showAddUpdate')->where('id', '[0-9]+');
Route::post('/{id}/postUpdate', 'UserController@doAddUpdate')->where('id', '[0-9]+')->name('post.update');
Route::get('/{id}/feed', 'UserController@showFeed')->where('id', '[0-9]+')->name('feed');

// Article Route
Route::get('/article/{id}', 'BlogController@showArticle')->name('article.show');
Route::get('/blog', 'BlogController@showBlog')->name('blog');
Route::get('/blog/filtered/{category}', 'BlogController@filteredShowBlog')->name('blog.filtered');

Route::get('/home', 'HomeController@index')->name('home.index');

// Admin Route
Route::get('/admin/add', 'AdminController@showAddArticle')->name('admin.showAddArticle');
Route::post('/admin/add', 'AdminController@addArticle')->name('admin.addArticle');