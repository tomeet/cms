<?php


namespace Tomeet\Cms\Models\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Tomeet\Cms\Models\ArticleCategory;

trait ArticleCategoryTrait
{
    public static function bootArticleCategoryTrait()
    {
        static::created(function ($model) {
            $count = ArticleCategory::where('parent_id', $model->parent_id)->count();
            $model->sort = $count++;
            $model->save();
        });
    }

    public static function handleCreate(Request $request)
    {
        $category = new ArticleCategory();
        $category->fill($request->all());
        $category->save();
    }


    public static function handleUpdate(Request $request, $id)
    {
        $category = ArticleCategory::findOrFail($id);
        $category->fill($request->all());
        $category->save();
    }


    public static function handleDelete($id)
    {
        $category = ArticleCategory::findOrFail($id);
        $category->delete();
    }


    public static function handleMoveud(Request $request, $id)
    {
        $category = ArticleCategory::findOrFail($id);
        $parent_id = $category->parent_id;
        $sort = $category->sort;
        if ($request->direction == 'up') {
            $near = ArticleCategory::where('sort', '<', $sort)->where('parent_id', $parent_id)->orderBy('sort', 'desc')->first();
        } else {
            $near = ArticleCategory::where('sort', '>', $sort)->where('parent_id', $parent_id)->orderBy('sort', 'asc')->first();
        }

        if ($near) {
            // 更新排序
            $category->sort = $near->sort;
            $category->save();
            $near->sort = $sort;
            $near->save();
        }
    }


    public static function handleContent(Request $request, $id)
    {
        $category = ArticleCategory::findOrFail($id);
        if ($category) {
            $category->data()->updateOrCreate(
                ['article_category_id' => $id],
                ['content' => $request->content]
            );
        }
    }
}
