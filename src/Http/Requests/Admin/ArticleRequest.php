<?php

namespace Tomeet\Cms\Http\Requests\Admin;

use Illuminate\Support\Facades\Route;
use Tomeet\Cms\Http\Requests\Request;

class ArticleRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $routeName = Route::currentRouteName();

        // 保存文章
        if ($routeName == 'cms.article.store') {
            return [
                'title' => 'required'
            ];
        }
        // 更新文章
        if ($routeName == 'cms.article.update') {
            return [
                'title' => 'required'
            ];
        }

        return [];
    }


    public function messages()
    {
        return [
            'title.required' => '请填写文章标题'
        ];
    }
}
