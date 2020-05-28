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
})->name('home');

Route::get('register',function (){
    return view('register');
});

Route::get('login',function (){
    return view('login');
});


//   the public routes that doesn't need any login or register
Route::get('articles', 'ArticleController@index');
Route::post('register','RegisterAndLogin@register');
Route::post('login','RegisterAndLogin@login');
Route::get('home', 'HomeController@index');


/*
 *   creating and editing article routes that checks if the user is logged in or not with the middleware('auth') method
 *   and all of them have the 'articles' prefix before of their route
 *   all of these routes are connected to the ArticleController controller and are using of that controller's methods
 */
Route::prefix('articles')->middleware('auth')->group(function (){
    Route::get('/create','ArticleController@showCreate');
    Route::post('/create','ArticleController@storeArticle');
    Route::get('/{articles}/edit','ArticleController@viewEdit');
    Route::put('/{articles}/edit', 'ArticleController@update');
});

/*
 *   creating and editing article routes that checks if the user is logged in or not with the middleware('auth') method
 *   that are defined in their controller and all of them have the 'admin' prefix before of their route
 *   all of these routes are connected to the ArticleController controller which is in the Controllers\Admin and they are using of that controller's methods
 */
Route::prefix('admin')->namespace('Admin')->group(function (){
    Route::get('/articles', 'ArticleController@index');
    Route::delete('/articles/{articles}', 'ArticleController@delete');
    Route::put('/articles/{articles}', 'ArticleController@confirm');
});


Auth::routes();
