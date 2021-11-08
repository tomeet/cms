<?php


namespace Tomeet\Cms\Models\Relations;


trait BelongsToArticle
{
    public function article()
    {
        return $this->belongsTo('Tomeet\Cms\Models\Article');
    }
}
