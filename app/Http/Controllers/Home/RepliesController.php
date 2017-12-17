<?php

namespace App\Http\Controllers\Home;

use App\Models\Reply;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\ReplyRequest;
use Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ReplyRequest $request, Reply $reply)
    {
        $reply->content = $request->get('content');
        $reply->user_id = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->save();

        flash('回复成功')->success()->important();
        return redirect()->to($reply->topic->link());
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('destroy', $reply);
        $reply->delete();

        flash('删除成功')->success()->important();
        return redirect()->to($reply->topic->link());
    }
}
