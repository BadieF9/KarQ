<?php

use App\Articles;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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
    return view('welcome');
});

Route::get('register',function (){
    return view('register');
});

Route::get('login',function (){
    return view('login');
});

Route::get('articles', 'ArticleController@index');

Route::post('register','RegisterAndLogin@register');
Route::post('login','RegisterAndLogin@login');
Route::get('home', 'HomeController@index')->name('home');

Route::prefix('articles')->middleware('auth')->group(function (){
    Route::get('/create','ArticleController@showCreate');
    Route::post('/create','ArticleController@storeArticle');
    Route::get('/{articles}/edit','ArticleController@viewEdit');
    Route::put('/{articles}/edit', 'ArticleController@update');
});

Route::prefix('admin')->namespace('Admin')->group(function (){
    Route::get('/articles', 'ArticleController@index');
    Route::delete('/articles/{articles}', 'ArticleController@delete');
    Route::put('/articles/{articles}', 'ArticleController@confirm');
});


Auth::routes();
