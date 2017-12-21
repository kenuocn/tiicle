<?php

namespace App\Http\Controllers\Home;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserFollowersController extends Controller
{
    public function followed(User $user)
    {
        $followed = Auth::user()->toggleFollow($user);

        if(!empty($followed['attached']))
        {
//            $followed->increment('voted_count');

            return response()->json(['status'=>true, 'message'=>'成功', 'data'=> true]);
        }

//        $followed->decrement('voted_count');

        return response()->json(['status'=>true, 'message'=>'成功', 'data'=> false]);
    }

    /**
     * 判断是否关注了某个用户
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function isFollowing(User $user)
    {
        $isFollowing = Auth::user()->isFollowing($user->id);

        return response()->json([
            'status'=>true,
            'message'=>'成功',
            'data'=> $isFollowing,
        ]);
    }
}
