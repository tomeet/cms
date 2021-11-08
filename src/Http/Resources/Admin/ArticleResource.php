<?php

namespace Tomeet\Cms\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class ArticleResource extends JsonResource
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
            'category_id' => $this->article_category_id,
            'title' => $this->title,
            'color' => $this->color,
            'cover' => $this->cover,
            'subtitle' => $this->subtitle,
            'abstract' => $this->abstract,
            'author' => $this->author,
            'source' => $this->source,
            'is_top' => $this->is_top,
            'is_hot' => $this->is_hot,
            'is_title_bold' => $this->is_title_bold,
            'is_allow_comment' => $this->is_allow_comment,
            'is_linkurl' => $this->is_linkurl,
            'linkurl' => $this->linkurl,
            'publish_at' => $this->publish_at,
            'expired_at' => $this->expired_at,
            'meta_title' => $this->meta_title,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            $this->mergeWhen($routeName == 'cms.articles.show', [
                'annexes' => ArticleAnnexResource::collection($this->whenLoaded('annexes')),
                'atlases' => ArticleAtlasResource::collection($this->whenLoaded('atlases')),
                'video' => new ArticleVideoResource($this->whenLoaded('video')),
                'content' => new ArticleDataResource($this->whenLoaded('data')),
            ])
        ];
    }
}
