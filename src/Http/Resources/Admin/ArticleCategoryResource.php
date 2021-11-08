<?php

namespace Tomeet\Cms\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class ArticleCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $routeName = Route::currentRouteName();
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'title' => $this->title,
            'type' => $this->type,
            'alias' => $this->alias,
            'image' => $this->image,
            'meta_title' => $this->meta_title,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description,
            'sort' => $this->sort,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            $this->mergeWhen($routeName == 'cms.categories.index', $this->getIndex()),
            $this->mergeWhen($routeName == 'cms.categories.show', $this->getInfos())
        ];
    }


    private function getIndex()
    {
        return [
            'hasChildren' => $this->whenLoaded('children', $this->getChildrenCount() > 0),
            'hasArticles' => $this->whenLoaded('articles', $this->getArticlesCount() > 0),
            'articleCount' => $this->whenLoaded('articles', $this->getArticlesCount(), 0),
        ];
    }


    private function getInfos()
    {
        return [
            $this->mergeWhen($this->type == 1, [
                'content' => $this->whenLoaded('data', $this->data ? $this->data->content : '')
            ])
        ];
    }


    private function getChildrenCount()
    {
        return $this->children()->count();
    }

    private function getArticlesCount()
    {
        return $this->articles()->count();
    }
}
