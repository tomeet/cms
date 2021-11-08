<?php

namespace Tomeet\Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tomeet\Cms\Models\Relations\BelongsToArticleCategory;

class ArticleCategoryData extends Model
{
    use HasFactory, BelongsToArticleCategory;

    protected $guarded = ['id'];
    public $timestamps = false;
}
