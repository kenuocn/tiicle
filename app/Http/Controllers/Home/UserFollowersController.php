<?php

namespace App\Http\Controllers\Home;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserFollowersController extends Controller
{


    /**
     * UserFollowersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function followed(User $user)
    {
        $followed = Auth::user()->toggleFollow($user);

        if(!empty($followed['attached']))
        {
            return response()->json(['status'=>true, 'message'=>'成功', 'data'=> true]);
        }

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
