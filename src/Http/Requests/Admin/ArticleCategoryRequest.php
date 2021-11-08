<?php

namespace Tomeet\Cms\Http\Requests\Admin;


use Illuminate\Support\Facades\Route;
use Tomeet\Cms\Http\Requests\Request;

class ArticleCategoryRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $routeName = Route::currentRouteName();

        if ($routeName == 'cms.categories.store') {
            return [
                'title' => 'required|unique:article_categories',
                'alias' => 'required|unique:article_categories',
                'type' => 'required'
            ];
        }

        if ($routeName == 'cms.categories.update') {
            $id = $this->route('category');
            return [
                'title' => 'required|unique:article_categories,title,' . $id,
                'alias' => 'required|unique:article_categories,alias,' . $id,
                'type' => 'required'
            ];
        }

        return [
            //
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '请填写分类名称',
            'title.unique' => '分类名称已存在',
            'alias.required' => '请填写分类别名',
            'alias.unique' => '分类别名已存在',
            'type.required' => '请选择分类类型',
        ];
    }
}
