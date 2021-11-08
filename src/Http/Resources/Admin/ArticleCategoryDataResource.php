<?php

namespace Tomeet\Cms\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleCategoryDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
