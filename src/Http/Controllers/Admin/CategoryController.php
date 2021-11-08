<?php

namespace Tomeet\Cms\Http\Controllers\Admin;

use Tomeet\Cms\Http\Controllers\Controller;
use Tomeet\Cms\Http\Requests\Admin\ArticleCategoryRequest as CatRequest;
use Tomeet\Cms\Http\Resources\Admin\ArticleCategoryResource as CatResource;
use Tomeet\Cms\Models\ArticleCategory;
use Illuminate\Http\Request;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Exception;

class CategoryController extends Controller
{

    /**
     * 获取分类树列表
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $categories = ArticleCategory::filter($request->all())->get();
        $categories->load('children', 'articles');

        return Response::success(CatResource::collection($categories));
    }


    /**
     * 获取分类详情
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $category = ArticleCategory::findOrFail($id);
        $category->load('data');

        return Response::success(new CatResource($category));
    }


    /**
     * 保存分类
     *
     * @param CatRequest $request
     * @return mixed
     */
    public function store(CatRequest $request)
    {
        try {
            ArticleCategory::handleCreate($request);
            return Response::created();
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
        }
    }


    /**
     * 更新分类
     *
     * @param CatRequest $request
     * @param $id
     * @return mixed
     */
    public function update(CatRequest $request, $id)
    {
        try {
            ArticleCategory::handleUpdate($request, $id);
            return Response::noContent();
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
        }
    }


    /**
     * 删除分类
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            ArticleCategory::handleDelete($id);
            return Response::noContent();
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
        }
    }


    /**
     * 验证字段是否存在
     *
     * @param Request $request
     * @return mixed
     */
    public function exists(Request $request)
    {
        $query = ArticleCategory::query();
        $title = $request->title ?? '';
        $alias = $request->alias ?? '';
        $ignore = $request->ignore ?? 0;

        if ($title) {
            $query->where('title', $title);
        }
        if ($alias) {
            $query->where('alias', $alias);
        }
        if ($ignore) {
            $query->where('id', '!=', $ignore);
        }

        if ($query->count()) {
            Response::fail('已存在');
        }

        return Response::noContent();
    }


    /**
     * 排序（上移下移）
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function setSort(Request $request, $id)
    {
        try {
            ArticleCategory::handleMoveud($request, $id);
            return Response::noContent();
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
        }
    }


    public function getData(Request $request, $id)
    {
        $article = ArticleCategory::with('data')->findOrFail($id);
        return Response::success([
            'content' => $article->data->content
        ]);
    }


    public function setData(Request $request, $id)
    {
        try {
            ArticleCategory::handleContent($request, $id);
            return Response::noContent();
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
        }
    }
}
