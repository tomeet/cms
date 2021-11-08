<?php


namespace Tomeet\Cms\Models\Traits;


use Tomeet\Cms\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait ArticleTrait
{

    /**
     * 新增文章
     *
     * @param Request $request
     */
    public static function handleCreate(Request $request)
    {
        DB::transaction(function () use ($request) {
            $article = new Article();
            $article->fill($request->except(['content', 'annexes', 'atlases', 'video']));
            $article->save();

            self::handleContent($article, $request->content);
            self::handleAnnexes($article, $request->annexes);
            self::handleAtlases($article, $request->atlases);
            self::handleVideo($article, $request->video);
        }, 3);
    }


    /**
     * 更新文章
     *
     * @param Request $request
     * @param $id
     */
    public static function handleUpdate(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $article = self::findOrFail($id);
            $article->fill($request->except(['content', 'annexes', 'atlases', 'video']));
            $article->save();

            self::handleContent($article, $request->content);
            self::handleAnnexes($article, $request->annexes);
            self::handleAtlases($article, $request->atlases);
            self::handleVideo($article, $request->video);
        }, 3);
    }


    /**
     * 删除文章（批量、单次）
     *
     * @param $id
     */
    public static function handleDelete($id)
    {
        $id = (array)$id;
        DB::transaction(function () use ($id) {
            $articles = Article::whereIn('id', $id)->get();
            if ($articles->count()) {
                $articles->each(function ($article) {
                    $article->delete();
                });
            } else {
                throw new \Exception('信息读取失败！');
            }
        }, 3);
    }


    /**
     * 处理详情信息
     *
     * @param $article
     * @param $content
     */
    private static function handleContent($article, $content)
    {
        if ($article->data) {
            $article->data->fill($content);
            $article->data->save();
        } else {
            $article->data()->create($content);
        }
    }


    /**
     * 处理附件信息
     *
     * @param $article
     * @param $annexes
     */
    private static function handleAnnexes($article, $annexes)
    {
        if (is_array($annexes) && !empty($annexes)) {
            $article->annexes()->createMany($annexes);
        }
    }


    /**
     * 处理图集图库
     *
     * @param $article
     * @param $atlases
     */
    private static function handleAtlases($article, $atlases)
    {
        if (is_array($atlases) && !empty($atlases)) {
            foreach ($atlases as $atlas) {
                if (isset($atlas['id'])) {
                    $model = $article->atlases()->findOrFail($atlas['id']);
                    $model->fill($atlas);
                    $model->save();
                } else {
                    $article->atlases()->create($atlas);
                }
            }
        }
    }


    /**
     * 处理视频信息
     *
     * @param $article
     * @param $video
     */
    private static function handleVideo($article, $video)
    {
        if ($video && $video['filepath']) {
            if ($article->video) {
                $article->video->fill($video);
                $article->video->save();
            } else {
                $article->video()->create($video);
            }
        }
    }

}
