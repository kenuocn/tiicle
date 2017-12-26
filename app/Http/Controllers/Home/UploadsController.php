<?php

namespace App\Http\Controllers\Home;

use Auth;
use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;

class UploadsController extends Controller
{
    /**
     * UploadsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * 话题图片资源上传
     * @param Request $request
     * @param ImageUploadHandler $uploader
     * @return array
     */
    public function topicsUploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];

        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->file('file'))
        {
            // 保存图片到本地
            $result = $uploader->save($request->file('file'), 'topics', Auth::id(), 880);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }

        return $data;
    }
}
