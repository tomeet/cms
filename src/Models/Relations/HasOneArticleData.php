<?php


namespace Tomeet\Cms\Models\Relations;


trait HasOneArticleData
{
    public function data()
    {
        return $this->hasOne('Tomeet\Cms\Models\ArticleData');
    }

    public static function bootHasOneArticleData()
    {
        static::deleting(function ($model) {
            $model->data()->delete();
        });
    }
}
