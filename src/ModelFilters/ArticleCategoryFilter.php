<?php


namespace Tomeet\Cms\ModelFilters;


use EloquentFilter\ModelFilter;

class ArticleCategoryFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];


    public function parent($id)
    {
        if ($id == 0) {
            $this->whereNull('parent_id');
        } else {
            return $this->where('parent_id', $id);
        }
    }
}
