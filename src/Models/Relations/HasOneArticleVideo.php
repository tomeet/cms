<?php


namespace Tomeet\Cms\Models\Relations;

use App\Services\FileService;

trait HasOneArticleVideo
{
    public function video()
    {
        return $this->hasOne('Tomeet\Cms\Models\ArticleVideo');
    }

    public static function bootHasOneArticleVideo()
    {
        static::deleting(function ($model) {
            if ($video = $model->video) {
                if ($video->filepath) {
                    (new FileService())->delete($video->filepath);
                }
                $video->delete();
            }
        });
    }
}
