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

Route::get('login/github', 'Auth\AuthController@redirectToProvider')->name('login.github');
Route::get('login/github/callback', 'Auth\AuthController@handleProviderCallback')->name('login.github.callback');
Auth::routes();

# ------------------ Authentication ------------------------

Route::get('/signup', 'Auth\AuthController@create')->name('signup');
Route::post('/signup', 'Auth\AuthController@createNewUser')->name('signup');


/**前台*/
Route::namespace('Home')->group(function () {
    Route::get('/', 'PagesController@root')->name('root');

    Route::get('users/profile','UsersController@profile')->name('users.profile'); //修改资料
    Route::resource('users','UsersController',['only'=> ['index','create','show','store','update','edit','destroy'] ]); //个人中心
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
