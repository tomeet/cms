<?php

namespace Tomeet\Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tomeet\Cms\Models\Relations\BelongsToArticle;

class ArticleAtlas extends Model
{
    use HasFactory, BelongsToArticle;

    protected $guarded = ['id'];
}
