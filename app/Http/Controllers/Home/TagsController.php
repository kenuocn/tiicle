<?php

namespace App\Http\Controllers\Home;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller {

    public function show(Request $request,Tag $tag,User $user)
    {
        $topics = $tag->topics()->paginate(30);

        $active_users = $user->getActiveUsers();

        // 传参变量话题和分类到模板中
        return view('home.topics.index', compact('topics', 'category','active_users'));
    }

}