<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\UserRequest;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {

        $user = User::with('topics')->find($id);

        return view('home.users.show',compact('user'));
    }


    public function profile()
    {
        $user = auth()->user();
        $this->authorize('update', $user);
        return view('home.users.profile',compact('user'));
    }

    /**
     * 修改用户资料
     * @param UserRequest $request
     * @param ImageUploadHandler $uploader
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UserRequest $request,ImageUploadHandler $uploader,User $user)
    {
        $this->authorize('update', $user);

        $user->fill($request->all());

        if ($request->avatar)
        {
            $result = $uploader->save($request->avatar, 'avatars', $user->id,362);
            if ($result) {
                $user->avatar = $result['path'];
            }
        }

        $user->save();

        flash('修改资料成功')->success()->important();

        return redirect()->route('users.profile');
    }


    public function replies(User $user)
    {
        return view('home.users.show',compact('user'));
    }
}
