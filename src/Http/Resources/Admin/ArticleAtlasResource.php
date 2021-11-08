<?php

namespace Tomeet\Cms\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleAtlasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'description' => $this->description
        ];
    }
}
