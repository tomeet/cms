<?php


namespace Tomeet\Cms\ModelFilters;


use EloquentFilter\ModelFilter;

class ArticleFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];


    /**
     * 文章所属分类
     *
     * @param $id
     * @return ArticleFilter
     */
    public function category($id)
    {
        return $this->where('article_category_id', $id);
    }
}
