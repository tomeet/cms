<?php


namespace Tomeet\Cms\Models\Relations;


trait HasOneArticleCategoryData
{
    public function data()
    {
        return $this->hasOne('Tomeet\Cms\Models\ArticleCategoryData');
    }
}
