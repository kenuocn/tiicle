<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller {

    /**
     * 返回标签
     * @param Request $request
     * @param Tag $tag
     * @return \Illuminate\Support\Collection
     */
    public function index(Request $request, Tag $tag)
    {
        return $tag::where('name', 'like', '%' . $request->get('q', null) . '%')->get();
    }

}