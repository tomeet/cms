<?php

namespace Tomeet\Cms\Http\Controllers\Admin;

use Tomeet\Cms\Http\Controllers\Controller;
use Tomeet\Cms\Http\Requests\Admin\ArticleRequest;
use Tomeet\Cms\Http\Resources\Admin\ArticleResource;
use Tomeet\Cms\Models\Article;
use Illuminate\Http\Request;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Exception;

class ArticleController extends Controller
{
    //
    public function index(Request $request)
    {
        $articles = Article::filter($request->all())->paginate();

        return Response::success(ArticleResource::collection($articles));
    }


    public function show($id)
    {
        $article = Article::findOrFail($id);
        $article->load('annexes', 'atlases', 'data', 'video');

        return Response::success(new ArticleResource($article));
    }


    public function store(ArticleRequest $request)
    {
        try {
            Article::handleCreate($request);
            return Response::created();
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
        }
    }


    public function update(ArticleRequest $request, $id)
    {
        try {
            Article::handleUpdate($request, $id);
            return Response::noContent();
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
        }
    }


    public function picture($article_id, $picture_id)
    {
        try {
            $article = Article::findOrFail($article_id);
            $picture = $article->pictures()->find($picture_id);
            $picture->delete();
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            Article::handleDelete($id);
            return Response::noContent();
        } catch (Exception $exception) {
            Response::fail('删除失败！');
        }
    }


    public function massDestroy(Request $request)
    {
        try {
            Article::handleDelete($request->id);
            return Response::noContent();
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
            Response::fail('删除失败！');
        }
    }


}
