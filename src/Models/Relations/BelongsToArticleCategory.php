<?php


namespace Tomeet\Cms\Models\Relations;


trait BelongsToArticleCategory
{

    public function category()
    {
        return $this->belongsTo('Tomeet\Cms\Models\ArticleCategory');
    }
}
