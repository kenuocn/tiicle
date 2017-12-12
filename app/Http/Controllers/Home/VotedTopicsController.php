<?php

namespace App\Http\Controllers\Home;

use Auth;
use App\Models\Topic;
use App\Models\VotedTopic;
use App\Http\Controllers\Controller;

class VotedTopicsController extends Controller
{
    /**
     * VotedTopicsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['votedUsers']]);
    }

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
        if(!Auth::user()->votedTopicd($topic))
        {
            return response()->json([
                'status'=>true,
                'message'=>'成功',
                'data'=> false,
            ]);
        }

        return response()->json([
            'status'=>true,
            'message'=>'成功',
            'data'=> Auth::user()->votedTopicd($topic),
        ]);
    }

    /**
     * 获取某个话题所有投票用户
     * @param VotedTopic $votedTopic
     * @param $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function votedUsers(VotedTopic $votedTopic,$topic)
    {
        $votedTopics = $votedTopic->with('users')->where('topic_id',$topic)->get();

        return response()->json(['status'=>true, 'message'=>'成功', 'data'=> $votedTopics]);
    }
}
