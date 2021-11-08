<?php


namespace Tomeet\Cms\Models\Relations;


trait HasManyArticle
{
    public function articles()
    {
        return $this->hasMany('Tomeet\Cms\Models\Article');
    }
}
