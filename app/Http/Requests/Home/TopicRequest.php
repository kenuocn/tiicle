<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'       => 'required|min:2',
            'body'        => 'required|min:3',
            'category_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'title.required'       => '标题不能为空',
            'title.min'            => '标题必须至少两个字符',
            'category_id.required' => '分类不能为空',
            'body.required'        => '话题内容不能为空',
            'body.min'             => '话题内容必须至少三个字符',
        ];
    }
}
