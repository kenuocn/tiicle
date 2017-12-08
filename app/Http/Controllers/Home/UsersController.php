<?php

namespace App\Http\Controllers\Home;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Home\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);  //允许不用登录查看
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('home.users.show',compact('user'));
    }


    public function profile()
    {
        $user = auth()->user();
        return view('home.users.profile',compact('user'));
    }

    /**
     * @param StoreUserRequest $request
     * @param ImageUploadHandler $uploader
     * @param User $user
     */
    public function update(StoreUserRequest $request,ImageUploadHandler $uploader,User $user)
    {
        $user->fill($request->all());

        if ($request->avatar)
        {
            $result = $uploader->save($request->avatar, 'avatars', $user->id);
            if ($result) {
                $user->avatar = $result['path'];
            }
        }

        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
