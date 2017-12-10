<?php

namespace App\Http\Controllers\Home;

use Auth;
use App\Models\Topic;
use App\Http\Controllers\Controller;

class VotedTopicsController extends Controller
{
    /**
     * 投票话题
     * @param Topic $topic
     * @return mixed
     */
    public function voted(Topic $topic)
    {
        $user = Auth::user();

        $voted = $user->VotedTopicThis($topic);

        if(!empty($voted['attached']))
        {
            $topic->increment('voted_count');

            return response()->json(['status'=>true, 'message'=>'成功', 'data'=> true]);
        }

        $topic->decrement('voted_count');

        return response()->json(['status'=>true, 'message'=>'成功', 'data'=> false]);
    }

    /**
     * 判断用户是否投票了某个话题
     * @param  $topic
     * @return mixed
     */
    public function votedTopicd($topic)
    {
        return response()->json([
            'status'=>true,
            'message'=>'成功',
            'data'=> Auth::user()->votedTopicd($topic),
        ]);
    }
}
