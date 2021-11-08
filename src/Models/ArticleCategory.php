<?php

namespace Tomeet\Cms\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Tomeet\Cms\ModelFilters\ArticleCategoryFilter;
use Tomeet\Cms\Models\Relations\HasManyArticle;
use Tomeet\Cms\Models\Relations\HasOneArticleCategoryData;
use Tomeet\Cms\Models\Traits\ArticleCategoryTrait;

class ArticleCategory extends Model
{
    use HasFactory, NodeTrait, Filterable, ArticleCategoryTrait, HasManyArticle, HasOneArticleCategoryData;

    protected $guarded = ['id'];

    public function modelFilter()
    {
        return $this->provideFilter(ArticleCategoryFilter::class);
    }
}
