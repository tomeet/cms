<?php

namespace Tomeet\Cms\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tomeet\Cms\ModelFilters\ArticleFilter;
use Tomeet\Cms\Models\Relations\BelongsToArticleCategory;
use Tomeet\Cms\Models\Relations\HasManyArticleAnnex;
use Tomeet\Cms\Models\Relations\HasManyArticleAtlas;
use Tomeet\Cms\Models\Relations\HasOneArticleData;
use Tomeet\Cms\Models\Relations\HasOneArticleVideo;
use Tomeet\Cms\Models\Traits\ArticleTrait;

class Article extends Model
{
    use HasOneArticleData, HasOneArticleVideo, HasManyArticleAnnex, HasManyArticleAtlas, BelongsToArticleCategory;
    use HasFactory, Filterable, ArticleTrait;

    protected $guarded = ['id'];


    public function modelFilter()
    {
        return $this->provideFilter(ArticleFilter::class);
    }
}
