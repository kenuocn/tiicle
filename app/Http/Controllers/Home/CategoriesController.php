<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use App\Models\Topic;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function show(Request $request,Category $category,Topic $topic, User $user)
    {
        // 读取分类 ID 关联的话题，并按每 20 条分页
        $topics = $topic->withOrder($request->order)->where('category_id', $category->id)->paginate(30);

        $active_users = $user->getActiveUsers();

        // 传参变量话题和分类到模板中
        return view('home.topics.index', compact('topics', 'category','active_users'));
    }
}
