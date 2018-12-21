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



Route::get('/about', 'PagesController@about');
Route::get('/contact','PagesController@contact');
Route::get('/blog','PagesController@blog');
Route::get('/', 'PagesController@blog');


Route::get('blog/{slug}','BlogController@getSingle')->where('slug','[\w\d\-\_]+')->name('blog.single');
Route::resource('posts',"PostController");
Route::resource('categories',"CategoryController",['except'=>['create','show'] ]);
Route::resource('tags',"TagController",['except'=>['create'] ]);

Auth::routes();




