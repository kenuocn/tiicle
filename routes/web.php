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

    Route::get('/', 'TopicsController@index')->name('root');

    Route::get('users/profile', 'UsersController@profile')->name('users.profile'); //修改资料

    Route::get('users/{user}/replies','UsersController@replies')->name('users.replies'); //修改资料);

    Route::get('users/{user}/is-following','UserFollowersController@isFollowing'); //判断是否关注了某个用户

    Route::post('users/{user}/followed','UserFollowersController@followed'); //关注用户

    Route::resource('users', 'UsersController', ['only' => ['index', 'create', 'show', 'store', 'update', 'edit', 'destroy']]); //个人中心

    Route::resource('notifications', 'NotificationsController', ['only' => ['index']]); //消息通知

    Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]); //话题

    Route::get('topics/{topic}/voted-topicd', 'VotedTopicsController@votedTopicd'); //判断用户是否投票了某个话题

    Route::post('topics/{topic}/voted', 'VotedTopicsController@voted');  //投票话题

    Route::get('topics/{topic}/voted-users', 'VotedTopicsController@votedUsers');  //获取某个话题所有投票用户

    Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');  //话题seo优化路由

    Route::resource('categories', 'CategoriesController', ['only' => ['show']]);  //话题分类

    Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]); //话题回复

    Route::get('tags/{tag}', 'TagsController@show')->name('tags.show'); //获取某个标签信息

    Route::post('uploads/topics_upload_image', 'UploadsController@topicsUploadImage')->name('uploads.topics_upload_image');  //话题图片上传

});
