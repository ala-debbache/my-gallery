<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();
Route::get('/', 'FrontController@index')->name('welcome');
Route::get('/post/{post}', 'FrontController@show')->name('single-post');
Route::get('/category/{category}', 'FrontController@category')->name('category');
Route::get('/tag/{tag}', 'FrontController@tag')->name('tag');
Route::get('/result','FrontController@search')->name('search');
Route::get('/adminpanel','FrontController@dash')->name('dashboard');

Route::get('/profile/{user}', 'FrontController@profile')->name('profile');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit/{user}', 'FrontController@editProfile')->name('edit-profile');
    Route::put('/profile/update/{user}', 'FrontController@updateProfile')->name('update-profile');
    Route::get('/create', 'FrontController@createPost')->name('create-post');
    Route::get('/edit/{post}', 'FrontController@editPost')->name('edit-post');
    Route::post('/create', 'FrontController@store_post')->name('store-post');
    Route::put('/edit/{post}', 'FrontController@update_post')->name('update-post');
    Route::delete('/delete/{post}', 'FrontController@delete')->name('delete-post');
});

Route::middleware(['VerifyIsAdmin'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('posts','PostsController');
    Route::resource('categories','CategoriesController');
    Route::resource('tags','TagsController');
    Route::get('trashed-posts','PostsController@trashed')->name('trashed.index');
    Route::get('confirmed-posts','PostsController@confirmed')->name('confirmed.index');
    Route::put('restore-posts/{post}','PostsController@restore')->name('trashed.restore');
    Route::put('confirmed-posts/{post}','PostsController@confirm')->name('confirmed.confirm');
    Route::get('users','UsersController@index')->name('users.index');
    Route::put('users/{user}','UsersController@makeAdmin')->name('make-admin');
    Route::put('users-unmake/{user}','UsersController@unmakeAdmin')->name('unmake-admin');
    Route::get('user/edit','UsersController@edit')->name('user.edit');
    Route::put('user/edit','UsersController@update')->name('user.update');
    Route::delete('user/delete/{user}','UsersController@delete')->name('user.delete');
});
