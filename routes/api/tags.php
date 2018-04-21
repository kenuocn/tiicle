<?php

$api->version('v1', [
    'namespace'  => 'App\Http\Controllers\Api',
    'middleware' => [
        'serializer:array', 'bindings',
    ]
], function ($api) {

    //全部标签列表
    $api->get('tags', 'TagsController@index')
        ->name('tags.index');

    //获取某个标签信息
    $api->get('tags/{tag}', 'TagsController@show')
        ->name('tags.show');

    //新建标签
    $api->post('tags', 'TagsController@store')
        ->name('tags.store');
});